<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsersResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function getUsers()
    {
        $users = User::with(['roles', 'services'])
        ->orderBy('is_admin', 'desc')
        ->get();

        return UsersResource::collection($users);
    }

    public function getSingleUser($id)
    {
        $user = User::find($id);

        return response()->json($user);
    }

    public function blockUser($id)
    {
       $user = User::where('id', $id)->first();

       if ($user->blocked == 0)
       {
           $user->blocked = 1;
           $message = "Пользователь заблокирован.";
       } else
       {
           $user->blocked = 0;
           $message = "Пользователь разблокирован.";
       }

       $user->save();

       return response()->json($message);
    }

    public function addUser(Request $req)
    {
        $user = [
            'name' => $req->user['userName'],
            'login' => $req->user['userLogin'],
            'email' => $req->user['userEmail'],
            'password' => Hash::make($req->user['userPass']),
            'service_id' => $req->user['userService'],
            'is_admin' => $req->user['userIsAdmin'] ? 1 : 0,
            'created_at' =>  date("Y-m-d H:i:s"),
            'updated_at' =>  date("Y-m-d H:i:s"),
        ];

        User::insert($user);

        return response()->noContent();
    }

    public function updateUser(Request $req)
    {
        $user = User::where('id', '=', $req->user['id'])->first();

        $user->name = $req->user['name'];
        $user->login = $req->user['login'];
        $user->email = $req->user['email'];
        $user->service_id = $req->user['service_id'];
        if (isset($req->user['password']))
        {
            $user->password =  Hash::make($req->user['password']);
        }
        $user->is_admin = $req->user['is_admin'] ? 1 : 0;
        $user->updated_at = date("Y-m-d H:i:s");

        $user->save();

        return response()->noContent();
    }
}
