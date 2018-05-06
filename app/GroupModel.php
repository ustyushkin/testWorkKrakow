<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupModel extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $table = 'groups';

}
