<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Supplier::latest()->get();

            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $actionBtns = '
                        <a href="' . route("supplier.edit", $row->id) . '" class="btn btn-outline-info btn-sm"><i class="fas fa-pen"></i></a>
                        
                        <form action="' . route("supplier.destroy", $row->id) . '" method="POST" style="display:inline" onsubmit="return confirm(\'Deseja realmente excluir este registro?\')">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn btn-outline-danger btn-sm ml-2")><i class="fas fa-trash"></i></button>
                        </form>
                    ';
                    return $actionBtns;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('suppliers.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.crud');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $name = $request->post('name');
        $email = $request->post('email');
        $phone = $request->post('phone');
        $cnpj = $request->post('cnpj');
        $address = $request->post('address');

        $supplier = new Supplier();
        $supplier->name = $name;
        $supplier->email = $email;
        $supplier->phone = $phone;
        $supplier->cnpj = $cnpj;
        $supplier->address = $address;
        $supplier->save();
        return view('suppliers.index')->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edit = Supplier::find($id);
        $output = [
            'edit' => $edit,
        ];
        return view('suppliers.crud', $output);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $name = $request->post('name');
        $email = $request->post('email');
        $phone = $request->post('phone');
        $cnpj = $request->post('cnpj');
        $address = $request->post('address');

        $supplier = Supplier::find($id);
        $supplier->name = $name;
        $supplier->email = $email;
        $supplier->phone = $phone;
        $supplier->cnpj = $cnpj;
        $supplier->address = $address;
        $supplier->update();
        return view('suppliers.index')->with('success', 'Fornecedor atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        return view('suppliers.index')->with('success', 'Fornecedor excluído com sucesso!');
    }
    public function cep(Request $request)
    {
        $cep = $request->input('cep');
        $url = "https://viacep.com.br/ws/{$cep}/json/";

        try {
            $response = Http::get($url);

            if ($response->successful()) {
                return response()->json($response->json());
            }
            return response()->json(['error' => 'Erro ao consultar o CEP.'], $response->status());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao consultar o CEP: ' . $e->getMessage()], 500);
        }
    }
}
