<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MerchantCategory;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use Auth;



class MerchantCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index', ['title' => " Category"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create', ['title' => " Category", 'btn' => "Save", 'data' => []]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // $validator = Validator::make($request->all(), [
            //     'name' => 'required | unique:merchant_categories',
            // ]);
            // $validator = Validator::make($request->all(), [
            //     'name' => [
            //         'required',
            //         Rule::unique('merchant_categories')->ignore($request->id, 'id')
            //     ],
            // ]);
            $group_id = Auth::user()->group_id;
            $validator = Validator::make($request->all(), [
                'name' => [
                    'required',
                    Rule::unique('merchant_categories')->where(function ($query) use ($request,$group_id) {
                        return $query->where('group_id',$group_id);
                    })->ignore($request->id, 'id')
                ],
            ]);

            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }
            $files = [];
            if ($request->file('image')) {
                $file = $request->file('image');
                $filename = 'category-photo' . rand() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('images/category_photo', $filename);
                $file->move(public_path('images/category_photo'), $filename);
                $files[] = $filename;
            }
            // dd($files);
            $recordId = MerchantCategory::updateOrCreate(['id' => $request->id], ['name' => $request->name]);
            // $recordId = MerchantCategory::updateOrCreate(['id' => $request->id], ['name' => $request->name,'images' =>$files]);
            // dd($recordId);
            if ($recordId) {
                session()->flash('success', 'Category created successfully');
            } else {
                session()->flash('error', "There is some thing went, Please try after some time.");
            }
            return redirect()->route('category.index');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('category.create');
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return Datatables::of(MerchantCategory::all())->make(true);
        $merchantCategoriesQuery = MerchantCategory::orderBy('updated_at', 'desc'); // Order by updated_at in descending order
        return Datatables::of($merchantCategoriesQuery)->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.category.edit', ['title' => "  Category", 'btn' => "Update", 'data' => MerchantCategory::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = MerchantCategory::find($id);
        $data->delete();
        $response = array('status' => 'success', 'msg' => 'Record Deleted Successfully.');
        return response()->json($response);
    }
}
