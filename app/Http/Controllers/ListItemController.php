<?php

namespace App\Http\Controllers;

use App\Models\ListItem;
use Illuminate\Http\Request;

class ListItemController extends Controller
{
    //add
    public function add(Request $request)
    {
        $item = new ListItem();
        $item->content = $request->content;
        $item->save();
        // return added item in json response with message
        return response()->json([
            'item' => $item,
            'message' => 'Item added successfully',
        ]);
    }

    //delete
    public function delete(Request $request)
    {
        $item = ListItem::find($request->id);
        if (!$item) {
            return $this->notFound();
        }
        $item->delete();
        // return item in json response with message
        return response()->json([
            'item' => $item,
            'message' => 'Item deleted successfully',
        ]);
    }

    //list
    public function list()
    {
        $items = ListItem::orderBy('created_at', 'desc')->get();
        // return items in json response
        return response()->json([
            'items' => $items,
        ]);
    }

    //mark as complete
    public function markAsComplete(Request $request)
    {
        $item = ListItem::find($request->id);
        if (!$item) {
            return $this->notFound();
        }
        $item->completed = true;
        $item->completed_at = now();
        $item->save();
        // return item in json response with message
        return response()->json([
            'item' => $item,
            'message' => 'Item marked as complete successfully',
        ]);
    }

    private function notFound()
    {
        return response()->json(
            [
                'message' => 'Item not found',
            ],
            404
        );
    }
}
