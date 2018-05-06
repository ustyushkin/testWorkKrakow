<?php

namespace App\Http;

use App\GroupModel;
use App\UserInGroupModel;

class group
{
    //get list for paging view
    public static function list($start, $limit)
    {
        $users = GroupModel::all();
        $countOfUsers = $users->count();
        $results = GroupModel::skip(intval($start))->take(intval($limit))->get();
        return array("group"=>$results,"totalCount"=>$countOfUsers);
    }

    //create group
    public static function create($array)
    {
        $group = new GroupModel;
        foreach ($array as $fields=>$value) {
            if ($fields!='id')
            {
                $group->$fields = $value;
            }
            else {
                //for return - unreal id
                $returnId = $value;
            }
        }
        $group->save();
        $id = $group->id;
        return array('id'=>$id,'clientId'=>$returnId);
    }

    //update group
    public static function update($array)
    {
        $user = GroupModel::find($array->id);
        foreach ($array as $fields=>$value) {
            if ($fields!='id')
            {
                $user->$fields = $value;
            }
        }
        $user->save();
        return true;
    }

    //delete group and matches in useringroup
    public static function delete($array)
    {
        $user = GroupModel::find($array->id)->delete();
        $useringroup = UserINGroupModel::where('idGroup',$array->id)->delete();
        return true;
    }

    //get group for user
    public static function get($value)
    {
        $users = UserInGroupModel::where('idUser', $value)->get();
        $groups = $users->pluck('idGroup');
        return $groups;
    }

    //set group for user
    public static function set($valueIdUser,$valueIdGroup)
    {
        $idGroupsArray = explode (',',$valueIdGroup);
        $deletedRows = UserInGroupModel::where('idUser', $valueIdUser)->delete();
        if (!is_null($valueIdGroup))
        {
            foreach ($idGroupsArray as $idGroupKey)
            {
                $uig = new UserInGroupModel;
                $uig->idUser = $valueIdUser;
                $uig->idGroup = $idGroupKey;
                $uig->save();
            }
        }
        return true;
    }
}
