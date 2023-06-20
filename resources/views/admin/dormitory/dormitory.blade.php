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
                            <u> Closed  Campaigns </u>
                        </h4>
                    </div>
                    @php
                        $user = auth()->user();
                    @endphp
                   
                        <div class="col-xs-6 text-right">
                            <button class="btn btn-success btn-sm" id="AddNewBtn" type="button"><i class="fa fa-plus"></i> Add New</button>
                        </div>
                    
                </div>
            </div>

            <div class="portlet-body">

                <table
                    class="table table-striped table-bordered table-hover dormitory-table"
                    data-global-search="true"
                    data-length-change="true"
                    data-info="true"
                    data-paging="true"
                >
                    <thead>
                        <tr>
                            <th data-sortable="false" class="w-60p text-center">Action</th>
                            <th data-sortable="false" class="mw-180p">Campaign</th>
                            <th data-sortable="false" class="">Distributor Name</th>
                            <th data-sortable="false" class="">School Name</th>
                            <th data-sortable="true" class="w-120p" style="color: red">Campaign Code</th>
                            <th data-sortable="true" class="w-120p">Sponsor Name</th> 
                            <th data-sortable="true" class="w-120p">Student Count</th>
                            <th data-sortable="true" class="w-130p">Start Date</th>
                            <th data-sortable="true" class="w-130p">End Date</th>
                            <th data-sortable="true" class="w-130p">Type of Sale</th>
                            <th data-sortable="true" class="w-160p">Total Product Sales</th>
                            <th data-sortable="true" class="w-150p">Total Donations</th>
                            <th data-sortable="true" class="w-150p">Total Round-ups</th>
                            <th data-sortable="true" class="w-150p">Card Rate</th>
                            <th data-sortable="true" class="w-150p">Transaction Fee</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Totals</th>
                            <th></th>

                            <th></th>
                            <th></th>
                          <th></th> 
                            <th class="total_student_count"></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th class="total_sale_amount"></th>
                            <th class="total_total_donation"></th>
                            <th class="total_total_roundup"></th>
                            <th class="average_credit_card_rate"></th>
                            <th class="average_transaction_fee"></th>
                       
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    {{-- modal partial --}}
    @include('admin.partials.modals.dormitory-modal')

@endsection

@section('js')
    <script src="{{asset('assets/library/jquery-validate/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/library/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/library/select2/dist/js/select2.min.js')}}"></script>

    @include('admin.dormitory.page-script')
@endsection
