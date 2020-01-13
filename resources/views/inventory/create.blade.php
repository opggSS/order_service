@extends('inventory.app')
    <!-- Begin Page Content -->
  @section('styles')

    <style type="text/css">
      label {
        margin-top: 20px;
      }
  </style>

  <script src="https://cdn.tiny.cloud/1/sl6j0mvghyx0az1cb2hr37zwalpq4ykv58gbfrwqtry2xvdm/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script type="text/javascript">
    tinymce.init({
    selector: '.content'
    });
  </script>
  @stop

  @section('content')
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif


    <div class="container" style="margin-bottom: 50px;">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Inventory</h1>
      </div>
      <form method="post" action="{{route('inventory.store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <label for="name">Name:</label>
        <input name="name" class="form-control">

        <label for="description">description:</label>
        <input name="description" class="form-control">

        <label for="price">Price:</label>
        <input name="price" class="form-control">

        <label for="quantity_available">Quantity_available:</label>
        <input name="quantity_available" class="form-control">

        <input type="submit" value="Add to inventory" class="btn btn-success btn-lg btn-block"> 
      </form>

    </div>
  <!-- End of Main Content -->
  @endsection
