<?php

namespace App\Http\Controllers;


use App\Models\Sale;
use App\Models\User;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
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
            $data = Sale::with(['client', 'employee', 'product'])->select('sales.*');
            return DataTables::of($data)
                ->addColumn('client_name', fn($row) => $row->client->name ?? '')
                ->addColumn('employee_name', fn($row) => $row->employee->name ?? '')
                ->addColumn('sale_date', function ($row) {
                    return $row->sale_date ? \Carbon\Carbon::parse($row->sale_date)->format('d/m/Y') : '';
                })
                ->addColumn('product_name', fn($row) => $row->product->name ?? '')
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

        $clients = Client::all();
        $employees = User::all();
        $products = Product::all();
        return view('sales.index', compact('clients', 'employees', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $employees = User::all();
        $products = Product::all();
        return view('sales.crud', compact('clients', 'employees', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $client_id = $request->post('client_id');
        $employee_id = $request->post('employee_id');
        $product_id = $request->post('products');
        $quantity = $request->post('quantity');
        $sale_date = $request->post('sale_date');
        $total_price = $request->post('total_price');
        $payment_method = $request->post('payment_method');
        $status = $request->post('status');

        $product = Product::find($product_id);
        if ($product && $product->quantity >= $quantity) {
            $product->quantity -= $quantity;
            $product->save();
        } else {
            return back()->with('error', 'Estoque insuficiente para este produto.');
        }
        $total_price = $product ? $product->unit_price * $quantity : 0;



        $sale = new Sale();

        $sale->client_id = $client_id;
        $sale->employee_id = $employee_id;
        $sale->product_id = $product_id;
        $sale->quantity = $quantity;
        $sale->sale_date = $sale_date;
        $sale->total_price = $total_price;
        $sale->payment_method = $payment_method;
        $sale->status = $status;
        $sale->origin_user = $user->name;
        $sale->save();

        return redirect()->route('sale.index')->with('success', 'Venda registrada com sucesso!');

        if ($request->input('action') === 'newRegister') {
            return redirect()->route('sale.create')->with('success', 'Venda registrada! Pronto para novo cadastro.');
        }

        return redirect()->route('sale.index')->with('success', 'Venda registrada com sucesso!');
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
        $employees = User::all();
        $products = Product::all();

        return view('sales.crud', compact('sale', 'clients', 'employees', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $products = $request->input('products');
        $quantities = $request->input('quantities');

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
        return view('sale.index')->with('success', 'Venda atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sale = Sale::find($id);
        $sale->delete();
        return view('sale.index')->with('error', 'Venda não encontrada!');
    }
}
