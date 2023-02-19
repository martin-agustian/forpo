@if (count($jadwal_data) > 0)
	<div class="card shadow">
		<div class="card-body">
			<div class="text-semi-bold mb-4">Course Schdule</div>
			<div class="row gutters-0px border border-2px border-black rounded">
				<div class="col-12 {{ count($jadwal_data) > 3 ? 'border-2px border-right border-black' : '' }} p-3">
					@foreach ($jadwal_data as $key => $jadwal)
						@if ($key < 3)
							<div class="row py-1">
								<div class="col text-semi-bold">
									{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
								</div>
								<div class="col text-semi-bold">
									{{ $jadwal->mata_pelajaran }}
								</div>
								<div class="col text-semi-bold">
									{{ $jadwal->guru }}
								</div>
							</div>
						@endif
					@endforeach
				</div>
			</div>
		</div>
	</div>
@else
	<div class="card shadow">
		<div class="card-body">            
			<div class="text-20 text-semi-bold text-center p-5">
				Data Jadwal Kosong
			</div>
		</div>
	</div>
@endif