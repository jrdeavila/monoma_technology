<?php

namespace Src\Shared\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Auth\User as AuthUser;
use Tymon\JWTAuth\Contracts\JWTSubject;

class MongoUser extends AuthUser implements JWTSubject
{
    use HasFactory;

    protected  $collection = "users";
    protected $connection = "mongodb";
    public $timestamps = false;
    protected $primarykey = "_id";

    protected $fillable = [
        'username',
        'password',
        'is_active',
        'last_login',
        'role',
    ];



    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public static function createByDomainModel(\Src\BoundedContext\User\Domain\User $user): self
    {
        $nuser = new self();
        $nuser->username = $user->getUsername()->value();
        $nuser->password = $user->getPassword()->value();
        $nuser->is_active = $user->getIs_Active()->value();
        $nuser->last_login = $user->getLast_Login()->value();
        $nuser->role = $user->getRole()->value();
        return $nuser;
    }
}
