<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class ProfileController extends Controller
{
    public function getUser($id)
    {
        $user = User::where('id', $id)
        ->select('id', 'name', 'email')
        ->first();

        return response()->json($user);
    }

    public function storeUser(Request $req)
    {
        $user = User::where('id', $req->user_id)
        ->select('id', 'name', 'email')
        ->first();

        $user->name = $req->user['name'];
        $user->email = $req->user['email'];

        $user->save();
    }

    public function changePassword(Request $req)
    {
        $user = User::where('id', $req->user_id)
        ->select('id', 'name', 'email')
        ->first();

        $user->password = Hash::make($req->newPassword);

        $user->save();
    }
}
