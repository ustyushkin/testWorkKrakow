<?php

namespace App\Http;

use App\JournalModel;

class Journal
{
    //get list for paging view
    public static function list($start, $limit)
    {
        $users = JournalModel::all();
        $countOfUsers = $users->count();
        $results = JournalModel::skip(intval($start))->take(intval($limit))->get();
        return array("journal"=>$results,"totalCount"=>$countOfUsers);
    }

    //create user
    public static function create($array)
    {
        $returnId='';
        $user = new JournalModel;
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
        $user = JournalModel::find($array->id);
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
        $user = JournalModel::find($array->id)->delete();
        //$useringroup = UserINGroupModel::where('idUser',$array->id)->delete();
        return true;
    }
}
