<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PaymentService;
use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{
    //
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $admins = Payment::query()->latest();
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
                ->addColumn('link', function ($row) {
                    $link=route('paymentPage',$row->id);
                        return '
                                       <a href="'.$link.'" class="btn btn-soft-info" target="_blank">Link </a>

                                   ';
                })


                ->editColumn('paid_date', function ($row) {
                    if ($row->status=='paid')
                        return $row->paid_date;
                    else
                        return  "<span class='btn btn-soft-danger'>Not Paid</span>";
                })

                ->editColumn('status', function ($row) {
                      if ($row->status=='paid')
                          return  "<span class='btn btn-soft-success'> Paid</span>";
                      else
                          return  "<span class='btn btn-soft-danger'>$row->status </span>";


                })


                ->editColumn('created_at', function ($admin) {
                    return date('Y/m/d', strtotime($admin->created_at));
                })
                ->escapeColumns([])
                ->make(true);


        }
        return view('Admin.CRUDS.payments.index');
    }


    public function create()
    {

        $services=Service::get();
        return view('Admin.CRUDS.payments.parts.create',compact('services'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'services'=>'required|array',
            'services.*'=>'required',
        ]);


    $data=$request->except(['services']);
       $row= Payment::create($data);

        if ($request->services){
            foreach ($request->services as $service)
                PaymentService::create([
                    'payment_id'=>$row->id,
                    'service_id'=>$service,
                ]);
        }



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
        $row=Payment::findOrFail($id);
        $services=Service::get();

        return view('Admin.CRUDS.payments.parts.edit', compact('row','services'));

    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'services'=>'required|array',
            'services.*'=>'required',
        ]);

        $data=$request->except(['services']);

        $row=Payment::findOrFail($id);

        $row->update($data);


        PaymentService::whereNotIn('service_id',$request->services)->where('payment_id',$id)->delete();

        if ($request->services){
            foreach ($request->services as $service)
                PaymentService::updateOrCreate([
                    'payment_id'=>$id,
                    'service_id'=>$service,
                ]);
        }


        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!',
            ]);
    }


    public function destroy( $id)
    {
        $row=Payment::findOrFail($id);


        $row->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);
    }//end fun
}
