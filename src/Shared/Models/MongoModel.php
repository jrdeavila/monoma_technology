<?php

namespace Src\Shared\Models;

use Jenssegers\Mongodb\Eloquent\Model;

abstract class MongoModel extends Model
{
    protected $connection = "mongodb";
}
