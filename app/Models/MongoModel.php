<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Jenssegers\Mongodb\Eloquent\Model;
use MongoDB\Operation\FindOneAndUpdate;

abstract class MongoModel extends Model
{
    protected $connection = "mongodb";
}
