<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $table = 'users';

}
