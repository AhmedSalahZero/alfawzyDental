<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Upload_Files;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class GalleryController extends Controller
{
    //
    use Upload_Files;

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $admins = Gallery::query()->latest();
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
                ->editColumn('file', function ($row) {
                    $link = get_file($row->file);
                    if ($row->type == 'image')
                        return '
                              <a data-fancybox="" href="' . $link . '">
                                <img height="60px" src="' . $link . '">
                            </a>
                             ';

                    return
                        "<a target='_blank' href='$link' class='btn btn-soft-info'>Show Video</a>";
                })
                ->editColumn('created_at', function ($admin) {
                    return date('Y/m/d', strtotime($admin->created_at));
                })
                ->escapeColumns([])
                ->make(true);


        }
        return view('Admin.CRUDS.galleries.index');
    }


    public function create()
    {

        return view('Admin.CRUDS.galleries.parts.create');
    }

    public function store(Request $request)
    {


        $data = $request->validate([
            'file' => 'required|mimes:jpeg,jpg,png,gif,svg,webp,avif,mp4',

        ]);

        if ($request->file) {


            $data["file"] = $this->uploadFiles('galleries', $request->file('file'), null);

            $fileNameWithExt = $request->file('file')->getClientOriginalExtension();
            $data['type'] = 'image';
            if ($fileNameWithExt == 'mp4')
                $data['type'] = 'video';

        }

        Gallery::create($data);


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
        $row = Gallery::findOrFail($id);
        return view('Admin.CRUDS.galleries.parts.edit', compact('row'));

    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'file' => 'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif,mp4',

        ]);

        if ($request->file) {
            $data["file"] = $this->uploadFiles('galleries', $request->file('file'), null);


            $fileNameWithExt = $request->file('file')->getClientOriginalExtension();
            $data['type'] = 'image';
            if ($fileNameWithExt == 'mp4')
                $data['type'] = 'video';
        }


        $row = Gallery::findOrFail($id);

        $row->update($data);


        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!',
            ]);
    }


    public function destroy($id)
    {
        $row = Gallery::findOrFail($id);

        $row->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);
    }//end fun
}
