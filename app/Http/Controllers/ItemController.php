<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function items()
    {
        $user_id = Auth::id();
        $items = Item::select('id','name')->where('user_id',$user_id)->get();
        $data = ['items' => $items];
        return view('items', $data);
    }

    public function addItem(Request $request)
    {
        if($request->hasfile('file'))
        {
            $file = $request->file('file');

            $destinationPath = 'public/userFiles';
            $file_path = $file->store($destinationPath);

            $item = new Item();
            $item->user_id = Auth::id();
            $item->name = $file->getClientOriginalName();
            $item->location = $file_path;
            $item->save();
        }
        return redirect('items');
    }

    public function deleteItem($id)
    {
        $item = Item::find($id);
        $user_id = Auth::id();

        if ( !$item )
        {
            return $this->sendError( 'Not found', [ 'errors' => 'Collection not found' ], 404 );
        }

        if($item->user_id == $user_id)
        {
            $item->delete();
        }
        return redirect('items');
    }

    public function index()
    {
        $id = Auth::guard('api')->id();
        $result = DB::table('items')
            ->where('user_id','=',$id)->get();

        return response()->json([
            'message' => '',
            'data' => json_encode(['items' => $result]),
            'error' => false,
        ]);
    }

    public function getItem($id)
    {
        $user_id = Item::find($id)->user_id;
        $current_user_id = Auth::id();
        if($user_id != $current_user_id)
        {
            return response()->json(['error'=>'Unauthenticated'], 401);
        }

        $item = Item::find($id);

        $contents = Storage::get($item->location);
        return $contents;
    }
}
