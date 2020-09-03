<!DOCTYPE html>
<html lang="en">
@yield('styles')
<head>
@include('includes._header')
<body id="page-top">

  <div id="wrapper">

   
    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">

        @include('includes._topbar')
        @include('includes._message')
		@yield('content')
		@include('includes._footer')
		@yield('scripts')
  
</body>
</html>