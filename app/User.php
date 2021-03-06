<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// use App\SavePost ;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;
    public function post() {
        return $this->hasMany('App\Post');
    }

    public function comment() {
        return $this->hasMany('App\Comment');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');


    }

    public function followers()
    {
        // return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
        return $this->hasMany('App\Followers');

    }
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'user_posts');
    }

    public function posts_likes()
    {
        return $this->belongsToMany(Post::class, 'likes');
    }
    public function authProviders()
    {
       return $this->hasMany('App\AuthProvider','user_id','id');
    }




    // public function user_post()
    // {
    //    return $this->hasMany('App\UserPost');
    // }





    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'email', 'password', 'user_name' , 'gender' , 'website' ,
        'phone' , 'bio' , 'avatar'
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
}
