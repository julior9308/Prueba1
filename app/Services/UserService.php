<?php
namespace App\Services;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class UserService
{
   static public function crearUser(array $datos)
    {
        $rolAdmin=Role::where('name','=','admin')->get();

        $user = new User();
        $user->name=$datos['name'];
        $user->password=bcrypt($datos['password']);
        $user->email=$datos['email'];
        $user->edad=$datos['edad'];
        $user->save();
        $user->assignRole($rolAdmin);
        return $user;
    }
}
