@section('css')
    {{-- page css here   --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.min.css" integrity="sha512-3//o69LmXw00/DZikLz19AetZYntf4thXiGYJP6L49nziMIhp6DVrwhkaQ9ppMSy8NWXfocBwI3E8ixzHcpRzw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@extends('admin.partials.master')
@section('pageTitle', 'Home')
@section('content')
    <div>
        <div class="col-md-12 shortcut_icon_block">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                        <a href="{{url('/')}}?show_modal=create" class="btn bg-dark-blue">Add New Dormitory</a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="{{url('/')}}?show_modal=create" class="btn bg-orange">Add New Room Types</a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="{{url('/')}}?show_modal=create" class="btn bg-cyan">Add New Rooms</a>
                </div>
                <div class="col-md-3 col-sm-6 ">
                    <a href="{{url('/')}}?show_modal=create" class="btn bg-green ">Add New Student Dormitory</a>
                </div>
            </div>
        </div>
            
            <div class="col-md-4 col-sm-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Total Dormentory Donations</span> <!-- /.icon-stat-label -->
                            <span class="icon-stat-value">{{100}}</span> <!-- /.icon-stat-value -->
                        </div><!-- /.col-xs-8 -->

                        <div class="col-xs-4 text-center">
                            <i class="fas fa-hand-holding-usd icon-stat-visual bg-success"></i> <!-- /.icon-stat-visual -->
                        </div><!-- /.col-xs-4 -->
                    </div><!-- /.row -->

                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div> <!-- /.icon-stat -->
            </div> <!-- /.col-md-3 -->

                        <div class="col-md-4 col-sm-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Total Rooms</span> <!-- /.icon-stat-label -->
                            <span class="icon-stat-value">{{100}}</span> <!-- /.icon-stat-value -->
                        </div><!-- /.col-xs-8 -->

                        <div class="col-xs-4 text-center">
                            <i class="fas fa-hand-holding-usd icon-stat-visual bg-success"></i> <!-- /.icon-stat-visual -->
                        </div><!-- /.col-xs-4 -->
                    </div><!-- /.row -->

                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div> <!-- /.icon-stat -->
            </div> <!-- /.col-md-3 -->

                        <div class="col-md-4 col-sm-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Total Availables Rooms</span> <!-- /.icon-stat-label -->
                            <span class="icon-stat-value">{{100}}</span> <!-- /.icon-stat-value -->
                        </div><!-- /.col-xs-8 -->

                        <div class="col-xs-4 text-center">
                            <i class="fas fa-hand-holding-usd icon-stat-visual bg-success"></i> <!-- /.icon-stat-visual -->
                        </div><!-- /.col-xs-4 -->
                    </div><!-- /.row -->

                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div> <!-- /.icon-stat -->
            </div> <!-- /.col-md-3 -->

                        <div class="col-md-4 col-sm-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Total Student Dormintory </span> <!-- /.icon-stat-label -->
                            <span class="icon-stat-value">{{100}}</span> <!-- /.icon-stat-value -->
                        </div><!-- /.col-xs-8 -->

                        <div class="col-xs-4 text-center">
                            <i class="fas fa-hand-holding-usd icon-stat-visual bg-success"></i> <!-- /.icon-stat-visual -->
                        </div><!-- /.col-xs-4 -->
                    </div><!-- /.row -->

                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div> <!-- /.icon-stat -->
            </div> <!-- /.col-md-3 -->









    </div> <!-- /.container -->
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

        $('#filterBySchool').select2({
            placeholder: "Filter By School",
            allowClear: true
        });


        $(document).on("change", "#filterBySchool", function () {
            var school = $(this).val();
            url="{{url('admin')}}?school_id="+school;
            url+="&campaign_type="+$('#filterByCampaignType').val()??'';
            window.location.href = url;
        });


        $('#filterByDistributor').select2({
            placeholder: "Filter By Distributor",
            allowClear: true
        });


        $(document).on("change", "#filterByDistributor", function () {
            var distributor = $(this).val();
            url="{{url('admin')}}?distributor_id="+distributor;
            url+="&campaign_type="+$('#filterByCampaignType').val()??'';
            window.location.href = url;
        });

        $(document).on("change", "#filterByCampaignID", function () {
            var campaign = $(this).val();
            url="{{url('admin')}}?campaign_id="+campaign;
            url+="&campaign_type="+$('#filterByCampaignType').val()??'';
            window.location.href = url;
        });


    </script>
@endsection
