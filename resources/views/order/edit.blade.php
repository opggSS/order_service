
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

  @php
    // disable inputs if status != created 
    $flag = $order->order_status_id != 1 ;
  @endphp

    <div class="container" style="margin-bottom: 50px;">

		<form method="post" action="{{route('order.update', $order->id)}}" enctype="multipart/form-data">
        <input type="hidden" name="user_id" value="">
        @method('PUT')
        {{ csrf_field() }}

        <ul>
        @foreach ($orderDetails as $details)
          <li> 
            <label for="name"> product name: {{$details["name"]}}</label>
            <span></span>
            <input type="text" name="quantity[]" value="{{ $details['quantity'] }}" type="number" min="1" @if($flag) disabled @endif>
          </li>
        @endforeach
        </ul>

        <label for="customer_email">Email:</label>
        <input name="customer_email" class="form-control" type="email" value="{{$order->customer_email}}"  @if($flag) disabled @endif>

        <label for="order_status_id">Select Status:</label>
        <select class="form-control" name="order_status_id">
          @foreach ($orderStatus as $status)
            <option value='{{$status->id}}' 
              @if ($status->id == $order->order_status_id)
                selected
              @endif
               @if($flag) disabled @endif 
              >{{ $status->status_name }}
            </option>
            @endforeach
        </select>
     
        <input type="submit" value="@if($flag) (Cannot make any change at this stage)@else Save @endif" class="btn btn-success btn-lg form-control mt-3"  @if($flag) disabled @endif> 
      </form>

	  <!-- End of Main Content -->
  @endsection