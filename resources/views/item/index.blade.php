@extends('item.app')
    <!-- Begin Page Content -->

  @section('content')
    <div class="container-fluid">

    <div class="row">
      <div class="col-md-10">
        <h1>Products</h1>
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
            <th>Weight(kg):</th>
            <th>length(cm):</th>
            <th>width(cm):</th>
            <th>height(cm):</th>
            <th>Action1</th>
            <th>Action2</th>
          </thead>
          <tbody>
            <form method="post" action="{{route('item.store')}}" >
            {{ csrf_field() }}
              <tr>
                <td><input name="name" type="text" ></td>
                <td><input name="weight" type="number" placeholder="1.99" step="0.01" min="0" ></td>
                <td><input name="length" type="number" placeholder="10"  min="1" ></td>
                <td><input name="width" type="number" placeholder="10"  min="1" ></td>
                <td><input name="height" type="number"  placeholder="10" min="1"></td>
                <td> <input type="submit" value="Create Item" class="btn btn-success btn-block" style="max-width: 100px"> </td>
              </tr>
            </form>

            @foreach ($items as $item)

            <tr>
              <form method="post" action="{{route('item.update', $item->id)}}" enctype="multipart/form-data">
                @method('PUT')
                {{ csrf_field() }}
                  <td><input type="text" name="name" value="{{$item->name}}" type="text" min="5" max="255"></td>
                  <td><input type="text" name="weight" value="{{$item->weight}}" type="number" min="1" ></td>
                  <td><input type="text" name="length" value="{{$item->length}}" type="number" min="1" ></td>
                  <td><input type="text" name="width" value="{{$item->width}}" type="number" min="1" ></td>
                  <td><input type="text" name="height" value="{{$item->height}}" type="number" min="1" ></td>
                  <td><input type="submit" value="update" class="btn btn-success btn-block" style="max-width: 100px;"></td>
              </form>

              <td>
                <form method="post" action="{{route('item.destroy', $item->id)}}"  >
                    {{ csrf_field() }}
                    @method('DELETE')
                    <input type="submit" value="delete" class="btn btn-danger btn-block" style="max-width: 100px;">
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