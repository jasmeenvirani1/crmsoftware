<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\MerchantCategory;
use App\Models\ProductCategory;
use App\Models\StockManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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

        $cat_sql = ProductCategory::groupBy('categories_id');
        if ($type == 'selected') {
            $product_ids_arr = $request->product_ids;
        } else {
            $product_ids_arr = StockManagement::pluck('id')->toArray();
        }

        $cat_ids = $cat_sql
            ->whereIn('product_id', $product_ids_arr)
            ->get('categories_id')
            ->pluck('categories_id')
            ->toArray();

        $product = MerchantCategory::whereIn('id', $cat_ids);

        if ($type == 'selected') {
            $product = $product->with([
                'productIds' => function ($query) use ($product_ids_arr) {
                    $query->whereIn('product_id', $product_ids_arr)->with('product.productImages');
                },
            ]);
        } else {
            $product = $product->with(['productIds.product.productImages']);
        }
        $product = $product->get();
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
        return DataTables::of(
            StockManagement::with(['productImages', 'categories.GetCategoriesName'])
                ->select('*')
                ->orderBy('updated_at', 'desc') // Order by updated_at column in descending order
                ->get(),
        )->make(true);
    }
}
