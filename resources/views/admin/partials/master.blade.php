<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <title>Dormitory Management • @yield('pageTitle')</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,800,800italic">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:400,300,700">

  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="{{asset('assets/library/fontawesome/css/font-awesome.min.css')}}">

{{--Fancybox--}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{asset('assets/library/bootstrap/dist/css/bootstrap.min.css')}}">

  <!-- App CSS -->
  <link rel="stylesheet" href="{{asset('assets/css/mvpready-admin.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/custom-style.css')}}">
  <link rel="stylesheet" href="{{asset('assets/library/fontawesome_5/css/all.min.css')}}">


  @yield('css')

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
  <link rel="apple-touch-icon" href="{{asset('apple-touch-icon.png')}}">

</head>

<body class="layout-fixed">
  <div id="wrapper">
    <div class="preloader_new" style="display: block;">
      <div class="preloader_wrap">
        <div class="cssload-speeding-wheel"></div>
      </div>
    </div>

    @include("admin.partials.navigations")

    <div class="content-page">
      <div class="content" style="padding: 10px 0 0 0;">
        @yield('content')
      </div> <!-- .content -->
    </div> <!-- /.content-page -->
  </div> <!-- /#wrapper -->


{{-- global alert modal partial --}}
@include('admin.partials.modals.alert-modal')

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Core JS -->
<!-- Core JS -->
<script src="{{asset('assets/library/jquery/dist/jquery.js')}}"></script>
<script src="{{asset('assets/library/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/library/slimscroll/jquery.slimscroll.js')}}"></script>

<!-- App JS -->
<script src="{{asset('assets/global/js/mvpready-core.js')}}"></script>
<script src="{{asset('assets/global/js/mvpready-helpers.js')}}"></script>
<script src="{{asset('assets/js/mvpready-admin.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
<script src="{{asset('assets/library/fontawesome_5/js/pro.min.js')}}"></script>
<script src="{{ asset('assets/global/js/usa-phone-mask.js') }}" type="text/javascript"></script>



<script>
  /*
  * show success message
  * */
  function showSuccessMessage($message) {
    $('#alert-modal').modal('show');
    $('#alert-error-msg').hide();
    $('#alert-success-msg').show();
    $('#alert-success-msg p').html($message);

    /*
    * auto hide success message
    * */
    setTimeout(function () {
        $('#alert-modal').modal('hide');
    }, 3000)
  }

  /*
  * show error message
  * */
  function showErrorMessage(message) {
    $('#alert-modal').modal('show');
    $('#alert-error-msg').show();
    $('#alert-success-msg').hide();
    $('#alert-error-msg p').html(message);
  }


  function showWarningMessage(message) {
    $('.warning_message').html(message);
    $('#warning_modal').modal('show');
  }


  /*
  * show description content
  * */
  function showDescription(content) {
    $('#detailsModal').modal('show');
    $('#detailsBody').html(content);
  }


  /*
  * img preview
  * */

   function applicationReadImgURL(input) {
       var a=(input.files[0].size);
       if(a <= 2000000) {
           if (input.files && input.files[0]) {
               var reader = new FileReader();

               reader.onload = function(e) {
                   $('#previewImg').attr('src', e.target.result);
               }
               reader.readAsDataURL(input.files[0]);
           }
       } else {
           showErrorMessage('Maximum Size Limit is 2MB');
       }
    }


  /*
  * password validator
  * */

  var passwordPattern = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/;
    function passwordValidation(password){
        message = "";

        if (password == "") {
            message = "Password is required.";
            showErrorMessage(message);
        }else if (password.length < 6) {
            message = "Password must be at least 6 characters.";
            showErrorMessage(message);
        } else if (!passwordPattern.test(password)) {
            message = 'Password must contain 1 uppercase,1 lowercase ,1 number and 1 special character.';
            showErrorMessage(message);
        }

        return message;
    }

  function showDetailsById(id,type){
        var url='';

        switch (type){
            case 'user':
                url='{{url('admin/users')}}/'+id;
                break;
            case 'school':
                url='{{url('admin/schools')}}/'+id;
                break;
            case 'sponsor':
                url='{{url('admin/sponsor')}}/'+id;
                break;
            case 'student':
                url='{{url('admin/students')}}/'+id;
                break;
            case 'product':
                url='{{url('admin/products')}}/'+id;
                break;
            case 'customer':
                url='{{url('admin/customers')}}/'+id;
                break;
            case 'order':
                url='{{url('admin/orders')}}/'+id;
                break;
            case 'campaign':
                url='{{url('admin/campaigns')}}/'+id;
                break;
            default:
                location.reload();
        }
      $.ajax({
          url: url,
          type: "GET",
          success: function (data) {
              html=details[type+'Details'](data);
              $("#showDetailsBody").html(html);
              $("#showDetailsModal").modal('show')
          },

          error: function (data) {
              showErrorMessage('Data fetch Failed.')
          }
      });
  }
