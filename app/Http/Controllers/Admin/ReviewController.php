<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Upload_Files;
use App\Models\Review;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ReviewController extends Controller
{
    //
    use Upload_Files;

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $admins = Review::query()->latest();
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
                ->editColumn('rate', function ($row) {

                    $rate='';
                    for ($i=0;$i<$row->rate;$i++)
                        $rate=$rate.'<i class="fas fa-star fa-2x" style="color: yellow;"></i>';

                    return $rate;
                })

                    ->editColumn('image', function ($admin) {
                    return '
                              <a data-fancybox="" href="' . get_file($admin->image) . '">
                                <img height="60px" src="' . get_file($admin->image) . '">
                            </a>
                             ';
                })

                ->editColumn('created_at', function ($admin) {
                    return date('Y/m/d', strtotime($admin->created_at));
                })
                ->escapeColumns([])
                ->make(true);


        }
        return view('Admin.CRUDS.reviews.index');
    }


    public function create()
    {

        return view('Admin.CRUDS.reviews.parts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif,svg,webp,avif',
            'rate' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'text' => 'required',


        ]);

        if ($request->image)
            $data["image"] = $this->uploadFiles('reviews', $request->file('image'), null);



        Review::create($data);


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
        $row=Review::findOrFail($id);
        return view('Admin.CRUDS.reviews.parts.edit', compact('row'));

    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif',
            'rate' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'text' => 'required',

        ]);

        if ($request->image)
            $data["image"] = $this->uploadFiles('reviews', $request->file('image'), null);




        $row=Review::findOrFail($id);

        $row->update($data);


        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!',
            ]);
    }


    public function destroy( $id)
    {
        $row=Review::findOrFail($id);

        $row->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);
    }//end fun
}
