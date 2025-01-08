@if(count($errors))
	<div class="alert alert-danger alert-dismissible fade show" role="alert" style="">
	  <div class="container">
	  	<strong>Oops!</strong> 

				@foreach($errors->all() as $error)
			
			  		{{ $error }}&nbsp;
			  
				@endforeach
			
			  
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
	  </div>
	  
	</div>
@endif

@if(session()->has('error'))
	<div class="alert alert-danger alert-dismissible fade show" role="alert" style="">
	  <div class="container">
	  	<strong>Oops!</strong> 

				{{ session()->get('error') }}
			
			  
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
	  </div>
	  
	</div>
@endif

@if(session()->has('success'))
	<div class="alert alert-success alert-dismissible fade show" role="alert" style="">
	  <div class="container">
	  	<strong>Success!</strong> 

				{{ session()->get('success') }}
			
			  
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
	  </div>
	  
	</div>
@endif