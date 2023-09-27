<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Upload_Files;
use App\Models\CategoryService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ServiceCategoryController extends Controller
{
    //
    use Upload_Files;
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $admins = CategoryService::query()->orderBy('ranking','ASC');
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
                ->setRowAttr([
                    'data-rank'=>function($user){
                        return $user->ranking;
                    },'data-id'=>function($user){
                        return $user->id;
                    },'class'=>function($user){
                        return 'sortClass';
                    }
                ])
                ->make(true);


        }
        return view('Admin.CRUDS.serviceCategory.index');
    }


    public function create()
    {

        return view('Admin.CRUDS.serviceCategory.parts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'brief' => 'nullable',
            'desc' => 'nullable',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',



        ]);

        if ($request->image)
            $data["image"] = $this->uploadFiles('services', $request->file('image'), null);



        CategoryService::create($data);


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
        $row=CategoryService::findOrFail($id);
        return view('Admin.CRUDS.serviceCategory.parts.edit', compact('row'));

    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required',
            'brief' => 'nullable',
            'desc' => 'nullable',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',


        ]);

        if ($request->image)
            $data["image"] = $this->uploadFiles('services', $request->file('image'), null);



        $row=CategoryService::findOrFail($id);

        $row->update($data);


        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!',
            ]);
    }


    public function destroy( $id)
    {
        $row=CategoryService::findOrFail($id);

        $row->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);
    }//end fun

    public function updateRank(Request $request)
    {
        foreach ($request->array as $rankData)
        {
            CategoryService::find($rankData['id'])->update(['ranking'=>$rankData['rank']]);
        }
    }//end fun

}
