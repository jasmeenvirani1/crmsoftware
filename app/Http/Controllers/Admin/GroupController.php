<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->data['title'] = 'Groups';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.group.index', ['title' => $this->data['title']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return Datatables::of(Group::orderBy('id', 'desc')->get())->make(true);
        $groupQuery = Group::latest('updated_at');
        return Datatables::of($groupQuery)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.group.form', ['title' => $this->data['title'], 'btn' => 'Save', 'action' => 'create']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => [
                    'required',
                    Rule::unique('groups', 'name')->where(function ($query) {
                        return $query->whereNull('deleted_at');
                    }),
                ],
            ]);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator->errors());
            }

            DB::beginTransaction();
            $input = AddDateTime($request);
            // Apply desired ordering here
            $model = Group::orderBy('id', 'desc')
                ->orderBy('created_at', 'desc')
                ->insert($input);
            DB::commit();

            if ($model) {
                session()->flash('success', 'Group created successfully');
            } else {
                session()->flash('error', 'There is something wrong. Please try again later.');
            }
            return redirect()->route('group.index');
        } catch (Exception $e) {
            DB::rollback();
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
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
                'name' => [
                    'required',
                    Rule::unique('groups', 'name')
                        ->where(function ($query) {
                            return $query->whereNull('deleted_at');
                        })
                        ->ignore($id),
                ],
            ]);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator->errors());
            }
            DB::beginTransaction();
            $input = AddDateTime($request, 'edit');

            // Apply desired ordering here
            $model = Group::orderBy('created_at', 'desc')
                ->find($id)
                ->update($input);
            DB::commit();

            if ($model) {
                session()->flash('success', 'Group updated successfully');
            } else {
                session()->flash('error', 'There is something wrong. Please try again later.');
            }
            return redirect()->route('group.index');
        } catch (Exception $e) {
            DB::rollback();
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the speci
     * fied resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Group::find($id);
        return view('admin.group.form', ['title' => $this->data['title'], 'btn' => 'Update', 'action' => 'edit', 'data' => $data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $arr['deleted_at'] = GetDateTime();
        try {
            Group::findorfail($id)->update($arr);
            $response = ['status' => 'success', 'msg' => 'Record Deleted Successfully.', 'error_code' => 200];
        } catch (Exception $e) {
            $response = ['status' => 'error', 'msg' => $e->getMessage(), 'error_code' => 422];
        }
        return response()->json($response, $response['error_code']);
    }

    public function ChangeGroupId(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'group_id' => 'required',
        ]);
        if (!$validator->fails()) {
            $user = Auth::user();
            $user->group_id = $request->group_id;
            $user->save();
        }
        return redirect()->back();
    }
}
