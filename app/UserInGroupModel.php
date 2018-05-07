<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInGroupModel extends Model
{
    public $timestamps = false;
    protected $connection = 'mysqltest';
    protected $table = 'usersingroups';
    public $primaryKey = 'idUser';
    public $incrementing = false;

}