var details= {
    studentDetails: function (data) {
        var html='';
        html+='<tr><th>First Name</th><td>'+data.user.first_name+'</td></tr>';
        html+='<tr><th>Last Name</th><td>'+data.user.last_name+'</td></tr>';
        html+='<tr><th>User Name</th><td>'+data.user.user_name+'</td></tr>';
        html+='<tr><th>Email</th><td>'+data.user.email+'</td></tr>';
        html+='<tr><th>Phone</th><td>'+formatUSNumber(data.user.phone)+'</td></tr>';
        html+='<tr><th>Teacher</th><td>'+data.teacher+'</td></tr>';
        html+='<tr><th>Grade</th><td>'+data.grade_name+'</td></tr>';
        html+='<tr><th>School</th><td>'+data.school.name+'</td></tr>';
        return html;
    },
    sponsorDetails: function (data) {
        var html='';
        html+='<tr><th>First Name</th><td>'+data.user.first_name+'</td></tr>';
        html+='<tr><th>Last Name</th><td>'+data.user.last_name+'</td></tr>';
        html+='<tr><th>User Name</th><td>'+data.user.user_name+'</td></tr>';
        html+='<tr><th>Password</th><td>'+data.password+'</td></tr>';
        html+='<tr><th>Email</th><td>'+data.user.email+'</td></tr>';
        html+='<tr><th>Phone</th><td>'+formatUSNumber(data.user.phone)+'</td></tr>';
        html+='<tr><th>School</th><td>'+data.school.name+'</td></tr>';
        return html;
    },
    userDetails: function (data) {
        var html='';
        html+='<tr><th>First Name</th><td>'+data.first_name+'</td></tr>';
        html+='<tr><th>Last Name</th><td>'+data.last_name+'</td></tr>';
        html+='<tr><th>User Name</th><td>'+data.user_name+'</td></tr>';
        html+='<tr><th>Email</th><td>'+data.email+'</td></tr>';
        html+='<tr><th>Phone</th><td>'+formatUSNumber(data.phone)+'</td></tr>';
        return html;
    },
    customerDetails: function (data) {
        var html='';
        html+='<tr><th>First Name</th><td>'+(data.first_name??'')+'</td></tr>';
        html+='<tr><th>Last Name</th><td>'+(data.last_name??'')+'</td></tr>';
        html+='<tr><th>Email</th><td>'+(data.email??'')+'</td></tr>';
        html+='<tr><th>Phone</th><td>'+formatUSNumber(data.phone)+'</td></tr>';
        html+='<tr><th>Transaction Id</th><td>'+data.payment_intent+'</td></tr>';
        html+='<tr><th>Total Paid</th><td>'+parseFloat(data.total_paid).toFixed(2)+'</td></tr>';
        return html;
    },
    productDetails: function (data) {
        var html='';
        html+='<tr><th>Name</th><td>'+data.name+'</td></tr>';
        html+='<tr><th>Unit Price</th><td>'+parseFloat(data.unit_price).toFixed(2)+'</td></tr>';
        html+='<tr><th>Supplier</th><td>'+data.supplier+'</td></tr>';
        html+='<tr><th>Internal Notes</th><td>'+(data.internal_notes??"")+'</td></tr>';
        return html;
    },
    orderDetails: function (data) {
        var html='';
        html+='<tr><th>Seller Student</th><td>'+data.student.user.first_name+' '+data.student.user.last_name+'</td></tr>';
        html+='<tr><th>Buyer Customer</th><td>'+(data.customer?data.customer.first_name??''+' '+data.customer.last_name??'':'')+'</td></tr>';
        html+='<tr><th>School</th><td>'+data.school.name+'</td></tr>';
        html+='<tr><td></td><td></td></tr>';
        var orderDetails=data.order_details;
        $.each(orderDetails,function (key,value){
            if (value.quantity>0){
                html+='<tr><th>Product Name</th><td>'+value.product_name+'</td></tr>';
                html+='<tr><th>Product Quantity</th><td>'+value.quantity+'</td></tr>';
                html+='<tr><th>Product Unite Price</th><td>'+parseFloat(value.unit_price).toFixed(2)+'</td></tr>';
                html+='<tr><th>Sub Total</th><td>'+parseFloat(value.sub_total).toFixed(2)+'</td></tr>';
                html+='<tr><td></td><td></td></tr>';
            }
        });
        html+='<tr><th>Total Amount</th><td>'+parseFloat(data.sale_amount).toFixed(2)+'</td></tr>';
        html+='<tr><th>Donation Amount</th><td>'+parseFloat(data.donation_amount??0).toFixed(2)+'</td></tr>';
        html+='<tr><th>Round up Amount</th><td>'+parseFloat(data.rounded_up_amount??0).toFixed(2)+'</td></tr>';
        
        return html;
    },
    schoolDetails: function (data) {
        var html='';
        html+='<tr><th>Name</th><td>'+data.name+'</td></tr>';
        html+='<tr><th>Phone</th><td>'+formatUSNumber(data.phone)+'</td></tr>';
        html+='<tr><th>Address</th><td>'+data.address_line1+'</td></tr>';
        html+='<tr><th>State</th><td>'+data.state+'</td></tr>';
        html+='<tr><th>City</th><td>'+data.city+'</td></tr>';
        html+='<tr><th>Zip</th><td>'+data.zip_code+'</td></tr>';
        html+='<tr><th>Web address</th><td>'+data.web_address+'</td></tr>';
        return html;
    },
    campaignDetails: function (data) {
        var html='';
        html+='<tr><th>Name</th><td>'+data.school?.name+' - '+data.group?.name+' - '+data.access_code+'</td></tr>';
        html+='<tr><th>Access Code</th><td>'+data.access_code+'</td></tr>';
        html+='<tr><th>Start Date</th><td>'+data.start_date+'</td></tr>';
        html+='<tr><th>Type of Sale</th><td>'+data.sale_type+'</td></tr>';
        html+='<tr><th>Sponsor Name</th><td>'+data.user?.first_name+' '+data.user?.last_name+'</td></tr>';
        html+='<tr><th>Sponsor Email</th><td>'+data.user?.email+'</td></tr>';
        html+='<tr><th>Sponsor Phone</th><td>'+formatUSNumber(data.user?.phone)+'</td></tr>';
        return html;
    },

};

    function createDatableSearchFeild(){
                $('.campaign_outcome tfoot th').each(function () {
                    var title = $(this).text();
                    $(this).html('<input type="text" placeholder="Search ' + title + '" />');
                });
    }


    function createDataTable(){
        return  $('.campaign_outcome').DataTable({
            processing: true,
            serverSide: false,
            ordering: false,
            /* lengthChange: false, */
            searching: true,
            lengthMenu: [[10, 20, 50, 75, 100, 200, 500, 1000, -1], [10, 20, 50, 75, 100, 200, 500, 1000, 'All']],
            pageLength: 10,
            globalSearch: false,
            destroy: true,
            applyFilter: true,

            dom: 'lBfrtip',
            buttons: [
                'colvis', 
                {
                    extend: 'print',
                    pageSize: 'A4',
                    orientation: 'landscape',   
                    exportOptions: {
                        columns: ':visible',
                    },
                    customize: function (win) {
                        $(win.document.body).find(' table ').css({'width': '100%'}); 
                        $(win.document.body).find('table th').css({
                            'font-weight': 'bold',
                            'font-size': '12px',
                            'padding': '3px'
                        });
                        $(win.document.body).find('table td').css({'font-size': '10px', 'padding': '3px'}); 
                        $(win.document.body).find('table').addClass('compact').css({
                            'border': '1px solid #333',
                            'font-size': 'inherit'
                        });
                    }
                },
                
                 
                {
                    extend: 'pdf',
                    alignment: "left",
                    orientation: 'landscape',
                    pageSize: 'A4',
                    exportOptions: {
                        columns: ':visible'
                    },

                    customize: function ( doc ) { 
                        doc.defaultStyle.fontSize = 8;
                        doc.styles.tableHeader.fontSize = 8;
                    },
                }
                
            ],
            initComplete: function () {
            this.api()
                .columns()
                .every(function () {
                    var that = this;

                    $('input', this.footer()).on('keyup change clear', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
        },
        });
    }
    $(document).on('ready',function(){
        let selectElement = document.getElementById('sponsor_campaign_id');
        if(!selectElement){
            return;
        }
        let optionNames = [...selectElement.options].map(o => o.value);
        var length = Object.keys(optionNames).length;
        var isLocalStorage = localStorage.getItem('campaign_ID');

        if(length === 2 && (isLocalStorage == null && isLocalStorage == undefined)){
            $("#sponsor_campaign_id").val(optionNames[1]);
        }else{
            $("#sponsor_campaign_id").val(localStorage.getItem('campaign_ID'));
        }
    })
    $('#sponsor_campaign_id').on('change',function(){
       var campaign_id = $(this).find(':selected').val()
       localStorage.setItem("campaign_ID", campaign_id);
       if(campaign_id != 0){
        $.ajax({
                url: "{{ url('sponsor/set/campaign-session') }}/"+campaign_id,
                type: "GET",
                processData: false,
                contentType: false,
                success: function (data) {
                },
                error: function (data) {
                }
            });
            window.location.reload()
       }

    });
  </script>

@yield('js')
</body>
</html>
