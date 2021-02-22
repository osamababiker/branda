<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\User;
use App\Contacts;
use App\Agar;
use App\AgarExtra;
use App\B_extra;
use App\A_extra;
use App\AgarCond;
use App\Sf_extra;
use App\AgarCalendar;
use App\AgarPrice;
use App\Location;
use App\Reservation;
use App\AgarType;
use App\AgarFloor;
use App\AgarImg;
use App\State;
use App\City;
use App\Message;
use App\Notification;
use App\Settings;
use App\PaymentAddress;
use App\ContactForm;
use App\Events\NewNotification;
use Auth;

class dashboardController extends Controller
{
    public function index(){

      $users_count = User::get()->count();
      $agars_count = Agar::get()->count();
      $message_count = Message::get()->count();
      $reservation_count = Reservation::get()->count();

      return view('dashboard.index')
              ->with('users_count',$users_count)
              ->with('agars_count',$agars_count)
              ->with('message_count',$message_count)
              ->with('reservation_count',$reservation_count);
    }

    // manage users
    public function getUsers(){
      $users = User::where('status','<>' ,0)->get();
      return view('dashboard.users')
              ->with('users',$users);
    }

    public function postUsers(Request $request){
      User::where('id',$request->user_id)->update(['status' => 0]);
      return redirect()->back()->with('info',' تم تعطيل حساب المستخدم  ');
    }

    // manage agars
    public function getAgars(){
      $agars = Agar::where('status','<>',0)->get();
      return view('dashboard.agars')
              ->with('agars',$agars);
    }

    # get single agar page
    public function getAgar($agar_id){
      $agar = Agar::where('status','<>',0)->where('id',$agar_id)->first();
      return view('dashboard.agar')
              ->with('agar',$agar);
    }

    public function postAgars(Request $request){
        if($request->has('approve_btn')){
          Agar::where('id',$request->agar_id)->update(['status' => 2]);
          // notifi user for approving agar
          $notification = Notification::create([
            'to' => Agar::find($request->agar_id)->owner_id,
            'from' => Auth::user()->id,
            'message' => ' تمت الموافقة على عقارك من قبل ادارة الموقع'
          ]);
          broadcast(new NewNotification($notification));
          return redirect()->back()->with('info',' تمت الموافقة على العقار ');
        }
        if($request->has('featured_btn')){
          Agar::where('id',$request->agar_id)->update(['featured' => 1]);
          return redirect()->back()->with('info','  تم تحويل العقار الى مميز ');
        }
        if($request->has('notfeatured_btn')){
          Agar::where('id',$request->agar_id)->update(['featured' => 0]);
          return redirect()->back()->with('info','  تم تحويل العقار الى عادي ');
        }
        if($request->has('reject_btn')){
          Agar::where('id',$request->agar_id)->update([
            'admin_comments' => $request->comments,
            'status' => 3
          ]);
          $notification = Notification::create([
            'to' => Agar::find($request->agar_id)->owner_id,
            'from' => Auth::user()->id,
            'message' => 'تم رفض العقار الخاص بك من قبل ادارة الموقع'
          ]);
          broadcast(new NewNotification($notification));
          return redirect()->back()->with('info','  تم تعطيل عرض العقار');
        }
    }

    // manage reservation
    public function getReservations(){
      $reservations = Reservation::get();
      return view('dashboard.reservations')
              ->with('reservations',$reservations);
    }

    public function postReservations(Request $request){
      Reservation::where('id',$request->reservation_id)->update(['status' => 0]);
      $notification = Notification::create([
        'to' => Reservation::find($request->reservation_id)->user_id,
        'from' => Auth::user()->id,
        'message' => 'تم حذف طلب الحجز الذي ارسلته من قبل ادارة الموقع'
      ]);
      broadcast(new NewNotification($notification));
      return redirect()->back()->with('info','تم تعطيل الحجز ');
    }


