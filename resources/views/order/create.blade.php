@extends('order.app')
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
        <h1 class="h3 mb-0 text-gray-800">Create Order</h1>
      </div>
      <form method="post" action="{{route('order.store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <label for="inventory_id">Select Product:</label>
      
        @foreach($inventory as $product)
        <div>
          <span>{{ $product->name }} ( {{$product->quantity_available}} left ) </span>
          {{-- <input  class="form-control" type="checkbox" name="product_id[]" value="{{ $product->id }}" > --}}
          <input type="number"  name="quantity[]" > 
          <input type="hidden" name="inventory_id[]" value="{{ $product->id }}" >
        </div>
          
        @endforeach

        <label for="customer_email">Email:</label>
        <input name="customer_email" class="form-control" type="email">

        <label for="order_status_id">Select Status:</label>

        <select class="form-control" name="order_status_id" >
          @foreach($orderStatus as $status)
            <option  value='{{ $status->id }}'
              @if ($status->status_name != "created") 
              disabled
              @endif
              >{{ $status->status_name }} 
            </option>
          @endforeach
        </select>

        <input type="submit" value="Create Order" class="btn btn-success btn-lg btn-block"  style="margin-top: 20px;"> 

      </form>

    </div>
  <!-- End of Main Content -->
  @endsection
