<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryMember;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryMemberController extends Controller
{
    //
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $admins = CategoryMember::query()->latest();
            return DataTables::of($admins)
                ->addColumn('action', function ($admin) {

                    $edit = '';
                    $delete = '';


                    return '
                            <button ' . $edit . '  class="editBtn btn rounded-pill btn-primary waves-effect waves-light"
                                    data-id="' . $admin->id . '"
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="las la-edit"></i>
                                </span>
                            </span>
                            </button>
                            <button ' . $delete . '  class="btn rounded-pill btn-danger waves-effect waves-light delete"
                                    data-id="' . $admin->id . '">
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="las la-trash-alt"></i>
                                </span>
                            </span>
                            </button>
                       ';


                })


                ->editColumn('is_special', function ($row) {
                    $active = '';

                    $operation = '';



                    if ($row->is_special == 1)
                        $active = 'checked';

                    return '<div class="form-check form-switch">
                               <input ' . $operation . '  class="form-check-input activeBtn" data-id="' . $row->id . ' " type="checkbox" role="switch" id="flexSwitchCheckChecked" ' . $active . '  >
                           </div>';
                })



                ->editColumn('created_at', function ($admin) {
                    return date('Y/m/d', strtotime($admin->created_at));
                })
                ->escapeColumns([])
                ->make(true);


        }
        return view('Admin.CRUDS.memberCategories.index');
    }


    public function create()
    {

        return view('Admin.CRUDS.memberCategories.parts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'header_show' => 'required',
        ]);




        CategoryMember::create($data);


        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);
    }


    public function show($id)
    {


        //
    }


    public function edit($id)
    {
        $row=CategoryMember::findOrFail($id);
        return view('Admin.CRUDS.memberCategories.parts.edit', compact('row'));

    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required',
            'header_show' => 'required',

        ]);



        $row=CategoryMember::findOrFail($id);

        $row->update($data);


        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!',
            ]);
    }


    public function destroy( $id)
    {
        $row=CategoryMember::findOrFail($id);

        $row->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);
    }//end fun

    public function activate(Request $request)
    {

        $admin = CategoryMember::findOrFail($request->id);
        if ($admin->is_special == true) {
            $admin->is_special = 0;
            $admin->save();
        } else {
            $admin->is_special = 1;
            $admin->save();
        }

        return response()->json(['status' => true]);
    }//end fun

}
