<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Group;

class GroupController extends BaseController
{
   protected $class;
    //use Eloquent ORM
   public function __construct()
   {
       $this->class = new Group;
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

   //get method
   public function get(Request $request)
   {
       $idUser= $request->input('id');
       return Group::get($idUser);
   }

   //set method
   public function set(Request $request)
   {
       $idUser= $request->input('id');
       $idGroups= $request->input('groups');
       try
       {
           Group::set($idUser,$idGroups);
           $message['message']='success';
       }
       catch(Exception $e){
           $message['message']=$e->getMessage();
       }
       return json_encode($message);
   }
}
