<?php
namespace App\Http\Controllers;
use App\Models\Compra;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompraController extends Controller
{
    public function index()
    {
        $compras = Compra::with('proveedor')->get();
        return view('compras.index', compact('compras'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'proveedor_id' => 'required|exists:clientes,id',
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Compra::create($request->all());
        return redirect()->route('compras.index')->with('success', 'Compra creada con éxito');
    }

    public function show(Compra $compra)
    {
        return view('compras.show', compact('compra'));
    }

    public function update(Request $request, Compra $compra)
    {
        $validator = Validator::make($request->all(), [
            'proveedor_id' => 'required|exists:clientes,id',
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $compra->update($request->all());
        return redirect()->route('compras.index')->with('success', 'Compra actualizada con éxito');
    }

    public function destroy(Compra $compra)
    {
        $compra->delete();
        return redirect()->route('compras.index')->with('success', 'Compra eliminada con éxito');
    }
}