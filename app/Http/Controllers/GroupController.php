<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Group;

class GroupController extends Controller
{
    //use Eloquent ORM
    public function list(Request $request)
    {
        $start = $request->input('start');
        $limit = $request->input('limit');
        return Group::list($start,$limit);
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
                    array_push($message['data'],Group::create($array));
    			}
    		}
    		else {
                //and one entry when one operation
                array_push($message['data'],Group::create($decodedData));
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
        		    Group::update($array);
        	    }
            }
            else {
                //and one entry when one operation
                Group::update($decodedData);
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
                    Group::delete($array);
        	    }
            }
            else {
                //and one entry when one operation
            	Group::delete($decodedData);
            }
            $message['message']='success';
        }
        catch(Exception $e){
        	$message['message']=$e->getMessage();
        }
        return json_encode($message);
	}

    //set method
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
