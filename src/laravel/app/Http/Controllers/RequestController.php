<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Request_item;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Request::with(['product', 'sale'])->select('requests.*');


            return DataTables::of($data)
                ->addColumn('product_name', fn($row) => $row->product->name ?? '')
                ->addColumn('action', function ($row) {
                    $actionBtns = '
                    <a href="' . route("request.edit", $row->id) . '" class="btn btn-outline-info btn-sm"><i class="fas fa-pen"></i></a>
                    
                    <form action="' . route("request.destroy", $row->id) . '" method="POST" style="display:inline" onsubmit="return confirm(\'Deseja realmente excluir este registro?\')">
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

        return view('requests.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sales = \App\Models\Sale::all();
        $products = \App\Models\Product::all();
        return redirect()->route('requests.crud');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sale_id = $request->post('sale_id');
        $product_id = $request->post('product_id');
        $quantity = $request->post('quantity');
        $unit_price = $request->post('unit_price');
        $total_price = $request->post('total_price');

        $request = new Request_item();

        $request->sale_id = $sale_id;
        $request->product_id = $product_id;
        $request->quantity = $quantity;
        $request->unit_price = $unit_price;
        $request->total_price = $total_price;
        $request->save();
        return redirect()->route('request.index')->with('success', 'Requisição criada com sucesso!');
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
       
        $sales = \App\Models\Sale::all();
        $products = \App\Models\Product::all();
        $edit = Request_item::find($id);
        $output = [
            'edit' => $edit,
        ];
        return redirect()->route('suppliers.crud', $output);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sale_id = $request->post('sale_id');
        $product_id = $request->post('product_id');
        $quantity = $request->post('quantity');
        $unit_price = $request->post('unit_price');
        $total_price = $request->post('total_price');

        $request_item = Request_item::find($id);

        $request_item->sale_id = $sale_id;
        $request_item->product_id = $product_id;
        $request_item->quantity = $quantity;
        $request_item->unit_price = $unit_price;
        $request_item->total_price = $total_price;
        $request->update();


        return redirect()->route('request.index')->with('error', 'Requisição não encontrada!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $request_item = Request_item::find($id);
        $request_item->delete();
        return redirect()->route('request.index')->with('error', 'Requisição não encontrada!');
    }
}
