<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function store(Request $request) //Ya Funciona
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',

                'password' => 'required',
                'edad' => 'required',

            ]);

        $user = User::create($data);

        return new UserResource($user);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'edad' => 'required',

        ]);

        $user->update($request->all());
        return new UserResource($user);
      /*  return [
            "status"=>1,
            "data"=>$user,
            "msg"=>"Usuario Actualizado"
        ];*/
    }


    public function destroy(User $user)
    {
        $user->delete();

        return new UserResource($user);
    }

    public function mayoresDe25()
    {

       $users=User::where('edad','>',25)->with('images')->get();

        return new UserCollection($users);
    }
}
