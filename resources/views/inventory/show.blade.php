@extends('inventory.app')

  @section('content')
    <div class="container">
    	{{-- {{dd($post)}} --}}
   
			

			<dl class="dl-horizontal">
				<label>Product Name:</label>
				<p>
					{{ $inventory->name }}
				</p>
			</dl>
			<dl class="dl-horizontal">
				<label>Description:</label>
				<p>
					{{ $inventory->description }}
				</p>
			</dl>
			<dl class="dl-horizontal">
				<label>Price:</label>
				<p>
					{{ $inventory->price }}
				</p>
			</dl>
			<dl class="dl-horizontal">
				<label>Quantity Available:</label>
				<p>
					{{ $inventory->quantity_available }}
				</p>
			</dl>

			
			<hr>
			
				
	

			<form method="post" action="{{route('inventory.destroy', $inventory->id)}}"  >
				{{ csrf_field() }}
				@method('DELETE')
				<input type="submit" name="" value="delete" class="btn btn-danger btn-block" style="max-width: 100px; dis">
			</form>


			<form method="post" action="{{route('inventory.edit', $inventory->id)}} " >
				{{ csrf_field() }}
				@method('GET')
				<input type="submit" class="btn btn-success btn-block" value="edit"  style="max-width: 100px">
			</form>
				


			
	</div>

  </div>
  <!-- End of Main Content -->
@endsection