@extends('Admin.layouts.inc.app')
@section('title')
   Services
@endsection
@section('css')

@endsection
@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h5 class="card-title mb-0 flex-grow-1">Services</h5>


                <div>
                    <button id="addBtn" class="btn btn-primary">Add a Service</button>
                </div>

        </div>
        <div class="card-body">
            <table id="table" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                   style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Is Special  </th>
                    <th>  {{trans('admin.created at')}}</th>
                    <th>{{trans('admin.actions')}}</th>
                </tr>
                </thead>
                <tbody id="sortTable">

                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="Modal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered modal-lg mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content" id="modalContent">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2><span id="operationType"></span> Service </h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" style="cursor: pointer"
                         data-bs-dismiss="modal" aria-label="Close">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                      transform="rotate(-45 6 17.3137)"
                                      fill="black"/>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                      fill="black"/>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7" id="form-load">

                </div>
                <!--end::Modal body-->
                <div class="modal-footer">
                    <div class="text-center">
                        <button type="reset" data-bs-dismiss="modal" aria-label="Close" class="btn btn-light me-3">
                            {{trans('admin.cancel')}}
                        </button>
                        <button form="form" type="submit" id="submit" class="btn btn-primary">
                            <span class="indicator-label">{{trans('admin.ok')}}</span>
                        </button>
                    </div>
                </div>
            </div>

            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>

@endsection
@section('js')

    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

    <script>
        $('#sortTable').sortable({
            stop: function () {
                var servicesArray = [];
                $('.sortClass').each(function (index) {
                    var newRank = {
                        id: $(this).data('id'),
                        rank: index + 1
                    }
                    $(this).find("td:first").text(newRank.rank)
                    servicesArray.push(newRank)
                }).promise().done(function () {
                    var method = {
                        array: servicesArray
                    }
                    $.post("{{route('admin.updateServiceRank')}}", method, function (data) {
                        // console.log(data)
                        alertify.success('M.Elsdodey ');

                    })
                });
            }
        })

        var columns = [
            {data: 'ranking', name: 'ranking'},
            {data: 'title', name: 'title'},
            {data: 'image', name: 'image'},
            {data: 'category_service_id', name: 'category_service_id'},
            {data: 'is_special', name: 'is_special'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ];
    </script>
    @include('Admin.layouts.inc.ajax',['url'=>'services'])

    <script>
        $(document).on('change', '.activeBtn', function () {
            var id = $(this).attr('data-id');

            $.ajax({
                type: 'GET',
                url: "{{route('admin.active.services')}}",
                data: {
                    id: id,
                },

                success: function (res) {
                    if (res['status'] == true) {

                        toastr.success("{{trans('admin.operation accomplished successfully')}}")
                        // $('#table').DataTable().ajax.reload(null, false);
                    } else {
                        // location.reload();

                    }
                },
                error: function (data) {
                    // location.reload();
                }
            });


        })
    </script>



@endsection
