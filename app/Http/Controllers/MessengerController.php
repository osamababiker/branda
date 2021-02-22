<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Auth;

class MessengerController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }
  public function index()
  {
    $messagesCount = Message::where('to','=',Auth::user()->id)
          ->orwhere('from','=',Auth::user()->id)->count();

      return view('messages.index')
          ->with('messagesCount',$messagesCount);
  }

  public function test()
  {
    $messagesCount = Message::where('to','=',Auth::user()->id)
          ->orwhere('from','=',Auth::user()->id)->count();

      return view('messages.testChat')
          ->with('messagesCount',$messagesCount);
  }
}
