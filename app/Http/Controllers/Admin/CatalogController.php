<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\MerchantCategory;
use App\Models\ProductCategory;
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

        $cat_sql = ProductCategory::groupBy('categories_id');
        if ($type == 'selected') {
            $product_ids_arr = $request->product_ids;
        } else {
            $product_ids_arr = StockManagement::pluck('id')->toArray();
        }

        $un_cat_data = StockManagement::join('product_categories', 'product_categories.product_id', '!=', 'stock_management.id')
            ->whereIn('product_categories.product_id', $product_ids_arr)
            ->get()
            ->toArray();

        $cat_ids = $cat_sql
            ->whereIn('product_id', $product_ids_arr)
            ->get('categories_id')
            ->pluck('categories_id')
            ->toArray();

        $product = MerchantCategory::whereIn('id', $cat_ids);

        if ($type == 'selected') {
            $product = $product->with([
                'productIds.product.productImages' => function ($query) use ($request) {
                    $query->whereIn('product_id', $request->product_ids);
                },
                'productIds.product',
            ]);
        } else {
            $product = $product->with(['productIds.product.productImages']);
        }
        $product = $product->get();
        view()->share('product_data', $product);
        view()->share('catalog_data', $catalog_data);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.catalog.invoice', ['product_data' => $product, 'catalog_data' => $catalog_data]);
        $download = $pdf->download('sadsa.pdf');
        // return view('admin.catalog.pdf_template');
        return $download;

        // return response()->json(['message' => 'PDF generated and saved successfully']);
        // prx($product);
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
