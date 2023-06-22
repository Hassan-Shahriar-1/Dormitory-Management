@extends('auth.layout')
@section('pageTitle', 'Login')
@section('content')
    <div class="account-body">
        <h3 class="mt-50">Please Login</h3>

        <form class="form account-form" method="POST" action="{{url('login')}}">
            @csrf

            @error('email')
            <span class="invalid-feedback" style="color:red;" role="alert">
              <strong>{{ $message }}</strong>
           </span>
            @enderror

            <div class="form-group mt-10">
                <label for="login-username">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email"class="form-control"  placeholder="Username" tabindex="1">
            </div> <!-- /.form-group -->
            <div class="form-group">
                <label for="login-password">Password <span class="text-danger">*</span></label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" tabindex="2">
            </div> <!-- /.form-group -->
            <div class="form-group clearfix">
                <div class="pull-left">
                    <label class="checkbox-inline">
                        <input type="checkbox" name="remember" tabindex="3"> <small>Remember me</small>
                    </label>
                </div>

                
            </div> <!-- /.form-group -->
            <div class="form-group">
                <input type="submit" class="btn btn-success btn-block" tabindex="4" value="Login">
            </div> <!-- /.form-group -->

        </form>

    </div> <!-- /.account-body -->
@endsection
@section('js')
{{-- js heere  --}}
<script>
     var el_form = $(".account-form");
     var el_email = $("#email");
     var el_password = $("#password");

     el_form.submit(function( event ) {
        var email = el_email.val();
        var password = el_password.val();

        if(email == ''){
            el_email.addClass('field-required');
        }else{
            el_email.removeClass('field-required');
        }

        if(password == ''){
            el_password.addClass('field-required');
        }else{
            el_password.removeClass('field-required');
        }

        var hasError = el_form.find('.field-required').length;
        if(hasError == 0){
            // do action
        }else{
            event.preventDefault();
            return false;
        }
    });

    $(document).on("change", "#email", function(){
        var email = el_email.val();
       if(email == ''){
        el_email.addClass('field-required');
       }else{
        el_email.removeClass('field-required');
       }
    })

    $(document).on("change", "#password", function(){
        var password = el_password.val();
       if(password == ''){
        el_password.addClass('field-required');
       }else{
        el_password.removeClass('field-required');
       }
    })

     
</script>
@endsection
