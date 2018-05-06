<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Server;

class ServerController extends BaseController
{
   protected $class;
    //use Eloquent ORM
   public function __construct()
   {
       $this->class = new Server;
   }
   public function server(Request $request)
   {
       $start = $request->input('start');
       $limit = $request->input('limit');
       return $this->class::list($start,$limit);
   }
   //create method
   public function create(Request $request)
   {
       /*$data = $request->input('data');
       $decodedData = json_decode($data);*/
       $this->getInputData($request);
       try{
           //$class = new Server;
           $message['data'] = $this->IteratorExtJsResponse($this->decodedData,$this->class,'create');
           $message['message']='success';
       }
       catch(Exception $e){
           $message['message']=$e->getMessage();
       }
       return json_encode($message);
   }

   //update method
   public function update(Request $request)
   {
       $this->getInputData($request);
       try{
           $message['data'] = $this->IteratorExtJsResponse($this->decodedData,$this->class,'update');
           $message['message']='success';
       }
       catch(Exception $e){
           $message['message']=$e->getMessage();
       }
       return json_encode($message);
   }

   //delete method
   public function delete(Request $request)
   {
       $this->getInputData($request);
       try{
           $message['data'] = $this->IteratorExtJsResponse($this->decodedData,$this->class,'delete');
           $message['message']='success';
       }
       catch(Exception $e){
           $message['message']=$e->getMessage();
       }
       return json_encode($message);
   }
}
