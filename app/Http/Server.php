<?php

namespace App\Http;

use App\ServerModel;

class Server
{
    //get list for paging view
    public static function list($start, $limit)
    {
        $users = ServerModel::all();
        $countOfUsers = $users->count();
        $results = ServerModel::skip(intval($start))->take(intval($limit))->get();
        return array("server"=>$results,"totalCount"=>$countOfUsers);
    }

    //create user
    public static function create($array)
    {
        $returnId='';
        $user = new ServerModel;
        foreach ($array as $fields=>$value) {
            if ($fields!='id')
            {
                $user->$fields = $value;
            }
            else {
                $returnId = $value;
            }
        }
        $user->save();
        $id = $user->id;
        return array('id'=>$id,'clientId'=>$returnId);
    }

    //update user
    public static function update($array)
    {
        $user = ServerModel::find($array->id);
        foreach ($array as $fields=>$value) {
            if ($fields!='id')
            {
                $user->$fields = $value;
            }
        }
        $user->save();
        return true;
    }

    //delete user
    public static function delete($array)
    {
        $user = ServerModel::find($array->id)->delete();
        //$useringroup = UserINGroupModel::where('idUser',$array->id)->delete();
        return true;
    }
}