    // manage payment
    public function getPayment(){
      $reservations = Reservation::where('status','<>', 2)->where('status','<>', 0)->get();
      return view('dashboard.payment')
                ->with('reservations',$reservations);
    }
    public function postPayment(Request $request){
      if($request->has('action')){
        if($request->action == 'confirm'){
          Reservation::where('id',$request->reservation_id)->update(['status' => 2]);
          // add reservation sender to agar owner contacts list
          $sender_user = User::where('id',$request->user_id)->first();
          $resever_user = User::where('id',$request->reciver_id)->first();
          if(!$resever_user->isContactWith($sender_user)){
              $resever_user->addContact($sender_user);
          }
          $notification = Notification::create([
            'to' => Reservation::find($request->reservation_id)->user_id,
            'from' => Auth::user()->id,
            'message' => 'تم تأكيد طلب الحجز الذي ارسلته من قبل ادارة الموقع'
          ]);
          broadcast(new NewNotification($notification));
          return redirect()->back()->with('info','تم تأكيد طلب الحجز');
        }
        elseif($request->action == 'delete'){
          Reservation::where('id',$request->reservation_id)->update(['status' => 0]);
          $notification = Notification::create([
            'to' => Reservation::find($request->reservation_id)->user_id,
            'from' => Auth::user()->id,
            'message' => 'تم حذف طلب الحجز الذي ارسلته من قبل ادارة الموقع'
          ]);
          broadcast(new NewNotification($notification));
          return redirect()->back()->with('info','تم تعطيل الحجز  ');
        }
      }
      return redirect()->back()->with('info','قم باختيار عملية اولا');
    }

    // add new payment address
    public function getPaymentAddress(){
      return view('dashboard.paymentAddress');
    }

    public function postPaymentAddress(Request $request){
      if($request->has('add_btn')){
        PaymentAddress::create([
          'name' => $request->name,
          'branch' => $request->branch,
          'address' => $request->address,
          'account_number' => $request->account_number,
        ]);
        return redirect()->back()->with('info','تم اضافة العنوان بنجاح');
      }
    }

    public function getPaymentAddressTable(){
      $paymentAddress = PaymentAddress::get();
      return view('dashboard.paymentAddressTable')
                  ->with('paymentAddress',$paymentAddress);
    }

    public function postPaymentAddressTable(Request $request){
      if($request->has('delete_btn')){
        PaymentAddress::where('id',$request->id)->delete();
        return redirect()->back()->with('info',' تم حذف العنوان بنجاح  ');
      }
      if($request->has('update_btn')){
        PaymentAddress::where('id',$request->id)->update([
          'name' => $request->name,
          'branch' => $request->branch,
          'address' => $request->address,
          'account_number' => $request->account_number
        ]);
        return redirect()->back()->with('info',' تم تحديث العنوان بنجاح  ');
      }
    }

    // manage b_extra info
    public function getB_extra(){
      $b_extra = B_extra::where('status',1)->get();
      return view('dashboard.b_extra')->with('b_extra',$b_extra);
    }
    public function add_B_extra(){
      return view('dashboard.add_B_extra');
    }
    public function postB_extra(Request $request){
      if($request->has('delete_btn')){
        B_extra::where('id',$request->id)->update(['status' => 0]);
        return redirect()->back()->with('info',' تم حذف المرفق  ');
      }
      if($request->has('add_btn')){
        B_extra::create([
          'name' => $request->name,
          'status' => $request->status
        ]);
        return redirect()->back()->with('info','تمت الاضافة بنجاح');
      }
    }

    // manfe a_extra info
    public function getA_extra(){
      $a_extra = A_extra::where('status',1)->get();
      return view('dashboard.a_extra')->with('a_extra',$a_extra);
    }
    public function add_A_extra(){
      return view('dashboard.add_A_extra');
    }
    public function postA_extra(Request $request){
      if($request->has('delete_btn')){
        A_extra::where('id',$request->id)->update(['status' => 0]);
        return redirect()->back()->with('info','تم حذف المرفق');
      }
      if($request->has('add_btn')){
        A_extra::create([
          'name' => $request->name,
          'status' => $request->status
        ]);
      }
      return redirect()->back()->with('info','تمت الاضافة بنجاح');
    }

    // mange sf_extra info
    public function getSf_extra(){
      $sf_extra = Sf_extra::where('status',1)->get();
      return view('dashboard.sf_extra')->with('sf_extra',$sf_extra);
    }
    public function add_sf_extra(){
      return view('dashboard.add_sf_extra');
    }
    public function postSf_extra(Request $request){
      if($request->has('delete_btn')){
        Sf_extra::where('id',$request->id)->update(['status' => 0]);
        return redirect()->back()->with('info',' تم حذف المرفق  ');
      }
      if($request->has('add_btn')){
        Sf_extra::create([
          'name' => $request->name,
          'status' => $request->status
        ]);
      }
      return redirect()->back()->with('info','تمت الاضافة بنجاح');
    }

    // mange agars condition info
    public function getCond(){
      $condition = AgarCond::where('status',1)->get();
      return view('dashboard.agar_condition')->with('condition',$condition);
    }
    public function addCond(){
      return view('dashboard.add_agar_condition');
    }
    public function postCond(Request $request){
      if($request->has('delete_btn')){
        AgarCond::where('id',$request->id)->update(['status' => 0]);
        return redirect()->back()->with('info',' تم حذف الشرط ');
      }
      if($request->has('add_btn')){
        AgarCond::create([
          'name' => $request->name,
          'status' => $request->status
        ]);
      }
      return redirect()->back()->with('info','تمت الاضافة بنجاح');
    }

