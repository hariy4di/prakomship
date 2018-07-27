<!DOCTYPE html>
<html ng-app="spa">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>S.H.I.P.</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="{{ asset('template/adminlte245/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template/adminlte245/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template/adminlte245/bower_components/Ionicons/css/ionicons.min.css') }}">
  
  <link rel="stylesheet" href="{{ asset('template/adminlte245/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template/adminlte245/dist/css/skins/_all-skins.min.css') }}">

  <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.bootstrap.css') }}">

  <!-- Plugins -->
  <link href="{{ asset('plugins/chosen/chosen.min.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/alertify/themes/alertify.core.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/alertify/themes/alertify.default.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/jquery-file-upload/css/jquery.fileupload.css') }}" rel="stylesheet">

  <!-- Angular -->
  <link href="{{ asset('template/angular/loading-bar.css') }}" rel="stylesheet" media='all'>

  <link rel="stylesheet" href="{{ asset('template/css/custom.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style>
    th{text-align: center;}
    .table-center{text-align: center;}
  </style>
</head>
<body class="hold-transition skin-purple-light sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">SHIP</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>S.H.I.P.</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('data/user/foto/no-image.jpg') }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ $info_nama }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ asset('data/user/foto/no-image.jpg') }}" class="img-circle" alt="User Image">

                <p>
                  {{ $info_nama }} - {{ $info_instansi }}
                  <!-- <small>Member since Nov. 2012</small> -->
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <!-- <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div> -->
                <div class="pull-right">
                  <a href="{{ url('logout') }}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('data/user/foto/no-image.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ $info_nama }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        {!! $menu !!}
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" ui-view>
    
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs"><b>Version</b> 0.0.1</div>
    <strong>Copyright &copy; 2018 <a href="#">Prakomship</a>.</strong> All rights reserved.
  </footer>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<script src="{{ asset('template/adminlte245/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('template/adminlte245/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('template/adminlte245/bower_components/jquery-ui/jquery-ui.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<script src="{{ asset('template/adminlte245/bower_components/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('template/adminlte245/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('template/adminlte245/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('template/adminlte245/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('template/adminlte245/bower_components/chart.js/Chart.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('template/adminlte245/dist/js/demo.js') }}"></script>

<!-- Plugins -->
<script src="{{ asset('plugins/DataTables/DataTables-1.10.16/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/DataTables/DataTables-1.10.16/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/chosen/chosen.jquery.min.js') }}"></script>
<script src="{{ asset('plugins/alertify/lib/alertify.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-file-upload/js/jquery.fileupload.js') }}"></script>

<!-- Angular -->
<script src="{{ asset('template/angular/angular.min.js') }}"></script>
<script src="{{ asset('template/angular/angular-ui-router.min.js') }}"></script>
<script src="{{ asset('template/angular/ngStorage.js') }}"></script>
<script src="{{ asset('template/angular/loading-bar.js') }}"></script>
<!-- App Router JS -->
<script>{!! $angular !!}</script>

<script>
  jQuery(document).ready(function(){
    
    jQuery("body").off("keypress",'.val_char').on("keypress",'.val_char',function (e) {
    
      var charcode = e.which;
      if (
        (charcode === 8) || // Backspace
        (charcode === 13) || // Enter
        (charcode === 127) || // Delete
        (charcode === 32) || // Space
        (charcode === 0) || // arrow
        //(charcode === 188) || // Koma
        //(charcode === 190) || // Titik
        //(charcode === 173) || // _
        //(charcode === 9) || // Horizontal Tab
        //(charcode === 11) || // Vertical Tab
        //(charcode >= 37 && charcode <= 40) || // arrow
        //(charcode >= 48 && charcode <= 57) ||// 0 - 9
        (charcode >= 65 && charcode <= 90) || // a - z
        (charcode >= 97 && charcode <= 122) // A - Z
        )
      { 
        console.log(charcode)
      }
      else
      {
        e.preventDefault()
        return
      }
    }); 

    jQuery("body").off("keypress",'.val_name').on("keypress",'.val_name',function (e) {
      var charcode = e.which;
      if (
        (charcode === 8) || // Backspace
        (charcode === 13) || // Enter
        (charcode === 127) || // Delete
        (charcode === 32) || // Space
        (charcode === 0) || // arrow
        (charcode == 188) || // Koma
        (charcode == 190) || // Titik
        //(charcode === 173) || // _
        //(charcode === 9) || // Horizontal Tab
        //(charcode === 11) || // Vertical Tab
        //(charcode >= 37 && charcode <= 40) || // arrow
        //(charcode >= 48 && charcode <= 57) ||// 0 - 9
        (charcode >= 65 && charcode <= 90) || // a - z
        (charcode >= 97 && charcode <= 122) // A - Z
        )
      { 
        console.log(charcode)
      }
      else
      {
        e.preventDefault()
        return
      }
    }); 

    //hanya alpabet
    jQuery("body").off("keypress",'.val_num').on("keypress",'.val_num',function (e) {
      var charcode = e.which;
      if (
        (charcode === 8) || // Backspace
        (charcode === 13) || // Enter
        (charcode === 127) || // Delete
        (charcode === 0) || // arrow
        (charcode >= 48 && charcode <= 57)// 0 - 9
        )
      { 
        console.log(charcode)
      }
      else
      {
        e.preventDefault()
        return
      }
    });
    
  });
</script>

</body>
</html>
