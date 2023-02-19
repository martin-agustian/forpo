@extends('layouts.master.auth')

@section('content')

<section class="container py-5">
	@if($errors->any())
		<div class="alert alert-danger" role="alert">
			{{ $errors->first() }}
		</div>
	@endif

	<div class="row">
		<div class="col-12">
			<h1 class="text-25 text-semi-bold mb-4">
				Forpo
			</h1>
			<div class="mb-3">
				<form id="form" action="{{ url('/login') }}" method="POST">
					@csrf
					<div class="form-group">
						<input
							id="nama"
							class="form-control @error('nama') is-invalid @enderror" 
							name="nama" 
							placeholder="nama" 
							value="{{ old('nama') }}" 
							required
						>
	
						@error('nama')
							<div class="invalid-feedback">
								{{ ucfirst($errors->first('nama')) }}
							</div>
						@enderror
					</div>
					<div class="form-group">
						<input 
							id="password" 
							class="form-control @error('password') is-invalid @enderror" 
							name="password" 
							placeholder="Password" 
							type="password" 
							autocomplete="off" 
							required
						>
	
						@error('password')
							<div class="invalid-feedback">
								{{ ucfirst($errors->first('password')) }}
							</div>
						@enderror
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-one">
							Masuk
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

@endsection