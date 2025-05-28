<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Client::latest()->get();

            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $actionBtns = '
                        <a href="' . route("client.edit", $row->id) . '" class="btn btn-outline-info btn-sm"><i class="fas fa-pen"></i></a>
                        
                        <form action="' . route("client.destroy", $row->id) . '" method="POST" style="display:inline" onsubmit="return confirm(\'Deseja realmente excluir este registro?\')">
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

       return view('clients.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('clients.crud');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $name = $request->post('client');
        $email = $request->post('email');
        $phone = $request->post('phone');
        $address = $request->post('address');
        $cep = $request->post('cep');
        $city = $request->post('city');
        $cpf = $request->post('cpf');
        $rg = $request->post('rg');

        $client = new Client();
        $client->name = $name;
        $client->email = $email;
        $client->phone = $phone;
        $client->cep = $cep;
        $client->address = $address;
        $client->city = $city;
        $client->cpf = $cpf;
        $client->rg = $rg;
        $client->origin_user = $user->name;
        $client->last_user = $user->name;
        $client->save();

        return view('clients.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edit = Client::find($id);

        $output = array(
            'edit' => $edit,
        );

        return view('clients.crud', $output);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $name = $request->post('client');
        $email = $request->post('email');
        $phone = $request->post('phone');
        $address = $request->post('address');
        $cep = $request->post('cep');
        $city = $request->post('city');
        $cpf = $request->post('cpf');
        $rg = $request->post('rg');

        $client = Client::find($id);

        $client->name = $name;
        $client->email = $email;
        $client->phone = $phone;
        $client->cep = $cep;
        $client->address = $address;
        $client->city = $city;
        $client->cpf = $cpf;
        $client->rg = $rg;
        $client->origin_user = $user->name;
        $client->last_user = $user->name;
        $client->update();
        return view('clients.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();

        return view('clients.index')->with('success', 'Cliente deletado com sucesso!');
    }

    public function cep(Request $request){
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
