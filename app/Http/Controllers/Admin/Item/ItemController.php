<?php

namespace App\Http\Controllers\Admin\Item;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Item\ItemStoreRequest;
use App\Http\Requests\Admin\Item\ItemUpdateRequest;
use App\Models\Course\Course;
use App\Models\Item\Item;
use App\Repositories\Admin\ItemRepository;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    protected $ItemRepository;

    public function __construct(ItemRepository $ItemRepository)
    {
        $this->ItemRepository = $ItemRepository;
    }

    public function create(Course $course)
    {
        $parentItems = $this->ItemRepository->getParentItems($course);
        return view('admin.items.create', compact('course', 'parentItems'));
    }

    public function store(ItemStoreRequest $request)
    {
        $item = $this->ItemRepository->store($request);
        $course = $this->ItemRepository->getCourse($item);
        return view('admin.courses.show', compact('course', 'item'));
    }

    public function show(Course $course, Item $item)
    {
        return view('admin.courses.show', compact('course', 'item'));
    }

    public function edit(Item $item)
    {
        return view('admin.items.edit', compact('item'));
    }

    public function update(ItemUpdateRequest $request, Item $item)
    {
        $items = $this->ItemRepository->update($request, $item);
        $course = $this->ItemRepository->getCourse($item);
        return view('admin.courses.show', compact('course', 'item'));
    }

    public function destroy(Item $item)
    {
        $item = $this->ItemRepository->destroy($item);
        $course = $this->ItemRepository->getCourse($item);
        return view('admin.courses.show', compact('course', 'item'));
    }
}
