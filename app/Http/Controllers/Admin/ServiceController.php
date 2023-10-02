<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Upload_Files;
use App\Models\CategoryService;
use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ServiceController extends Controller
{
    //
    //
    use Upload_Files;

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $admins = Service::query()->orderBy('ranking','ASC');
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

                ->editColumn('is_special', function ($row) {
                    $active = '';

                    $operation = '';



                    if ($row->is_special == 1)
                        $active = 'checked';

                    return '<div class="form-check form-switch">
                               <input ' . $operation . '  class="form-check-input activeBtn" data-id="' . $row->id . ' " type="checkbox" role="switch" id="flexSwitchCheckChecked" ' . $active . '  >
                           </div>';
                })



                ->editColumn('category_service_id', function ($row) {

                    return $row->category->title??'';

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
        return view('Admin.CRUDS.services.index');
    }


    public function create()
    {
        $categories=CategoryService::get();

        return view('Admin.CRUDS.services.parts.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',
            'desc' => 'required',
            'category_service_id'=>'required|exists:category_services,id',
            'details' => 'nullable',


        ]);

        if ($request->image)
            $data["image"] = $this->uploadFiles('services', $request->file('image'), null);



        Service::create($data);


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
        $row=Service::findOrFail($id);
        $categories=CategoryService::get();
        return view('Admin.CRUDS.services.parts.edit', compact('row','categories'));

    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',
            'desc' => 'required',
            'category_service_id'=>'required|exists:category_services,id',
            'details' => 'nullable',

        ]);

        if ($request->image)
            $data["image"] = $this->uploadFiles('services', $request->file('image'), null);




        $row=Service::findOrFail($id);

        $row->update($data);


        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!',
            ]);
    }


    public function destroy( $id)
    {
        $row=Service::findOrFail($id);

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
            Service::find($rankData['id'])->update(['ranking'=>$rankData['rank']]);
        }
    }//end fun

    public function activate(Request $request)
    {

        $admin = Service::findOrFail($request->id);
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
