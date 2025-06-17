<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        return Cliente::all(); // <- Listado
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email',
            'NIT' => 'required|unique:clientes,NIT',
        ]);

        return Cliente::create($request->all());
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email',
            'NIT' => 'required|unique:clientes,NIT,' . $cliente->id,
        ]);

        $cliente->update($request->all());
        return $cliente;
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return response()->json(['mensaje' => 'Eliminado']);
    }
}
