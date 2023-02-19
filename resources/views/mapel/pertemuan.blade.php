@if (!empty($guru_data) && count($pertemuan_data) > 0)
	<div class="card shadow">
		<div class="card-header">
			<div class="text-semi-bold">{{ $guru_data->guru_nama }}</div>
		</div>
		<div class="card-body">
			@foreach ($pertemuan_data as $key => $pertemuan)
				<div class="row mb-3" id="accordion" role="tablist">
					<div class="col-12">
						<div class="card shadow">
							<div class="card-header" role="tab" id="headingOne">
								<a 
									class="d-block text-black" 
									data-toggle="collapse" 
									href="#collapseOne"
									aria-controls="collapseOne"
								>
									<div class="row flex-y-center">
										<div class="col">
											Pertemuan Ke {{ $pertemuan->urutan }}
										</div>
										<div class="col-auto">
											<em class="fas fa-angle-down"></em>
										</div>
									</div>
								</a>
							</div>
						
							<div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
								<div class="card-body">
									<div class="mb-3">
										<div class="text-semi-bold">Judul:</div>
										<div>
											{{ $pertemuan->judul }}
										</div>
									</div>
									<div class="mb-3">
										<div class="text-semi-bold">Deskripsi:</div> 
										<div>
											{{ $pertemuan->deskripsi }}
										</div>
									</div>
									<div class="d-flex">
										@if ($pertemuan->link_materi)
											<a href="{{ $pertemuan->link_materi }}" target="_blank">
												<div class="text-16 badge badge-primary p-2 mr-2">
													Materi
												</div>
											</a>
										@endif

										<a href="{{ url('/mapel/tugas?pertemuan_id='.$pertemuan->id) }}">
											<div class="text-16 badge badge-secondary p-2 mr-2">
												Tugas
											</div>
										</a>

										<a href="{{ url('/mapel/forum?pertemuan_id='.$pertemuan->id) }}">
											<div class="text-16 badge badge-info p-2">
												Forum
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>    
			@endforeach
		</div>
	</div>
@else
	<div class="card shadow">
		<div class="card-body">
			<div class="text-20 text-semi-bold text-center p-5">
				Data Pertemuan Kosong
			</div>
		</div>
	</div>
@endif