<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Muestra el perfil del usuario autenticado.
     */
    public function showProfile()
    {
        $user = auth()->user(); // Obtiene el usuario autenticado
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tu perfil.');
        }

        return view('users.profile', compact('user'));
    }



    public function updateProfile(Request $request)
{
    /** @var User|null $user */
    $user = auth()->user();

    if (!$user) {
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para actualizar tu perfil.');
    }

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
    ]);

    $user->update($validated);

    return redirect()->route('user.profile')->with('success', 'Perfil actualizado correctamente.');
}

public function changePassword(Request $request)
{
    /** @var User|null $user */
    $user = auth()->user();

    if (!$user) {
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para cambiar tu contraseña.');
    }

    $validated = $request->validate([
        'current_password' => 'required|current_password',
        'new_password' => 'required|min:8|confirmed',
    ]);

    $user->password = Hash::make($validated['new_password']);
    $user->save(); // Intelephense ahora sabe que $user tiene el método save()

    return redirect()->route('user.profile')->with('success', 'Contraseña actualizada correctamente.');
}

public function orderHistory()
{
    /** @var User|null $user */
    $user = auth()->user();

    if (!$user) {
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tu historial de pedidos.');
    }

    $orders = $user->orders()->orderBy('created_at', 'desc')->get(); // Intelephense ahora reconoce orders()
    return view('users.order_history', compact('orders'));
}

    /**
     * Muestra la lista de usuarios (solo para administradores).
     */
    public function index()
    {
        $this->authorize('viewAny', User::class); // Solo administradores pueden ver esta página

        $users = User::all(); // Obtiene todos los usuarios
        return view('users.index', compact('users'));
    }



    /* Muestra los detalles de un usuario específico (solo para administradores).
    */
   public function show(User $user)
   {
       $this->authorize('view', $user); // Solo administradores pueden ver este usuario
       return view('users.show', compact('user'));
   }



       /**
     * Elimina un usuario específico (solo para administradores).
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user); // Solo administradores pueden eliminar este usuario

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }





}
