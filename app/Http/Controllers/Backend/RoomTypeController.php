<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomType;
use App\Models\BookArea;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Room;
 

class RoomTypeController extends Controller
{
    public function RoomTypeList(){

        $allData = RoomType::orderBy('id','desc')->get();
        return view('backend.allroom.roomtype.view_roomtype',compact('allData'));

    }// End method

    public function AddRoomType(){
     return view('backend.allroom.roomtype.add_roomtype');
    }// End method

    public function RoomTypeStore(Request $request){

       $roomtype_id = RoomType::insertGetId([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);

        
        Room::insert([
            'roomtype_id' => $roomtype_id,
            'status' => 1,
        ]);

        $notification = array(
            'message' => 'RoomType Insert Succesfully', 
            'alert-type' => 'success' 
        );

        return redirect()->route('room.type.list')->with($notification); 

    }// End method




}
