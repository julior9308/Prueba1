<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistroRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //Entrar al sistema
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'msg' => ['Credenciales Incorrectas.'],
            ]);
        }

        $token= $user->createToken($request->email)->plainTextToken;
        return response()->json([
            'res'=>true,
            'token'=>$token,
            'usuario'=>$user
        ],200);
    }

    public function salir(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'res'=>true,
            'Msg'=>'Token Eliminado'
        ],200);

    }


    public function store(RegistroRequest $request) //Ya Funciona
    {

        //$rolAdmin=Role::all();
        $datos=$request->only(['name','email','password','edad']);
        $user=UserService::crearUser($datos);


       // $user = User::create($data);

        return new UserResource($user);
       //return $rolAdmin;
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
