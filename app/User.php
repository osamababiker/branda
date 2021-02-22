<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable , HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'phone',
        'role',
        'email',
        'password',
        'verifi_code',
        'phone_verified',
        'role',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bill(){
        return $this->hasMany(Bill::class,'user_id');
    }

    public function reservation(){
        return $this->hasMany(Reservation::class,'user_id');
    }

    public function agar()
    {
        return $this->hasMany(Agar::class,'owner_id');
    }


    // for contacts table
   public function contactsOfMine(){
       return $this->belongsToMany(User::class,'contacts','user_id','contact_id');
   }

   public function contactsOf(){
       // test this out (user_id vs worker_id)
       return $this->belongsToMany(User::class,'contacts','contact_id','user_id');
   }

   public function contacts(){
       return $this->contactsOfMine()->wherePivot('accepted',true)->get()->merge($this->contactsOf()->wherePivot('accepted',true)->get());
   }

   public function contactRequest(){
       return $this->contactsOfMine()->wherePivot('accepted',false)->get();
   }

   public function contactRequestPending(){
       return $this->contactsOf()->wherePivot('accepted',false)->get();
   }

   public function hasContactRequestPending(User $user){
       return (bool) $this->contactRequestPending()->where('id',$user->id)->count();
   }

   public function hasContactRequestRecived(User $user){
       return (bool) $this->ContactRequest()->where('id',$user->id)->count();
   }

   public function addContact(User $user){
       $this->contactsOf()->attach($user->id);
   }

   public function deleteContact(User $user){
       $this->contactsOf()->detach($user->id);
       $this->contactsOfMine()->detach($user->id);
   }

   public function acceptContactRequest(User $user){
       $this->contactRequest()->where('id',$user->id)->first()->pivot->update([
           'accepted' => true,
       ]);
   }

   public function isContactWith(User $user){
       return (bool) $this->contacts()->where('id',$user->id)->count();
   }
}
