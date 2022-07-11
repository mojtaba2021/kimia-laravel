<?php

namespace App\Repositories\Site;

use Illuminate\Support\Facades\DB;

class SearchRepository extends BaseRepository
{
    public function search($request)
    {
        if ($request->ajax()) {
            $output = "";
            $posts = DB::table('posts')
                ->where('is_active', 1)
                ->where('title', 'LIKE', '%' . $request->search . "%")
                ->orWhere('description', 'LIKE', '%' . $request->search . "%")
                ->get();
            if ($posts) {
                foreach ($posts as $product) {
                    $show = route('site.posts.show', $product->slug);
                    $output .= "<tr>
                        <td><a href=" . $show . "> $product->title </a></td>
                        <td> $product->description </td>
                        <td>در وبلاگ</td>
                        </tr>";
                }
//                return Response($output);
            }
            $courses = DB::table('courses')
                ->where('is_active', 1)
                ->where('title', 'LIKE', '%' . $request->search . "%")
                ->orWhere('description', 'LIKE', '%' . $request->search . "%")
                ->get();
            if ($courses) {
                foreach ($courses as $product) {
                    $show = route('site.courses.show', $product->slug);
                    $output .= "<tr>
                        <td><a href=" . $show . "> $product->title </a></td>
                        <td> $product->description </td>
                        <td>دوره های آموزشی</td>
                        </tr>";
                }
                return Response($output);
            }
        }
    }
}
