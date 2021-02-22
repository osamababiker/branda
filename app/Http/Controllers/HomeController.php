<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agar;
use App\AgarType;
use App\AgarFloor;
use App\State;
use App\City;
use App\A_extra;
use App\B_extra;
use App\Sf_extra;
use App\AgarCond;
use App\Location;
use App\ContactForm;
use Auth;

class HomeController extends Controller
{

    public function index()
    {
      $agars = Agar::where('status',2)->limit(8)->get();
      $featured_agars = Agar::where('status',2)->where('featured',1)->limit(3)->get();
      $areas = Location::get();
      $types = AgarType::get();
      return view('home')
            ->with('agars',$agars)
            ->with('featured_agars',$featured_agars)
            ->with('areas',$areas)
            ->with('types',$types);
    }

    // search agar by name
    public function getsearch(){

      // get this data for filteration
      $agarType = AgarType::where('status',1)->get();
      $agarFloor = AgarFloor::where('status',1)->get();
      $states = State::where('status',1)->get();
      $citys = City::where('status',1)->get();

      // get agar basic extract
      $agar_b_extra = B_extra::where('status',1)->get();
      // get agar addithonal extract
      $agar_a_extra = A_extra::where('status',1)->get();
      // get special extra
      $agar_s_extra = Sf_extra::where('status',1)->get();
      // get agar condation
      $agar_cond = AgarCond::where('status',1)->get();
      // get agars location
      $agar_location = Location::get();
      // get user query string
      if(isset($_GET['query'])){
        $query = json_encode($_GET['query']);
      }else{
        $query = '';
      }
      if(isset($_GET['agar_type'])){
        $type_id = json_encode($_GET['agar_type']);
      }else{
        $type_id = '';
      }


      return view('search')
              ->with('agarType',$agarType)
              ->with('agarFloor',$agarFloor)
              ->with('states',$states)
              ->with('citys',$citys)
              ->with('agar_b_extra',$agar_b_extra)
              ->with('agar_a_extra',$agar_a_extra)
              ->with('agar_s_extra',$agar_s_extra)
              ->with('agar_cond',$agar_cond)
              ->with('query',$query)
              ->with('type_id',$type_id)
              ->with('agar_location',$agar_location);
    }

    public function postSearch(Request $request){
      $query  = $request->input('query');
      $agars = Agar::where('agar_name', 'LIKE' , "%$query%")
            ->where('status',1)
            ->get();
      $featured_agars = Agar::where('agar_name', 'LIKE' , "%$query%")
                            ->where('status',1)
                            ->where('featured',1)->get();
      $citys = City::get();
      return view('home')
              ->with('agars',$agars)
              ->with('featured_agars',$featured_agars)
              ->with('citys',$citys);
    }


    // to send contact message
    public function postContact(Request $request){
      $this->validate($request,[
        'username' => 'required|string',
        'phone' => 'required',
        'subject' => 'required|string',
        'message' => 'required|string'
      ]);

      ContactForm::create([
        'username' => $request->username,
        'phone' => $request->phone,
        'subject' => $request->subject,
        'message' => $request->message
      ]);

      return redirect()->back()->with('info', 'شكرا جزيلا لتواصلك معنا سيتم الرد على استفسارك في اقرب فرصة ممكنة');
    }

}
