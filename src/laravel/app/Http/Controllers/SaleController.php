<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Client;
use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
           $data = Sale::with(['client', 'employee'])->select('sales.*');
            return DataTables::of($data)
                ->addColumn('client_name', fn($row) => $row->client->name ?? '')
                ->addColumn('employee_name', fn($row) => $row->employee->name ?? '')

                ->addColumn('action', function ($row) {
                    $actionBtns = '
                    <a href="' . route("sale.edit", $row->id) . '" class="btn btn-outline-info btn-sm"><i class="fas fa-pen"></i></a>
                    
                    <form action="' . route("sale.destroy", $row->id) . '" method="POST" style="display:inline" onsubmit="return confirm(\'Deseja realmente excluir este registro?\')">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                        <button type="submit" class="btn btn-outline-danger btn-sm ml-2"><i class="fas fa-trash"></i></button>
                    </form>
                ';
                    return $actionBtns;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('sales.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
           return view('sales.crud', compact('clients', 'employees'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $client_id = $request->post('client_id');
        $employee_id = $request->post('employee_id');
        $sale_date = $request->post('sale_date');
        $total_price = $request->post('total_price');
        $payment_method = $request->post('payment_method');
        $status = $request->post('status');

        $sale = new Sale();
        $sale->client_id = $client_id;
        $sale->employee_id = $employee_id;
        $sale->sale_date = $sale_date;
        $sale->total_price = $total_price;
        $sale->payment_method = $payment_method;
        $sale->status = $status;
        $sale->save();
        return redirect()->route('sale.index')->with('success', 'Venda criada com sucesso!');
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
        $sale = Sale::find($id);
        $clients = Client::all();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $client_id = $request->post('client_id');
        $employee_id = $request->post('employee_id');
        $sale_date = $request->post('sale_date');
        $total_price = $request->post('total_price');
        $payment_method = $request->post('payment_method');
        $status = $request->post('status');
        $sale = Sale::find($id);
        $sale->client_id = $client_id;
        $sale->employee_id = $employee_id;
        $sale->sale_date = $sale_date;
        $sale->total_price = $total_price;
        $sale->payment_method = $payment_method;
        $sale->status = $status;
        $sale->update();
        return redirect()->route('sale.index')->with('success', 'Venda atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sale = Sale::find($id);
        $sale->delete();
        return redirect()->route('sale.index')->with('error', 'Venda não encontrada!');
    }
}
