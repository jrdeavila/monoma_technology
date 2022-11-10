<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Jenssegers\Mongodb\Auth\User as AuthUser;
use MongoDB\Operation\FindOneAndUpdate;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends AuthUser implements JWTSubject
{
    use HasFactory;

    protected  $collection = "users";
    protected $connection = "mongodb";
    public $timestamps = false;

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

    public function nextid()
    {
        $this->ref = self::getID();
    }

    public static function bootUseAutoIncrementID()
    {
        static::creating(function ($model) {
            $model->sequencial_id = self::getID($model->getTable());
        });
    }
    public function getCasts()
    {
        return $this->casts;
    }

    private static function getID()
    {
        $seq = DB::connection('mongodb')->getCollection("users")->findOneAndUpdate(
            ['ref' => 'ref'],
            ['$inc' => ['seq' => 1]],
            ['new' => true, 'upsert' => true, 'returnDocument' => FindOneAndUpdate::RETURN_DOCUMENT_AFTER]
        );
        return $seq->seq;
    }
    public static function createByDomainModel(\Src\BoundedContext\User\Domain\User $user): self
    {
        $nuser = new self();
        $nuser->_id = $user->getId()->value();
        $nuser->ref = $user->getId()->value();
        $nuser->username = $user->getUsername()->value();
        $nuser->password = $user->getPassword()->value();
        $nuser->is_active = $user->getIs_Active()->value();
        $nuser->last_login = $user->getLast_Login()->value();
        $nuser->role = $user->getRole()->value();
        return $nuser;
    }
}
