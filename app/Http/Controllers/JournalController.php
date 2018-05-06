<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Journal;

class JournalController extends BaseController
{
   protected $class;
    //use Eloquent ORM
   public function __construct()
   {
       $this->class = new Journal;
   }
   public function journal(Request $request)
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

/*namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Journal;
//use App\JournalModel;
//use DB;

class JournalController extends Controller
{
    //use Eloquent ORM
   public function journal(Request $request)
   {
       $start = $request->input('start');
       $limit = $request->input('limit');
       return Journal::list($start,$limit);
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
                   array_push($message['data'],Journal::create($array));
               }
           }
           else {
               //and one entry when one operation
               array_push($message['data'],Journal::create($decodedData));
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
                   Journal::update($array);
               }
           }
           else {
               //and one entry when one operation
               Journal::update($decodedData);
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
                   Journal::delete($array);
               }
           }
           else {
               //and one entry when one operation
               Journal::delete($decodedData);
           }
           $message['message']='success';
       }
       catch(Exception $e){
           $message['message']=$e->getMessage();
       }
       return json_encode($message);
   }*/
  /*public function journal(Request $request)
  {

      $page = $request->input('page');
      $start = $request->input('start');
      $limit = $request->input('limit');
      $result = DB::connection('mysql')->select('select COUNT(*) as totalCount from journal');
      $countOfServer = $result[0]->totalCount;
		$results = DB::connection('mysql')->select('select * from journal LIMIT '.$start.', '.$limit);
		$responceForPagination = array("journal"=>$results,"totalCount"=>$countOfServer);
      return $responceForPagination;

	}
	public function create(Request $request)
  	{
      $data = $request->input('data');
  		$decodedData = json_decode($data);
        $message['data']=[];
  		try{
            //extjs sends more than one entry when there are more than one operations
      		if (count($decodedData)>1){
      			foreach ($decodedData as $array) {
                    $journal = new JournalModel;
                    foreach ($array as $fields=>$value) {
                        if ($fields!='id')
                        {
                            $journal->$fields = $value;
                        }
                        else {
                            //for return - unreal id
                            $returnId = $value;
                        }
                    }
                    $journal->save();
                    $id = $journal->id;
                    //return array('id'=>$id,'clientId'=>$returnId);
                    array_push($message['data'],array('id'=>$id,'clientId'=>$returnId));
    			}
    		}
    		else {
                //and one entry when one operation
                $journal = new JournalModel;
                foreach ($decodedData as $fields=>$value) {
                    if ($fields!='id')
                    {
                        $journal->$fields = $value;
                    }
                    else {
                        //for return - unreal id
                        $returnId = $value;
                    }
                }
                $journal->save();
                $id = $journal->id;
                array_push($message['data'],array('id'=>$id,'clientId'=>$returnId));
    		}
    		$message['message']='success';
		}
		catch(Exception $e){
    		$message['message']=$e->getMessage();
		}
        return json_encode($message);

	}
	public function update(Request $request)
  	{
  		$data = $request->input('data');
  		$decodedData = json_decode($data);
  		$updatePart = "";
      try{
  		if (count($decodedData)>1){
  			foreach ($decodedData as $arr) {
    			foreach ($arr as $fields=>$value) {
    				if ($fields!='id')
    				{
    					$updatePart = $updatePart.$fields.'=\''.$value.'\',';
    				}
    				else
    				{
    					$id = $value;
    				}
    			}
    			$results = DB::connection('mysql')->select('UPDATE journal SET '.substr($updatePart, 0, -1).' WHERE id='.$id);
    			$updatePart = "";
			}
		}
		else {
			foreach ($decodedData as $fields=>$value) {
    			if ($fields!='id')
    			{
    				$updatePart = $updatePart.$fields.'=\''.$value.'\',';
    			}
    			else
    			{
    				$id = $value;
    			}
    		}
    		$results = DB::connection('mysql')->select('UPDATE journal SET '.substr($updatePart, 0, -1).' WHERE id='.$id);
		}
		$message['message']='success';
		}
		catch(Exception $e){
    		$message['message']=$e->getMessage();
		}

      return json_encode($message);

	}
	public function delete(Request $request)
  	{
      $data = $request->input('data');
  		$decodedData = json_decode($data);
  		$deletePart = "";
      try{
  		if (count($decodedData)>1){
  			foreach ($decodedData as $arr) {
    			foreach ($arr as $fields=>$value) {
    				if ($fields=='id')
    				{
    					$deletePart = $deletePart.$fields.'=\''.$value.'\' or ';
    				}
    			}
    			$results = DB::connection('mysql')->select('DELETE FROM journal WHERE '.substr($deletePart, 0, -4));
    			$deletePart = "";
			}
		}
		else {
			foreach ($decodedData as $fields=>$value) {
    			if ($fields=='id')
    			{
    				$deletePart = $deletePart.$fields.'=\''.$value.'\' or ';
    			}
    		}
    		$results = DB::connection('mysql')->select('DELETE FROM journal WHERE '.substr($deletePart, 0, -4));
		}
		$message['message']='success';
		}
		catch(Exception $e){
    		$message['message']=$e->getMessage();
		}

      return json_encode($message);

  }
}*/
