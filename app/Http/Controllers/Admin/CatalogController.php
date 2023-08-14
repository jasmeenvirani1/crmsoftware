<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\StockManagement;
use Illuminate\Http\Request;
use Spipu\Html2Pdf\Html2Pdf;
use PDF;
use Yajra\DataTables\Facades\DataTables;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.catalog.index', ['title' => 'Catalog']);
    }

    public function GetCatalog($type, Request $request)
    {
        $catalog_data = Customer::where('default', '1')->first();
        $sql = StockManagement::with(['productImages', 'category']);
        if ($type == 'all') {
            $product_data = $sql->get();
        } elseif ($type == 'selected') {
            $product_data = $sql->whereIn('id', $request->product_ids)->get();
        }
        if (!$catalog_data) {
            echo 'Please select company';
        }

        view()->share('product_data', $product_data);
        view()->share('catalog_data', $catalog_data);
        return view('admin.catalog.pdf_template');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return DataTables::of(StockManagement::with('productImages')->select('*')->orderBy('id', 'desc')->get())->make(true);
        return DataTables::of(
            StockManagement::with('productImages', 'category')
                ->select('*')
                ->orderBy('updated_at', 'desc') // Order by updated_at column in descending order
                ->get(),
        )->make(true);
    }
}
