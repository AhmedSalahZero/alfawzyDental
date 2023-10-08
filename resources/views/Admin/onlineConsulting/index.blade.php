@extends('Admin.layouts.inc.app')
@section('title')
    Online Consulting
@endsection
@section('css')

@endsection
@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h5 class="card-title mb-0 flex-grow-1">Online Consulting</h5>



        </div>
        <div class="card-body">
            <table id="table" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                   style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Images</th>
                    <th>Complaint</th>
                    <th>  {{trans('admin.created at')}}</th>
                    <th>{{trans('admin.actions')}}</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>


@endsection
@section('js')
    <script>
        var columns = [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'images', name: 'images'},
            {data: 'complaint', name: 'complaint'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ];
    </script>
    @include('Admin.layouts.inc.ajax',['url'=>'online_consulting'])



@endsection