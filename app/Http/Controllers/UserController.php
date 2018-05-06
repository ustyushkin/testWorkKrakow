<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\User;

class UserController extends Controller
{
    //use Eloquent ORM
    public function list(Request $request)
    {
        $start = $request->input('start');
        $limit = $request->input('limit');
        return User::list($start,$limit);
    }

    //create method
    public function create(Request $request)
    {
        $data = $request->input('data');
        $decodedData = json_decode($data);
        $message['data']=[];
        try{
            //extjs sends more than one entry when there are more than one operations
            if (count($decodedData)>1){
                foreach ($decodedData as $array) {
                    array_push($message['data'],User::create($array));
                }
            }
            else {
                //and one entry when one operation
                array_push($message['data'],User::create($decodedData));
            }
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
        $data = $request->input('data');
        $decodedData = json_decode($data);
        try{
            //extjs sends more than one entry when there are more than one operations
            if (count($decodedData)>1){
                foreach ($decodedData as $array) {
                    User::update($array);
                }
            }
            else {
                //and one entry when one operation
                User::update($decodedData);
            }
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
        $data = $request->input('data');
        $decodedData = json_decode($data);
        try{
            //extjs sends more than one entry when there are more than one operations
            if (count($decodedData)>1){
                foreach ($decodedData as $array) {
                    User::delete($array);
                }
            }
            else {
                //and one entry when one operation
                User::delete($decodedData);
            }
            $message['message']='success';
        }
        catch(Exception $e){
            $message['message']=$e->getMessage();
        }
        return json_encode($message);
    }
}
