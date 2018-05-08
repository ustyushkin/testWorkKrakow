<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{

   public function IteratorExtJsResponse($jsonParams,$object,$property)
   {
       $returnArray = [];
       $returnArray['data']=[];
       //extjs send more than one entry when are more than one operation
       if (count($jsonParams)>1){
           foreach ($jsonParams as $array) {
               array_push($returnArray['data'],call_user_func(array($object, $property), $array));
           }
       }
       else {
           //and one entry when one operation
           array_push($returnArray['data'],call_user_func(array($object, $property), $jsonParams));
       }
       $returnArray['message']='success';
       return $returnArray;
   }

   public function process($request,$method)
   {
       $data = $request->input('data');
       $decodedData = json_decode($data);
       try{
           $message = $this->IteratorExtJsResponse($decodedData,$this->class,$method);
       }
       catch(Exception $e){
           $message['message']=$e->getMessage();
       }
       return json_encode($message);
   }

   public function getList($request)
   {
       $start = $request->input('start');
       $limit = $request->input('limit');
       return $this->class::list($start,$limit);
   }
}
