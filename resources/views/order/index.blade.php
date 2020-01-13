@extends('inventory.app')
    <!-- Begin Page Content -->

  @section('content')
    <div class="container-fluid">


    <div class="row">
      <div class="col-md-10">
        <h1>Orders</h1>
       </div>

      <div class="col-md-2">
        <a href="{{ route('order.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Create Order</a>
      </div>
      <div class="col-md-12">
        <hr>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <table class="table">
          <thead>
            <th>Email Address</th>
            <th>Order Status:</th>
            <th>Created at:</th>
            <th>Updated at:</th>
            <th colspan="2">Actions</th>
          </thead>
          <tbody>
            @foreach ($orders as $order)
              <tr>
                <td>{{ $order->customer_email }}</td>
                <td>{{ $order->status}}</td>
                <th>{{date('M j, Y h:ia', strtotime($order->created_at))}}</th>
                <th>{{date('M j, Y h:ia', strtotime($order->updated_at))}}</th>
                <td>
                  <form method="post" action="{{route('order.edit', $order->id)}} " >
                    {{ csrf_field() }}
                    @method('GET')
                    <input type="submit" class="btn btn-success btn-block" value="edit"  style="max-width: 100px">
                  </form>    

                </td>
                <td>
                  <form method="post" action="{{route('order.destroy', $order->id)}}"  >
                    {{ csrf_field() }}
                    @method('DELETE')
                    <input type="submit" name="" value="delete" class="btn btn-danger btn-block" style="max-width: 100px;">
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
    
      </div>
    </div>

  </div>
  <!-- End of Main Content -->
@endsection