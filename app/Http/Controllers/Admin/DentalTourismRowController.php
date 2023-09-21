<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DentalTourism;
use App\Models\DentalTourismRow;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DentalTourismRowController extends Controller
{
    //
    public function index(Request $request)
    {
        $dental=DentalTourism::findOrFail($request->dental_tourism_id);

        if ($request->ajax()) {
            $admins = DentalTourismRow::query()->where('dental_tourism_id',$dental->id)->latest();
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


                ->editColumn('created_at', function ($admin) {
                    return date('Y/m/d', strtotime($admin->created_at));
                })
                ->escapeColumns([])
                ->make(true);


        }
        return view('Admin.CRUDS.dentalRows.index',compact('dental'));
    }


    public function create(Request $request)
    {
        $dental=DentalTourism::findOrFail($request->dental_tourism_id);

        return view('Admin.CRUDS.dentalRows.parts.create',compact('dental'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'type' => 'required|in:title1,title2',
            'dental_tourism_id'=>'required|exists:dental_tourisms,id'



        ]);


        DentalTourismRow::create($data);


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
        $row=DentalTourismRow::findOrFail($id);

        return view('Admin.CRUDS.dentalRows.parts.edit', compact('row'));

    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required',
            'type' => 'required|in:title1,title2',
        ]);



        DentalTourismRow::findOrFail($id)->update($data);


        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!',
            ]);
    }


    public function destroy( $id)
    {
        DentalTourismRow::findOrFail($id)->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);
    }//end fun
}
