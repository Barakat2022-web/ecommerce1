<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>@yield('title')</title>

  <!-- Favicons -->
  <link href="{{asset('admin/img/favicon.png')}}" rel="icon">
  <link href="{{asset('admin/img/apple-touch-icon.png" rel="apple-touch-icon')}}">

  <!-- Bootstrap core CSS -->
  <link href="{{asset('admin/lib/bootstrap/css/rtl-bootstrap.min.css')}}" rel="stylesheet">

  <!--external css-->
  <link href="{{asset('admin/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="{{asset('admin/css/bootstrap-fileupload.css')}}" />
  <!-- Custom styles for this template -->
  <link href="{{asset('admin/css-rtl/style.css')}}" rel="stylesheet">
  <link href="{{asset('admin/css-rtl/style-responsive.css')}}" rel="stylesheet">
  <link href="{{asset('admin/css-rtl/radio-button.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('admin/css-rtl/DT_bootstrap.css')}}"/>
  <link rel="stylesheet" href="{{asset('admin/css-rtl/demo_table.css')}}"/>

  <link rel="stylesheet" href="style.css">



  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
<section id="container">
  <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
     @include('admin.includes.header')
      <!--header end-->

    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    @include('admin.includes.sidebar')
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    @yield('content')
    <!-- MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
   @include('admin.includes.footer')
    <!--footer end-->
</section>


  <!-- js placed at the end of the document so the pages load faster -->
  <script src="{{asset('admin/lib/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('admin/lib/bootstrap/js/bootstrap.min.js')}}"></script>
  <script class="include" type="text/javascript" src="{{asset('admin/lib/jquery.dcjqaccordion.2.7.js')}}"></script>
  <script src="{{asset('admin/lib/jquery.scrollTo.min.js')}}"></script>
  <script src="{{asset('admin/lib/jquery.nicescroll.js')}}" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="{{asset('admin/lib/common-scripts.js')}}"></script>
  <!--script for this page-->

  <script src="{{asset('admin/js/bootstrap-fileupload.js')}}"></script>

</body>

</html>
