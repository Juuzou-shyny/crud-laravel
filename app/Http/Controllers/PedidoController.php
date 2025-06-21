<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\DetallePedido;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos = Pedido::with(['user', 'detallesPedido.producto'])
            ->where('user_id', Auth::id())
            ->where('estado', '!=', Pedido::ESTADO_CARRITO)
            ->orderBy('fecha_pedido', 'desc')
            ->paginate(10);

        return Inertia::render('Pedidos/Index', [
            'pedidos' => $pedidos
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        // Verificar que el pedido pertenece al usuario
        if ($pedido->user_id !== Auth::id()) {
            abort(403);
        }

        $pedido->load(['user', 'detallesPedido.producto']);

        return Inertia::render('Pedidos/Show', [
            'pedido' => $pedido,
            'estadosDisponibles' => [
                'PENDIENTE' => Pedido::ESTADO_PENDIENTE,
                'ENVIADO' => Pedido::ESTADO_ENVIADO,
                'ENTREGADO' => Pedido::ESTADO_ENTREGADO
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        // Verificar que el pedido pertenece al usuario
        if ($pedido->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'estado' => 'required|in:'.implode(',', [
                Pedido::ESTADO_PENDIENTE,
                Pedido::ESTADO_ENVIADO,
                Pedido::ESTADO_ENTREGADO
            ])
        ]);

        $pedido->update([
            'estado' => $request->estado
        ]);

        return redirect()->back()->with('success', 'Estado del pedido actualizado');
    }


    /**
 * Mostrar todos los pedidos (solo para administradores)
 */



public function indexAll()
{
    // 1. Valida sesión iniciada
    if (! Auth::check()) {
        return redirect()->route('login');
    }

    // 2. Carga usuario fresco desde DB
    $userId = Auth::id();
    $user = User::findOrFail($userId);
    // 3. Valida rol admin
    if (! $user->is_admin) {
        abort(403, 'Acceso denegado. Solo los administradores pueden ver esto.');
    }

    // 4. Cargar todos los pedidos (menos carritos)
    $pedidos = Pedido::with(['user', 'detallesPedido.producto'])
        ->where('estado', '!=', Pedido::ESTADO_CARRITO)
        ->paginate(10);

    return Inertia::render('Pedidos/Admin/Index', [
        'pedidos' => $pedidos
    ]);
}

}
