<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Upload_Files;
use App\Models\DentalTourism;
use App\Models\DentalTourismImage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DentalTourismController extends Controller
{
    //
    use Upload_Files;

    public function index(Request $request)
    {

        DentalTourism::firstOrCreate();

        if ($request->ajax()) {
            $admins = DentalTourism::query()->latest();
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

                       ';


                })
                ->editColumn('image', function ($admin) {
                    return '
                              <a data-fancybox="" href="' . get_file($admin->image) . '">
                                <img height="60px" src="' . get_file($admin->image) . '">
                            </a>
                             ';
                })
                ->addColumn('rows', function ($row) {

                    $link=route('dental_tourism_rows.index')."?dental_tourism_id=".$row->id;
                    return "<a href='$link' class='btn btn-outline-dark'>Show Rows </a>";
                })
                ->editColumn('created_at', function ($admin) {
                    return date('Y/m/d', strtotime($admin->created_at));
                })
                ->escapeColumns([])
                ->make(true);


        }
        return view('Admin.CRUDS.dental.index');
    }


    public function show($id)
    {


        //
    }


    public function edit($id)
    {
        $row = DentalTourism::findOrFail($id);
        $images = [];
        if (!is_null(DentalTourismImage::where('dental_tourism_id',$id)->get())) {
            foreach (DentalTourismImage::where('dental_tourism_id',$id)->get() as $index => $image) {
                $images[$index]['id'] = $image->id;
                $images[$index]['src'] = get_file($image->image);
            }
        }

        return view('Admin.CRUDS.dental.parts.edit', compact('row','images'));

    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title1' => 'required',
            'title2' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',
            'desc' => 'required',
            'desc1' => 'required',
            'desc2' => 'required',

        ]);

        if ($request->image)
            $data["image"] = $this->uploadFiles('dental', $request->file('image'), null);


    DentalTourism::findOrFail($id)->update($data);



        if ($request->old) {
            DentalTourismImage::where('dental_tourism_id',$id)->whereNotIn('id', $request->old)
                ->delete();
        } else {
            DentalTourismImage::where('dental_tourism_id',$id)->where('id','!=',null)->delete();
        }

        if (isset($request->images) && count($request->images) > 0) {
            for ($i=0;$i<count($request->images);$i++) {

                $image =  $this->uploadFiles('dental', $request->images[$i], 'yes');

                DentalTourismImage::create([
                    'dental_tourism_id'=>$id,
                    'image'=>$image,
                ]);
            }
        }



        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!',
            ]);
    }


    public function destroy($id)
    {
        DentalTourism::findOrFail($id)->delete();


        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);
    }//end fun
}
