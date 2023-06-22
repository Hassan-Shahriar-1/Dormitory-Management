@section('css')
    <link rel="stylesheet" href="{{asset('assets/library/select2/dist/css/select2.min.css')}}">
    <style>
        .campaign-table tbody td{
            text-align: left
        }

        .campaign-table tbody td:last-child
        {
            text-align: center !important
        }
        .select2 .select2-search.select2-search--inline .select2-search__field{
            width: auto !important
        }

    </style>

@endsection

@extends('admin.partials.master')
@section('pageTitle', 'Campaigns')
@section('content')
    <div class="container">
        <div class="portlet portlet-boxed portlet-table">
            <div class="portlet-header">
                <div class="row">
                    <div class="col-xs-6">
                        <h4 class="portlet-title">
                            <u> Room Type List</u>
                        </h4>
                    </div>

                    <div class="col-xs-6 text-right">
                        <button class="btn btn-success btn-sm" id="AddNewBtn" type="button"><i class="fa fa-plus"></i> Add New</button>
                    </div>
                    
                </div>
            </div>

            <div class="portlet-body">

                <table
                    class="table table-striped table-bordered table-hover student-dormitory-table"
                    data-global-search="true"
                    data-length-change="true"
                    data-info="true"
                    data-paging="true"
                >
                    <thead>
                        <tr>
                            <th data-sortable="false" class="">Action</th>
                            <th data-sortable="false" class="w-60p text-center">Student Name</th>
                            <th data-sortable="false" class="mw-180p">Student Address</th>
                            <th data-sortable="false" class="">Room Number</th>
                            <th data-sortable="false" class="">Dormitory Name</th>
                            <th data-sortable="false" class="">Room Type</th>
                            <th data-sortable="false" class="">Status</th>
                            
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

    {{-- modal partial --}}
    @include('admin.partials.modals.student-dormitory-modal')

@endsection

@section('js')
    <script src="{{asset('assets/library/jquery-validate/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/library/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/library/select2/dist/js/select2.min.js')}}"></script>

    @include('admin.student.page_script')
@endsection
