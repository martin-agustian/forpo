<div class="card card-nilai">
	@if (count($nilai_data) > 0)
		<div class="card-body">
			<table class="table table-bordered mb-0">
				<thead>
					<tr>
						<th>No</th>
						<th>Mata Pelajaran</th>
						<th>KKM</th>
						<th>Nilai</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($nilai_data as $key => $nilai)
						<tr>
							<td scope="row">{{ $key + 1 }}</td>
							<td>{{ $nilai->mata_pelajaran }}</td>
							<td>{{ $nilai->kkm }}</td>
							<td>{{ $nilai->nilai }}</td>
							<td>{{ $nilai->nilai > $nilai->kkm ? 'Lulus' : 'Tidak Lulus' }}</td>
						</tr>
					@endforeach                 
				</tbody>
			</table>
		</div>
	@else 
		<div class="text-20 text-semi-bold text-center p-5">
			Data Nilai Kosong
		</div>
	@endif
</div>