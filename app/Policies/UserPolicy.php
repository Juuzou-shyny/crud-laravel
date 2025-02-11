<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Solo los administradores pueden ver la lista de usuarios.
     */
    public function viewAny(User $user)
    {
        return $user->is_admin ?? false; // Verifica si el usuario es administrador
    }

    /**
     * Solo los administradores pueden ver detalles de un usuario específico.
     */
    public function view(User $user, User $viewedUser)
    {
        return $user->is_admin ?? false;
    }

    /**
     * Solo los administradores pueden actualizar un usuario.
     */
    public function update(User $user, User $updatedUser)
    {
        return $user->is_admin ?? false;
    }

    /**
     * Solo los administradores pueden eliminar un usuario.
     */
    public function delete(User $user, User $deletedUser)
    {
        return $user->is_admin ?? false;
    }
}
