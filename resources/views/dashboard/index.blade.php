@extends('layouts.master.dashboard')

@section('content')

<section>
	<div class="row">
		<div class="col-6 mt-5">
			<div class="card shadow">
				<div class="card-header">
					Data Siswa
				</div>
				<div class="card-body">
					@if (!empty($siswa_data))
						<div class="row text-left">
							<div class="col-6 mb-3">
								<div class="text-semi-bold">Nama</div>
								{{ ucfirst($siswa_data->nama) }}
							</div>
							<div class="col-6 mb-3">
								<div class="text-semi-bold">Kelas</div>
								{{ $siswa_data->kelas }} {{ $siswa_data->kelas_grup }}
							</div>
							<div class="col-6 mb-3">
								<div class="text-semi-bold">Tahun Ajaran</div>
								{{ $siswa_data->tahun_ajaran_mulai }} -
								{{ $siswa_data->tahun_ajaran_selesai }}
							</div>
							<div class="col-6 mb-3">
								<div class="text-semi-bold">Semester</div>
								{{ ucfirst($siswa_data->semester) }}
							</div>
							<div class="col-6 mb-3">
								<div class="text-semi-bold">Wali Kelas</div>
								{{ $siswa_data->wali_nama }}
							</div>
						</div>
					@else
						<div class="text-18 text-semi-bold text-center p-3">
							Data Siswa Tidak Ditemukan
						</div>
					@endif
				</div>
			</div>
		</div>
		<div class="col-6 mt-5">
			<div class="card card-semester shadow">
				<div class="card-header">
					Nilai Tahun Ajaran
					{{ request()->session()->get('siswa')->tahun_ajaran_mulai }} -
					{{ request()->session()->get('siswa')->tahun_ajaran_selesai }}
				</div>
				<div class="card-body">
					@if (count($nilai_data) > 0)
						<div id="slide-grade" class="carousel slide h-100" data-interval="false">
							<div class="carousel-inner h-100" role="listbox">
								@foreach ($nilai_data as $key => $nilai)
									<div class="carousel-item {{ $key == 0 ? 'active' : '' }} h-100">
										<div class="d-inline-block bg-black text-white px-3 py-1 mb-3">
											<span class="text-16 text-semi-bold">
												{{ $nilai->mata_pelajaran }}
											</span>
										</div>
										<div class="grade mt-1">
											{{ $nilai->nilai }}
										</div>
										<div class="text-black text-semi-bold mt-1">
											KKM: <span class="text-20">{{ $nilai->kkm }}</span>
										</div>
										@if ($nilai->nilai < $nilai->kkm)
											<div class="mt-2">Perlu Remedial</div>
										@endif
									</div>
								@endforeach
							</div>
							<a class="carousel-control-prev" href="#slide-grade" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#slide-grade" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>                        
					@else                        
						<div class="flex-center h-100">
							<div class="text-18 text-semi-bold text-center p-3">
								Data IPK tidak ditemukan
							</div>                            
						</div>
					@endif                    
				</div>
			</div>
		</div>
		<div class="col-12 mt-5">
			<div class="card shadow">
				<div class="card-header">
					Jadwal Hari Ini
				</div>
				<div class="card-body">
					@if (count($jadwal_hari_ini_data) > 0)
						<div class="row text-center">
							@foreach ($jadwal_hari_ini_data as $key => $jadwal)
								<div class="col-3">
									<div class="text-light-bold">
										{{ $jadwal->mata_pelajaran }}
									</div>
									<div class="mt-1">
										{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
									</div>
									<div class="mt-1">
										{{ $jadwal->guru }}
									</div>
								</div>
							@endforeach
						</div>
					@else
						<div class="text-18 text-semi-bold text-center p-3">
							Tidak Ada Jadwal Hari Ini
						</div>
					@endif
				</div>
			</div>
		</div>
		<div class="col-12 mt-5">
			<div class="card shadow h-100">
				<div class="card-header">
					Pengunguman
				</div>
				<div class="card-body">
					@if (count($pengunguman_data) > 0)
						<ul>
							@foreach ($pengunguman_data as $key => $pengunguman)
								<li class="py-1">{{ $pengunguman->text }}</li>
							@endforeach
						</ul>
					@else
						<div class="flex-center h-100">
							<div class="text-18 text-semi-bold text-center p-3">
								Tidak Ada Pengunguman Saat ini
							</div>                            
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</section>

@endsection