    // mange agars type info
    public function getAgar_type(){
      $agar_type = AgarType::where('status',1)->get();
      return view('dashboard.agar_type')->with('agar_type',$agar_type);
    }
    public function AddAgar_type (){
      return view('dashboard.add_agar_type');
    }
    public function postAgar_type(Request $request){
      if($request->has('delete_btn')){
        AgarType::where('type_id',$request->id)->update(['status' => 0]);
        return redirect()->back()->with('info',' تم حذف النوع ');
      }
      if($request->has('add_btn')){
        AgarType::create([
          'type_name' => $request->name,
          'status' => $request->status
        ]);
      }
      return redirect()->back()->with('info','تمت الاضافة بنجاح');
    }

    // mange agars floor info
    public function getAgar_floor(){
      $agar_floor = AgarFloor::where('status',1)->get();
      return view('dashboard.agar_floor')->with('agar_floor',$agar_floor);
    }
    public function AddAgar_floor(){
      return view('dashboard.add_agar_floor');
    }
    public function postAgar_floor(Request $request){
      if($request->has('delete_btn')){
        AgarFloor::where('floor_id',$request->id)->update(['status' => 0]);
        return redirect()->back()->with('info','تم حذف الطابق');
      }
      if($request->has('add_btn')){
        AgarFloor::create([
          'floor_name' => $request->name,
          'status' => $request->status
        ]);
      }
      return redirect()->back()->with('info','تمت الاضافة بنجاح');
    }

    // mange state info
    public function getStates(){
      $states = State::where('status',1)->get();
      return view('dashboard.states')->with('states',$states);
    }
    public function AddStates(){
      return view('dashboard.add_states');
    }
    public function postStates(Request $request){
      if($request->has('delete_btn')){
        State::where('state_id',$request->id)->update(['status' => 0]);
        return redirect()->back()->with('info','تم حذف الولاية');
      }
      if($request->has('add_btn')){
        State::create([
          'state_name' => $request->name,
          'status' => $request->status
        ]);
      }
      return redirect()->back()->with('info','تمت الاضافة بنجاح');
    }

    // mange cities info
    public function getCities(){
      $cities = City::where('status',1)->get();
      return view('dashboard.cities')->with('cities',$cities);
    }
    public function AddCities(){
      $states = State::get();
      return view('dashboard.add_cities')->with('states',$states);
    }
    public function postCities(Request $request){
      if($request->has('delete_btn')){
        City::where('city_id',$request->id)->update(['status' => 0]);
        return redirect()->back()->with('info','تم حذف المدينة');
      }
      if($request->has('add_btn')){
        City::create([
          'city_name' => $request->name,
          'state_id' => $request->state_id,
          'status' => $request->status
        ]);
      }
      return redirect()->back()->with('info','تمت الاضافة بنجاح');
    }

    // manage contact table
    public function getContact(){
      $messages = ContactForm::where('is_deleted',0)->get();
      return view('dashboard.contacts')->with('messages',$messages);
    }

    public function postContact(Request $request){
      if($request->has('delete_btn')){
        ContactForm::where('id',$request->message_id)->update([
          'is_deleted' => 1
        ]);
        return redirect()->back()->with('info','تم حذف الاستفسار بنجاح');
      }
      if($request->has('close_btn')){
        ContactForm::where('id',$request->message_id)->update([
          'is_closed' => 1
        ]);
        return redirect()->back()->with('info','تم تغيير حالة الاستفسار بنجاح');
      }
    }

    // manage site Settings
    public function getSettings(){
      $settings = Settings::first();
      return view('dashboard.settings')
              ->with('settings',$settings);
    }

    public function postSettings(Request $request){

      if($request->hasFile('logo')){
        $logo = $request->file('logo');
        $imageUrl = 'images/'.time().'.'.$logo->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $logo->move($destinationPath,$imageUrl);
        $logo = $imageUrl;
      }else{
        $logo = Settings::first()->logo;
      }

      Settings::where('id',$request->id)->update([
        'site_name' => $request->site_name,
        'address'    => $request->address,
        'logo'      => $logo,
        'email_one' => $request->email_one,
        'email_two' => $request->email_two,
        'phone_one' => $request->phone_one,
        'phone_two' => $request->phone_two
      ]);

      return redirect()->back()->with('info','تم تحديث البيانات بنجاح');
    }
}
