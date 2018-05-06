<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServerModel extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $table = 'server';

}
