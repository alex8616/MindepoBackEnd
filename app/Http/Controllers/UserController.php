<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
     // LISTAR
    public function index(){
        $users = User::latest()
            ->get();

        return view(
            'users.index',
            compact('users')
        );
    }

    // FORM CREAR
    public function create(){
        return view('users.create');
    }

    // GUARDAR
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make(
                $request->password
            ),

            'telefono' => $request->telefono,
            'cargo' => $request->cargo,
            'activo' => $request->activo
                ? true
                : false,
        ]);

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'Usuario creado'
            );
    }

    // FORM EDITAR
    public function edit(User $user){
        return view(
            'users.edit',
            compact('user')
        );
    }

    // ACTUALIZAR
    public function update(
        Request $request,
        User $user
    ) {

        $request->validate([
            'name' => 'required',
            'email' =>
                'required|email|unique:users,email,' .
                $user->id,
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'cargo' => $request->cargo,
            'activo' => $request->activo
                ? true
                : false,
        ];

        // SOLO SI CAMBIA PASSWORD
        if ($request->password) {
            $data['password'] =
                Hash::make(
                    $request->password
                );
        }

        $user->update($data);

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'Usuario actualizado'
            );
    }

    // ELIMINAR
    public function destroy(User $user){
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'Usuario eliminado'
            );
    }

    public function GetUserFull(){
        $users = User::Get();
        return response()->json($users);
    }
}
