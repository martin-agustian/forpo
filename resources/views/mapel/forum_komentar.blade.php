@foreach ($forum_komentar_data as $key => $forum_komentar)
	<div class="row no-gutters my-3">                            
		<div class="col-12 border-bottom pb-2">
			{{ ucfirst($forum_komentar->siswa_nama) }} Comment :
		</div>
		<div class="col-12 mt-2">
			{!! $forum_komentar->komentar !!}
		</div>
	</div>
@endforeach
