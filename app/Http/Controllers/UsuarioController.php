<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index(): Response
    {
        $usuarios = User::select('id', 'nombre', 'apellido', 'email', 'estado')->get();

        return Inertia::render('Users/Index', [
            'usuarios' => $usuarios
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        User::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'feccre' => Carbon::today()->toDateString(),
            'estado' => $request->estado,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('userIndex')->with('success', 'Usuario creado correctamente.');
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return Inertia::render('Users/Create', ['usuario' => $usuario]);
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6', // No obligatorio en edición
            'estado' => 'required|in:A,I'
        ]);
        $usuario->nombre = $validated['nombre'];
        $usuario->apellido = $validated['apellido'];
        $usuario->email = $validated['email'];
        $usuario->estado = $validated['estado'];

        if (!empty($validated['password'])) {
            $usuario->password = Hash::make($validated['password']);
        }
        $usuario->save();
        return redirect()->route('userIndex')->with('success', 'Usuario actualizado correctamente.');
    }

    public  function userStatus($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->estado = $usuario->estado === 'A' ? 'I' : 'A';
        $usuario->save();
        return back()->with('success', 'Estado del usuario actualizado correctamente.');
    }


}
