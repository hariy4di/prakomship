<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Login - S.H.I.P</title>
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('template/robust/app-assets/images/ico/apple-icon-60.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('template/robust/app-assets/images/ico/apple-icon-76.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('template/robust/app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('template/robust/app-assets/images/ico/apple-icon-152.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('template/robust/app-assets/images/ico/favicon.ico') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('template/robust/app-assets/images/ico/favicon-32.png') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/robust/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/robust/app-assets/fonts/icomoon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/robust/app-assets/fonts/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/robust/app-assets/vendors/css/extensions/pace.css') }}">
    <!-- END VENDOR CSS-->

    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/robust/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/robust/app-assets/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/robust/app-assets/css/colors.css') }}">
    <!-- END ROBUST CSS-->

    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/robust/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/robust/app-assets/css/core/menu/menu-types/vertical-overlay-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/robust/app-assets/css/pages/login-register.css') }}">
    <!-- END Page Level CSS-->

    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/robust/assets/css/style.css') }}">
    <!-- END Custom CSS-->

    <link href="{{ asset('plugins/alertify/themes/alertify.core.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/alertify/themes/alertify.default.css') }}" rel="stylesheet">
  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="1-column" class="vertical-layout vertical-menu 1-column  blank-page blank-page">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><section class="flexbox-container">
    <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1  box-shadow-2 p-0" id="form-box">
        <div class="card border-grey border-lighten-3 m-0">
            <div class="card-header no-border">
                <div class="card-title text-xs-center">
                    <div class="p-1"><img src="{{ asset('template/robust/app-assets/images/logo/robust-logo-dark.png') }}" alt="branding logo"></div>
                </div>
                <!-- <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2"><span>Login with Robust</span></h6> -->
            </div>
            <div class="card-body collapse in">
                <div class="card-block">
                    <form id="form-login" name="form-login" class="form-horizontal form-simple" onsubmit="return false">
                        @csrf
                        <fieldset class="form-group position-relative has-icon-left mb-0">
                            <input type="text" class="form-control form-control-lg input-lg" id="username" name="username" placeholder="Username" required>
                            <div class="form-control-position"><i class="icon-head"></i></div>
                        </fieldset>
                        <fieldset class="form-group position-relative has-icon-left">
                            <input type="password" class="form-control form-control-lg input-lg" id="password" name="password" placeholder="Password" required>
                            <div class="form-control-position"><i class="icon-key3"></i></div>
                        </fieldset>
                        <button id="submit" type="submit" class="btn btn-primary btn-lg btn-block"><i class="icon-unlock2"></i> Login</button>
                    </form>
                </div>
            </div>
            <div class="card-footer">
                <div class="">
                    {{-- <p class="float-sm-left text-xs-center m-0"><a href="{{ url('/') }}" class="card-link">Home</a></p> --}}
                    <p class="float-sm-right text-xs-center m-0"><a href="{{ url('/') }}" class="card-link">Home</a></p>
                    <!-- <p class="float-sm-right text-xs-center m-0">New? <a href="#" class="card-link">Sign Up</a></p> -->
                </div>
            </div>
        </div>
    </div>
</section>

        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('template/robust/app-assets/js/core/libraries/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('template/robust/app-assets/vendors/js/ui/tether.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('template/robust/app-assets/js/core/libraries/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('template/robust/app-assets/vendors/js/ui/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('template/robust/app-assets/vendors/js/ui/unison.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('template/robust/app-assets/vendors/js/ui/blockUI.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('template/robust/app-assets/vendors/js/ui/jquery.matchHeight-min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('template/robust/app-assets/vendors/js/ui/screenfull.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('template/robust/app-assets/vendors/js/extensions/pace.min.js') }}" type="text/javascript"></script>
    <!-- END VENDOR JS-->
    
    <!-- BEGIN ROBUST JS-->
    <script src="{{ asset('template/robust/app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
    <script src="{{ asset('template/robust/app-assets/js/core/app.js') }}" type="text/javascript"></script>
    <!-- END ROBUST JS-->

    <script src="{{ asset('plugins/alertify/lib/alertify.min.js') }}"></script>

    <script type="text/javascript">
        jQuery(document).ready(function(){
        
            function doBounce(element, times, distance, speed) {
                for(i = 0; i < times; i++) {
                    element.animate({marginTop: '-='+distance},speed)
                        .animate({marginTop: '+='+distance},speed);
                }        
            }
            
            setTimeout(function(){
                jQuery("#username").focus();
            },1000);
            
            //login         
            jQuery('#submit').click(function(){
            
                //bouncing for awhile...
                doBounce(jQuery('#form-box'), 3, '10px', 100);
            
                jQuery(this).prop('disabled',true);
                jQuery(this).html('<span class="loading">Loading.....</span>');
                var lanjut=true;
                if(jQuery('#username').val()==''){
                    lanjut=false;
                }
                if(jQuery('#password').val()==''){
                    lanjut=false;
                }
                if(lanjut==true){
                    var url="login";
                    var data=jQuery('#form-login').serialize();
                    jQuery.ajax({
                        url:url,
                        data:data,
                        method:'POST',
                        success:function(result){
                            if(result.error==false){
                                window.location.href='./app/';
                            }
                            else{
                                alertify.log(result.message);
                                jQuery('#submit').html('<i class="icon-unlock2"></i> Login');
                                jQuery('#submit').prop('disabled', false);
                            }
                        },
                        error:function(result){
                            alertify.log('Sesi telah habis. Silakan refresh halaman browser Anda!');
                            jQuery('#submit').html('<i class="icon-unlock2"></i> Login');
                            jQuery('#submit').prop('disabled', false);
                        }
                    });
                }
                else{
                    alertify.log('Kolom username/password tidak dapat dikosongkan!');
                    jQuery('#submit').html('<i class="icon-unlock2"></i> Login');
                    jQuery('#submit').prop('disabled', false);
                }
            });
        });
    </script>
  </body>
</html>
