<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Upload_Files;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    use Upload_Files;



    public function index(Request $request)
    {

        if ($request->ajax()) {
            $admins = Admin::query()->latest();
            return Datatables::of($admins)
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
                ->editColumn('is_active', function ($row) {
                    $active = '';
                    $operation = '';

                    $operation = '';



                    if ($row->is_active == 1)
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
        return view('Admin.CRUDS.admin.index');
    }


    public function create()
    {
        $roles = Role::get();

        return view('Admin.CRUDS.admin.parts.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',

            'password' => 'required',
//             'business_name'=>'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',
            'is_active' => 'required',

        ]);
        if ($request->image)
            $data["image"] = $this->uploadFiles('admins', $request->file('image'), null);

        $data['password'] = bcrypt($request->password);



        $old=Admin::where('email',$request->email)->where('column_client_id',auth('admin')->user()->column_client_id)->first();

        if ($old)
            return response()->json(
                [
                    'code' => 421,
                    'message' => 'Email  Used Before'
                ]);




        $admin = Admin::create($data);


        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);
    }


    public function show(Admin $admin)
    {

        $html = view('Admin.CRUDS.admin.parts.show', compact('admin'))->render();
        return response()->json([
            'code' => 200,
            'html' => $html,
        ]);

        //
    }


    public function edit(Admin $admin)
    {

        return view('Admin.CRUDS.admin.parts.edit', compact('admin'));

    }

    public function update(Request $request, Admin $admin)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'nullable',
//            'business_name'=>'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',
            'is_active' => 'nullable',


        ]);
        if ($request->password) {
            $data['password'] = bcrypt($request->password);

        } else {

            $data['password'] = $admin->password;


        }
        if ($request->image) {
            $data["image"] = $this->uploadFiles('admins', $request->file('image'), null);

        }

        $old=Admin::where('email',$request->email)->where('id','!=',$admin->id)->first();

        if ($old)
            return response()->json(
                [
                    'code' => 421,
                    'message' => 'Email  Used Before'
                ]);








        $admin->update($data);




        $html = view('Admin.CRUDS.admin.parts.header')->render();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!',
                'html' => $html,
                'name' => $admin->name,
                'logo' => get_file($admin->image),
                'business_name' => $admin->business_name,
            ]);
    }


    public function destroy( $id)
    {
        $admin=Admin::findOrFail($id);

        $admin->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);
    }//end fun


    public function activate(Request $request)
    {

        $admin = Admin::findOrFail($request->id);
        if ($admin->is_active == true) {
            $admin->is_active = 0;
            $admin->save();
        } else {
            $admin->is_active = 1;
            $admin->save();
        }

        return response()->json(['status' => true]);
    }//end fun

}//end class
