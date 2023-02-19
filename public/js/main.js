var host = $('base').attr('href');
var segment1 = $('#segment1').val();

var loading = '<div class="text-center py-2"><em class="fas fa-spinner fa-2x fa-spin"></em></div>';

$(document).ready(function() {

// ** Initialize Quill
new Quill('#js-quill-editor', {
	theme: 'snow'
});

if (segment1 == 'mapel') {
	mapel($('.js-tahun-ajaran').val());

	function mapel(tahun_ajaran_id) {
		$.ajax({
			url: host + '/mapel/get_mapel?tahun_ajaran_id='+tahun_ajaran_id,
			method: 'get',
			beforeSend: function () {
				$('.js-mata-pelajaran').html(loading);
			},
			success: function (data) {
				$('.js-mata-pelajaran').html(data);
				
				// show pertemuan
				pertemuan($('.mapel.active').attr('data-mapel'));
			}        
		});
	}

	$('.js-tahun-ajaran').on('change', function () {
		// show mapel
		mapel($(this).val());
	});

	function pertemuan(mata_pelajaran_id) {
		$.ajax({
			url: host + '/mapel/get_pertemuan?mata_pelajaran_id='+mata_pelajaran_id,
			method: 'get',
			beforeSend: function () {
				$('.js-pertemuan').html(loading);
			},
			success: function (data) {
				$('.js-pertemuan').html(data);
			}        
		});
	}

	$(document).on('click', '.js-mata-pelajaran', function() {
		// add class active
		$('.js-mata-pelajaran').removeClass('active');
		$(this).addClass('active');

		// show pertemuan
		pertemuan($(this).attr('data-mapel'));
	});

	forum_get_komentar($('.js-kirim-komentar').attr('data-id'));

	function forum_get_komentar(forum_id) {
		$.ajax({
			url: host + '/mapel/forum_get_komentar?forum_id='+forum_id,
			method: 'get',
			beforeSend: function () {
				$('.js-komentar').html(loading);
			},
			success: function (data) {
				$('.js-komentar').html(data);                
			}
		});
	}

	$('.js-kirim-komentar').on('click', function() {
		$.ajax({
			method: 'POST',            
			url: host + '/mapel/forum/send_comment',
			headers: {
				'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
			},
			data: {
				forum_id: $(this).attr('data-id'),
				komentar: $('#js-quill-editor').find('.ql-editor').html(),
			},
			// beforeSend: function () {
			// },
			success: function (data) {
				$('#js-quill-editor').find('.ql-editor').html('');
				forum_get_komentar($('.js-kirim-komentar').attr('data-id'));
			}
		});
		console.log();
	});

	// upload file size
	$('input[type="file"]').on('change', function () {
		if(this.files[0].size > 1000000) {
			alert('Please upload file less than 1MB');
			$(this).val('');
		}
	});

	// loading upload
	$('.js-tugas-upload').on('submit', function() {
		// show loading
		$(this).prev('.loading').show()
		// hide form
		$(this).hide();
	});
}

if (segment1 == 'jadwal') {
    jadwal($('.js-hari.active').attr('data-hari'), $('.js-tahun-ajaran').val());

	function jadwal(hari_id, tahun_ajaran_id) {
		$.ajax({
			url: host + '/jadwal/get_jadwal?hari_id='+hari_id+'&tahun_ajaran_id='+tahun_ajaran_id,
			method: 'get',
			beforeSend: function () {
				$('.js-jadwal').html(loading);
			},
			success: function (data) {
				$('.js-jadwal').html(data);
			}        
		});
	}

	$('.js-tahun-ajaran').on('change', function () {
		jadwal($('.js-hari.active').attr('data-hari'), $(this).val());
	});

	$(document).on('click', '.js-hari', function() {
		// add class active
		$('.js-hari').removeClass('active');
		$(this).addClass('active');

		// show pertemuan
		jadwal($(this).attr('data-hari'), $('.js-tahun-ajaran').val());
	});
}

if (segment1 == 'nilai') {
	nilai($('.js-tahun-ajaran').val());

	function nilai(tahun_ajaran_id) {
		$.ajax({
			url: host + '/nilai/get_nilai?tahun_ajaran_id='+tahun_ajaran_id,
			method: 'get',
			beforeSend: function () {
				$('.js-nilai').html(loading);
			},
			success: function (data) {
				$('.js-nilai').html(data);
			}        
		});
	}

	$('.js-tahun-ajaran').on('change', function () {
		nilai($(this).val());
	});
}

});