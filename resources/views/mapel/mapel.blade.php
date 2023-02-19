@foreach ($mata_pelajaran_data as $key => $mata_pelajaran)
	<li 
		class="list-group-item {{ $key == 0 ? 'active' : '' }} mapel" 
		data-mapel="{{ $mata_pelajaran->id }}"
	>
		{{ $mata_pelajaran->nama }}
	</li>
@endforeach