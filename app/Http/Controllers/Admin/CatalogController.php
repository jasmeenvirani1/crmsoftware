<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StockManagement;
use Illuminate\Http\Request;
use Spipu\Html2Pdf\Html2Pdf;
use PDF;


class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.catalog.index', ['title' => "Catalog"]);
    }
    public function GetCatalog($type, Request $request)
    {
        $sql = StockManagement::with(['productImages']);
        if ($type == 'all') {
            $product_data =  $sql->get();
        } elseif ($type == 'selected') {
            $product_data =  $sql->whereIn('id', $request->product_ids)->get();
        }
        view()->share('product_data', $product_data);

        return view('admin.catalog.pdf_template');
    }
}
