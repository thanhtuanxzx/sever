<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


// use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory,Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $fillable = [
        'first_name',
        'last_name',
        'organization',
        'phone',
        'nationality',
        'email',
        'username',
        'password',
        'status',
        'token',
        'title',
        'gender',
        'role',
        'bio',
        'profile_image',
        'homepage_url'
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'user_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'user_id');
    }

    public function authorships()
    {
        return $this->hasMany(ArticleAuthor::class, 'author_id');
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    // Required method to return any custom claims for the JWT
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function notifications()
{
    return $this->morphMany(Notification::class, 'notifiable');
}

}
