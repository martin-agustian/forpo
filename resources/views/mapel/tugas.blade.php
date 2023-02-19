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
						<li class="breadcrumb-item">
							<a href="{{ url('/mapel') }}" class="text-black">
								Mapel {{ $pertemuan_data->mata_pelajaran }}
							</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">
							Tugas
						</li>
					</ol>
				</nav>
			</div>
			<div class="col-12">
				<div class="card shadow">
					<div class="card-header">
						<div class="text-semi-bold">
							Pertemuan {{ $pertemuan_data->urutan }}
						</div>
						<div class="text-nobold">
							{{ $pertemuan_data->judul }}
						</div>
					</div>
					<div class="card-body">
						@foreach ($tugas_data as $key => $tugas)
							<div class="col-12 {{ $key == 0 ? '' : 'mt-4' }}">
								<div class="card shadow">
									<div class="card-body">
										<div class="loading text-center py-2" style="display: none">
											<em class="fas fa-spinner fa-2x fa-spin"></em>
										</div>
										<form 
											action="{{ url('/mapel/tugas/upload') }}" 
											method="POST" 
											enctype="multipart/form-data" 
											class="upload_tugas"
										>
											@csrf
											<div class="text-semi-bold">{{ $tugas->judul }} :</div>
											<div class="mb-3">{{ $tugas->deskripsi }}</div>
											@foreach ($tugas_file_data as $key2 => $tugas_file)
												@if ($tugas->id == $tugas_file->tugas_id)
													<a 
														class="d-block" 
														href="{{ asset('/uploads/tugas/'.$tugas_file->file) }}"
													>
														{{ $tugas_file->file }}
													</a>
												@endif
											@endforeach
											<input type="hidden" name="tugas_id" value="{{ $tugas->id }}">
											{{-- accept="application/msword, text/plain, application/pdf" --}}
											<input type="file" name="tugas" class="mt-3">
											<div class="mt-4">
												<button 
													type="submit" 
													class="btn btn-pill btn-yellow text-semi-bold"
												>
													Upload
												</button>
											</div>                                     
										</form>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection