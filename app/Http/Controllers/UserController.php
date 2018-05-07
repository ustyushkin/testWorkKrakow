<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\User;

class UserController extends BaseController
{
   protected $class;
    //use Eloquent ORM
   public function __construct()
   {
       $this->class = new User;
   }
   public function list(Request $request)
   {
       return $this->getList($request);
   }
   //create method
   public function create(Request $request)
   {
       return $this->process($request,'create');
   }

   //update method
   public function update(Request $request)
   {
       return $this->process($request,'update');
   }

   //delete method
   public function delete(Request $request)
   {
       return $this->process($request,'delete');
   }
}
