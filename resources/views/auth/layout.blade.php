<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <title>@yield('pageTitle') - Dormitory Management</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Google Font -->
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="{{asset('assets/library/fontawesome/css/font-awesome.min.css')}}">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{asset('assets/library/bootstrap/dist/css/bootstrap.min.css')}}">


  <!-- App CSS -->
  <link rel="stylesheet" href="{{asset('assets/css/mvpready-admin.css')}}">
  <link rel="stylesheet" href="{{asset('assets/front-assets/css/main.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">

  @yield('css')


  <!-- Favicon -->
  <link rel="shortcut icon" href="favicon.ico">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="account-bg auth-view">
    

    <div class="account-wrapper">
       @yield('content')
    </div>


 

  <!-- alert message START -->
  <div class="modal fade alert global-warning" role="dialog" id="alert-modal" style="z-index: 99999">
      <div class="modal-dialog modal-sm modal-dialog-centered" style="">
          <div class="modal-content">
              <div class="modal-body text-center">
                  <div id="alert-error-msg">
                      <i class="fa fa-exclamation-triangle fa-3x text-danger"></i> <br><br>
                      <p class="text-danger f-15"></p>
                  </div>

                  <div id="alert-success-msg">
                      <i class="fa fa-check-circle text-success fa-3x"></i><br><br>
                      <p class="text-success f-15"></p>
                  </div>
              </div>
              <div class="modal-footer text-center" style="justify-content: center;">
                  <button class="btn btn-primary" data-dismiss="modal" id="alert-ok">ok</button>
              </div>
          </div>
      </div>
  </div>



<!-- Bootstrap core JavaScript
================================================== -->
<!-- Core JS -->
<script src="{{asset('assets/library/jquery/dist/jquery.js')}}"></script>
<script src="{{asset('assets/library/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/library/slimscroll/jquery.slimscroll.js')}}"></script>


<!-- App JS -->
<script src="{{asset('assets/global/js/mvpready-core.js')}}"></script>
<script src="{{asset('assets/global/js/mvpready-helpers.js')}}"></script>
<script src="{{asset('assets/js/mvpready-admin.js')}}"></script>
<script src="{{ asset('assets/global/js/usa-phone-mask.js') }}" type="text/javascript"></script>

<!-- Demo JS -->
<script src="{{asset('assets/global/js/mvpready-account.js')}}"></script>
<script>
    /* USA phone masking */
    $(function () {
        $(".phone-masking").mask("(999) 999-9999");
        $(".phone-masking").on("blur", function () {
            var last = $(this).val().substr($(this).val().indexOf("-") + 1);

            if (last.length == 5) {
                var move = $(this).val().substr($(this).val().indexOf("-") + 1, 1);

                var lastfour = last.substr(1, 4);

                var first = $(this).val().substr(0, 9);

                $(this).val(first + move + '-' + lastfour);
            }
        });
    });
    
  function showSuccessMessage(message){
      $('#alert-modal').modal('show');
      $('#alert-error-msg').hide();
      $('#alert-success-msg').show();
      $('#alert-success-msg p').html(message);
  }
  function showErrorMessage(message){
      $('#alert-modal').modal('show');
      $('#alert-error-msg').show();
      $('#alert-success-msg').hide();
      $('#alert-error-msg p').html(message);
  }
</script>
@yield('js')
</body>
</html>
