<?php

namespace App\Http\Controllers\Admin\Item;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\ItemRepository;
use Illuminate\Http\Request;

class ItemAjaxController extends Controller
{
    protected $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function getItemDatatableData(Request $request, $item)
    {
        return $this->itemRepository->getItemDatatableData($request, $item);
    }

}
