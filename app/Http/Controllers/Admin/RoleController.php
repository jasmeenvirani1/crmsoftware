<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.roles.index', ['title' => "Role"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create', ['title' => "Role", 'btn' => "Save", 'data' => []]);
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
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            $temp = AddDateTime($request);
            unset($temp['name'], $temp['created_at'], $temp['updated_at']);

            $input['permissions'] = json_encode($temp);
            $input['name'] = $request->name;

            $key = strtolower(preg_replace('/[^a-zA-Z0-9\-]/', '', str_replace(' ', '-', $request->name)));
            $input['key'] = $key;

            $count = Role::where('key', $key)->count();
            if ($count > 0) {
                session()->flash('error', ucfirst($key) . " role already exits.");
            } else {
                $recordId = Role::create($input);
            }

            if ($recordId) {
                session()->flash('success', 'Role created successfully');
            }
            return redirect()->route('role.index');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('role.create');
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
        return Datatables::of(Role::orderBy('id', 'desc')->get())->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Role::find($id);
        return view('admin.roles.edit', ['title' => "Role", 'btn' => "Update", 'data' => $data]);
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
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            $temp = AddDateTime($request);
            unset($temp['name'], $temp['created_at'], $temp['updated_at']);

            $input['permissions'] = json_encode($temp);
            $input['name'] = $request->name;

            $key = strtolower(preg_replace('/[^a-zA-Z0-9\-]/', '', str_replace(' ', '-', $request->name)));
            $input['key'] = $key;
            $recordId = Role::find($id)->update($input);

            if ($recordId) {
                session()->flash('success', 'Role updated successfully');
            }
            return redirect()->route('role.index');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('role.edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     **/
    public function destroy($id)
    {
        $data = Role::find($id)->delete();
        $response = array('status' => 'success', 'msg' => 'Role Deleted Successfully.');
        return response()->json($response);
    }
}
