<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListItem;
use Illuminate\Support\Carbon;


class toDoListController extends Controller
{
    //
    public function index()
    {

        // RECUPERE LES TACHES INCOMPLETES
        $incompleteItems = ListItem::where('is_complete', 0)->orderBy('created_at', 'desc')->get();
        $completedItems = ListItem::where('is_complete', 1)->orderBy('completed_at', 'desc')->get();


        return view('welcome', [
            'incompleteItems' => $incompleteItems,
            'completedItems' => $completedItems
        ]);
    }

    public function saveItem(Request $request)
    {

        $newListItem = new ListItem;
        $newListItem->name = $request->input('newItem');
        $newListItem->is_complete = 0;
        $newListItem->save();

        return redirect()->back();
    }

    public function mark($id)
    {
        $listItem = ListItem::find($id);
        $listItem->is_complete = 1;
        $listItem->completed_at = Carbon::now();
        $listItem->save();


        return redirect()->back();
    }

    public function unmark($id)
    {
        $listItem = ListItem::find($id);
        $listItem->is_complete = 0;
        $listItem->completed_at = null;
        $listItem->save();


        return redirect()->back();
    }
}
