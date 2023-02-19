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
							Forum
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
							Topik : {{ $forum_data->judul }}
						</div>
					</div>
					<div class="card-body">
						<div class="mb-5">{{ $forum_data->deskripsi }}</div>

						<div class="js-komentar mb-5"></div>

						<div id="js-quill-editor"></div>

						<div class="text-right mt-4">
							<button 
								class="btn btn-pill btn-yellow text-semi-bold js-kirim-komentar" 
								data-id="{{ $forum_data->id }}"
							>
								Comment
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection