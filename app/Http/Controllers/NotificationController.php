<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Notification;

class NotificationController extends Controller
{
    public function index(){
      $notifications = Notification::where('read',0)->where('to',Auth::user()->id)->get();
      return view('notification.index')
              ->with('notifications',$notifications);
    }

    public function readAll(Request $request){
      Notification::where('to',Auth::user()->id)->where('read',0)->update([
        'read' => 1
      ]);
      return redirect()->back();
    }
}
