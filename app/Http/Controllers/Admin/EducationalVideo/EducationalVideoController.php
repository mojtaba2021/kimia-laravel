<?php

namespace App\Http\Controllers\Admin\EducationalVideo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EducationalVideo\EducationalVideoStoreRequest;
use App\Http\Requests\Admin\EducationalVideo\EducationalVideoUpdateRequest;
use App\Models\EducationalVideo\EducationalVideo;
use App\Repositories\Admin\EducationalVideoRepository;

class EducationalVideoController extends Controller
{
    protected $EducationalVideoRepository;

    public function __construct(EducationalVideoRepository $EducationalVideoRepository)
    {
        $this->EducationalVideoRepository = $EducationalVideoRepository;
    }

    public function index()
    {
        return view('admin.educationalvideos.index');
    }

    public function create()
    {
        return view('admin.educationalvideos.create');
    }

    public function store(EducationalVideoStoreRequest $request)
    {
        $this->EducationalVideoRepository->store($request);
        alert()->success("با تشکر", 'ویدئو مورد نظر با موفقیت ثبت شد');
        return redirect()->route('admin.educationalvideos.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(EducationalVideo $educational)
    {

        return view('admin.educationalvideos.edit', compact('educational'));
    }

    public function update(EducationalVideoUpdateRequest $request, EducationalVideo $educational)
    {
        $this->EducationalVideoRepository->update($request, $educational);
        alert()->success("با تشکر", 'ویدئو مورد نظر با موفقیت ویرایش شد');
        return redirect()->route('admin.educationalvideos.index');
    }

    public function destroy(EducationalVideo $educational)
    {
        $this->EducationalVideoRepository->destroy($educational);
        return redirect()->route('admin.educationalvideos.index');
    }
}
