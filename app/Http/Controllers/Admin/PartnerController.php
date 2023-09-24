<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Upload_Files;
use App\Models\Partner;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PartnerController extends Controller
{
    //
    use Upload_Files;

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $admins = Partner::query()->latest();
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
                ->editColumn('image', function ($row) {
                    $link = get_file($row->image);
                        return '
                              <a data-fancybox="" href="' . $link . '">
                                <img height="60px" src="' . $link . '">
                            </a>
                             ';


                })
                ->editColumn('created_at', function ($admin) {
                    return date('Y/m/d', strtotime($admin->created_at));
                })
                ->escapeColumns([])
                ->make(true);


        }
        return view('Admin.CRUDS.partners.index');
    }


    public function create()
    {

        return view('Admin.CRUDS.partners.parts.create');
    }

    public function store(Request $request)
    {


        $data = $request->validate([
            'image' => 'required|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',

        ]);

        if ($request->image)
            $data["image"] = $this->uploadFiles('partners', $request->file('image'), null);


        Partner::create($data);


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
        $row = Partner::findOrFail($id);
        return view('Admin.CRUDS.partners.parts.edit', compact('row'));

    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',

        ]);

        if ($request->image)
            $data["image"] = $this->uploadFiles('partners', $request->file('image'), 'yes');



        $row = Partner::findOrFail($id);

        $row->update($data);


        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!',
            ]);
    }


    public function destroy($id)
    {
        $row = Partner::findOrFail($id);

        $row->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);
    }//end fun
}
