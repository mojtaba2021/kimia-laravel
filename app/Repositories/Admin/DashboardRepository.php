<?php

namespace App\Repositories\Admin;

use App\Models\Comment\Comment;
use App\Models\Course\Course;
use App\Models\Post\Post;
use App\Models\Transaction\Transaction;

class DashboardRepository extends BaseRepository
{
    public function getTransactions()
    {
        return Transaction::query()
            ->select([
                'id',
                'credit',
                'created_at'
            ])
            ->orderBy('created_at')
            ->get();
    }

    public function getCourses()
    {
        return Course::query()
            ->select([
                'id',
                'view_count',
                'created_at'
            ])
            ->orderBy('created_at')
            ->get();
    }

    public function getPosts()
    {
        return Post::query()
            ->select([
                'id',
                'view_count',
                'created_at'
            ])
            ->orderBy('created_at')
            ->get();
    }

    public function getComments()
    {
        return Comment::query()
            ->select([
                'id'
            ])
            ->get();
    }

    public function getChart($type)
    {
        if ($type == "Course") {
            $item = $this->getCourses();
            $viewCount = $item->map(function ($item) {
                return $item->view_count;
            });
        } elseif ($type == "Post") {
            $item = $this->getPosts();
            $viewCount = $item->map(function ($item) {
                return $item->view_count;
            });
        } elseif ($type == "Transaction") {
            $item = $this->getTransactions();
            $viewCount = $item->map(function ($item) {
                return $item->credit;
            });
        }
        $updatedAt = $item->map(function ($item) {
            return verta($item->created_at)->format('Y/m/d');
        });
        $result = [];
        foreach ($updatedAt as $i => $v) {
            if (!isset($result[$v])) {
                $result[$v] = 0;
            }
            $result[$v] += $viewCount[$i];
        }
        return $result;
    }

    public function getSums($type)
    {
        if ($type == "Course") {
            $item = count($this->getCourses());
        } elseif ($type == "Post") {
            $item = count($this->getPosts());
        } elseif ($type == "Transaction") {
            $item = count($this->getTransactions());
        }elseif ($type == "Comment") {
            $item = count($this->getComments());
        }
        return $item;
    }
}
