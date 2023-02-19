@extends('layouts.master.dashboard')

@section('content')
	<section>
		<div class="row mt-4">
			<div class="col-12 mb-2">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ url('/dashboard') }}" class="text-black">
								Dashboard
							</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">
							Mapel
						</li>
					</ol>
				</nav>
			</div>
			<div class="col-4">
				<select class="custom-select custom-select-forpo mb-3 js-tahun-ajaran">
					@if (count($tahun_ajaran_data) > 0)
						<option disabled>Pilih Tahun Ajaran</option>
						@foreach ($tahun_ajaran_data as $key => $tahun_ajaran)
							<option value="{{ $tahun_ajaran->id }}" {{ $key == 0 ? 'selected = selected' : '' }}>
								{{ $tahun_ajaran->mulai }} - {{ $tahun_ajaran->selesai }}
							</option>
						@endforeach
					@else
						<option selected="selected" value="">
							Pilih Tahun Ajaran
						</option>
					@endif
				</select> 

				<ul class="list-group list-group-forpo js-mata-pelajaran"></ul>
			</div>
			<div class="col-8 js-pertemuan"></div>
		</div>
	</section>
@endsection