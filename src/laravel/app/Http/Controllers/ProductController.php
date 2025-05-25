<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::with('supplier')->latest()->get();

            return DataTables::of($data)
                ->addColumn('supplier_name', function ($row) {
                    return $row->supplier ? $row->supplier->name : '';
                })
                ->addColumn('action', function ($row) {
                    $actionBtns = '
                    <a href="' . route("product.edit", $row->id) . '" class="btn btn-outline-info btn-sm"><i class="fas fa-pen"></i></a>
                    
                    <form action="' . route("product.destroy", $row->id) . '" method="POST" style="display:inline" onsubmit="return confirm(\'Deseja realmente excluir este registro?\')">
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

        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all(); // ou ->select('id', 'name')->get();
        return view('products.crud', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $name = $request->post('name');
        $description = $request->post('description');
        $type = $request->post('type');
        $quantity = $request->post('quantity');
        $price = $request->post('price');
        $brand = $request->post('brand');
        $supplier = $request->post('supplier_id');

        $product = new Product();
        $product->name = $name;
        $product->description = $description;
        $product->type = $type;
        $product->quantity = $quantity;
        $product->price = $price;
        $product->brand = $brand;
        $product->supplier_id = $supplier;
        $product->origin_user = $user->name;
        $product->last_user = $user->name;
        $product->save();
        return redirect()->route('product.index')->with('success', 'Produto cadastrado com sucesso!');
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
        $edit = Product::findOrFail($id);
        $suppliers = Supplier::all();
        return view('products.crud', compact('edit', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $user = Auth::user();
        $name = $request->post('name');
        $description = $request->post('description');
        $type = $request->post('type');
        $quantity = $request->post('quantity');
        $price = $request->post('price');
        $brand = $request->post('brand');
        $supplier = $request->post('supplier_id');

        $product = Product::find($id);
        $product->name = $name;
        $product->description = $description;
        $product->type = $type;
        $product->quantity = $quantity;
        $product->price = $price;
        $product->brand = $brand;
        $product->supplier_id = $supplier;
        $product->last_user = $user->name;
        $product->update();
        return redirect()->route('product.index')->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Produto excluído com sucesso!');
    }
}
