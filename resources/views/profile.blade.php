<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <title>Profile</title>

  <link rel="stylesheet" href="{{ elixir('assets/admin/css/admin.min.css') }}">
</head>

<body>

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>


  @include('partial.nav.leftpanel')
  
  <div class="mainpanel">
    
    @include('partial.nav.headerbar')

    @include('partial.nav.pageheader')
    <div class="contentpanel">

      @yield('content')
      
    </div>
    
  </div><!-- mainpanel -->  
  
</section>

    <script src="{{ elixir('assets/admin/js/admin.min.js') }}"></script>
    @yield('footer-scripts')
    
    <!-- Adding fonts in the end of page load to increase productivity --> 
    <link rel="stylesheet" href="{!! url('assets/css/font-awesome.min.css') !!}">

</body>
</html>