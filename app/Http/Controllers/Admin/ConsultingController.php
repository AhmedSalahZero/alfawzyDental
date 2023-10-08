<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OnlineConsulting;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ConsultingController extends Controller
{
    //

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $admins = OnlineConsulting::query()->latest();
            return DataTables::of($admins)
                ->addColumn('action', function ($admin) {

                    $edit = '';
                    $delete = '';


                    return '

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

                ->addColumn('images', function ($row) {
                    $link=route('online_consulting_images.index',$row->id);
                    return "<a href='$link' class='btn btn-outline-dark'>Show Images</a>" ;
                })


                ->editColumn('created_at', function ($admin) {
                    return date('Y/m/d', strtotime($admin->created_at));
                })
                ->escapeColumns([])
                ->make(true);


        }
        return view('Admin.onlineConsulting.index');
    }




    public function destroy( $id)
    {
        $row=OnlineConsulting::findOrFail($id);

        $row->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);
    }//end fun
}
