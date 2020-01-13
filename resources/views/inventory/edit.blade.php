
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

		<form method="post" action="{{route('inventory.update', $inventory->id)}}" enctype="multipart/form-data">
        <input type="hidden" name="user_id" value="">
        @method('PUT')
        {{ csrf_field() }}
        <label for="name">Name:</label>
        <input name="name" class="form-control" value="{{$inventory->name}}">

  
        <label for="description">Description:</label>
        <input name="description" class="form-control" value="{{$inventory->description}}">

        <label for="price">price:</label>
        <input name="price" class="form-control" value="{{$inventory->price}}">

        <label for="quantity_available">quantity_available:</label>
        <input name="quantity_available" class="form-control" value="{{$inventory->quantity_available}}">
     
        <input type="submit" value="Save" class="btn btn-success btn-lg form-control mt-3"> 
      </form>

	  <!-- End of Main Content -->
  @endsection