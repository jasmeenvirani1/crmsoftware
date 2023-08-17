<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\MerchantCategory;
use App\Models\StockManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if (!$catalog_data) {
            prx('Please select company');
        }

        $cat_sql = StockManagement::groupBy('category');
        if ($type == 'selected') {
            $cat_sql = $cat_sql->whereIn('id', $request->product_ids);
        }

        $cat_ids = $cat_sql->get('category')->pluck('category')->toArray();
        $product = MerchantCategory::whereIn('id', $cat_ids);

        if ($type == 'selected') {
            $product = $product->with(['product.productImages', 'product' =>  function ($query) use ($request) {
                $query->whereIn('id', $request->product_ids);
            }]);
        } else {
            $product = $product->with(['product', 'product.productImages']);
        }
        $product = $product->get();
        // prx($product);
        view()->share('product_data', $product);
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
