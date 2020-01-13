@extends('inventory.app')
    <!-- Begin Page Content -->

  @section('content')
    <div class="container-fluid">


    <div class="row">
      <div class="col-md-10">
        <h1>Inventory</h1>
       </div>

      <div class="col-md-2">
        <a href="{{ route('inventory.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Add Product</a>
      </div>
      <div class="col-md-12">
        <hr>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <table class="table">
          <thead>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity available</th>
            <th colspan="2">Actions</th>
          </thead>
          <tbody>
            @foreach ($inventory as $product)
              <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity_available }}</td>
                <td>
                  <form method="post" action="{{route('inventory.edit', $product->id)}} " >
                    {{ csrf_field() }}
                    @method('GET')
                    <input type="submit" class="btn btn-success btn-block" value="edit"  style="max-width: 100px">
                  </form>    

                </td>
                <td>
                  <form method="post" action="{{route('inventory.destroy', $product->id)}}"  >
                    {{ csrf_field() }}
                    @method('DELETE')
                    <input type="submit" name="" value="delete" class="btn btn-danger btn-block" style="max-width: 100px;">
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="text-center">
          {!! $inventory->links(); !!}
        </div>
      </div>
    </div>

  </div>
  <!-- End of Main Content -->
@endsection