<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalModel extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $table = 'journal';

}
