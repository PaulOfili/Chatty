<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * 
     */
    protected $fillable = [
        'username', 
        'email', 
        'password',
        'first_name',
        'last_name',
        'location',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * 
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    public function getName()
    {
        if($this->first_name && $this->last_name) {
            return "{$this->first_name} {$this->last_name}";
        }

        if($this->first_name) {
            return $this->first_name;
        }

        return null;
    }

    public function getNameOrUsername()
    {
        return $this->getName() ?: $this->username; 
    }

    public function getFirstNameOrUsername()
    {
        return $this->first_name ?: $this->username;
    }

    public function statuses() {
        return $this->hasMany('App\Models\Status', 'user_id');
    }

    public function friendsOfMine() {
        return $this->belongsToMany('App\Models\User', 'friends', 'user_id', 'friend_id');
    }

    public function friendsToMe() {
        return $this->belongsToMany('App\Models\User', 'friends', 'friend_id', 'user_id');
    }

    public function friends() {
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()->merge($this->friendsToMe()->wherePivot('accepted',true)->get());
    }
 
    public function friendRequests() {
        return $this->friendsOfMine() ->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestsPending(User $user) {
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    public function friendRequestsReceived() {
        return $this->friendsToMe()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestsReceived(User $user) {
        return (bool) $this->friendRequestsReceived()->where('id', $user->id)->count();
    }    

    public function addFriend(User $user) {
        $this->friendsOfMine()->attach($user->id);
    }

    public function acceptFriendRequest(User $user) {
        $this->friendRequestsReceived()->where('id',$user->id)->first()->pivot
        ->update([
            'accepted'=>true,
        ]);
    }

    public function isFriendsWith(User $user) {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }
}
