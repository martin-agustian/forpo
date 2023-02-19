<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MapelController extends Controller
{   
	function __construct ()
	{
		$this->middleware('dashboard_guard');
	}

	public function index (Request $request)
	{        
		$siswa_data = request()->session()->get('siswa');
		
		if (!empty($siswa_data->tahun_lulus)) {
			$tahun_ajaran_data = DB::table('tahun_ajaran')
				->where('tahun_ajaran.mulai', '>=', $siswa_data->tahun_masuk)
				->where('tahun_ajaran.selesai', '<=', $siswa_data->tahun_lulus)
				->get();
		}
		else {
			$tahun_ajaran_data = DB::table('tahun_ajaran')
				->where('tahun_ajaran.mulai', '>=', $siswa_data->tahun_masuk)
				->get();
		}

		// ** Defined Variable
		$data = array();
		$data['title'] = 'Mata Pelajaran';
		$data['tahun_ajaran_data'] = $tahun_ajaran_data;
		
		// ** Return
		return view('mapel/index', $data);
	}

	public function get_mapel (Request $request)
	{
		$tahun_ajaran_id = $request->input('tahun_ajaran_id');

		if (empty($tahun_ajaran_id) || $tahun_ajaran_id == "undefined") {
			$tahun_ajaran_id = DB::table('tahun_ajaran')->first()->id;
		}

		$mata_pelajaran_data = DB::table('mata_pelajaran')
			->where('id', $tahun_ajaran_id)
			->get();

		// ** Defined Variable
		$data = array();
		$data['mata_pelajaran_data'] = $mata_pelajaran_data;
		
		// ** Return
		return view('mapel/mapel', $data)->render();
	}

	public function get_pertemuan (Request $request)
	{
		$mata_pelajaran_id = $request->input('mata_pelajaran_id');
		
		$guru_data = DB::table('mata_pelajaran')
			->join('guru', 'guru.id', '=', 'mata_pelajaran.guru_id')
			->where('mata_pelajaran.id', $mata_pelajaran_id)
			->select(
				'guru.id as guru_id',
				'guru.nama as guru_nama'
			)
			->first();

		$pertemuan_data = DB::table('pertemuan')
			->where('pertemuan.mata_pelajaran_id', $mata_pelajaran_id)
			->orderBy('pertemuan.urutan', 'asc')
			->get();

		// $materi = DB::table('materi')->get();

		// ** Defined Variable
		$data = array();
		$data['guru_data'] = $guru_data;        
		// $data['materi'] = $materi;
		$data['pertemuan_data'] = $pertemuan_data;
		
		// ** Return
		return view('mapel/pertemuan', $data)->render();
	}

	public function tugas (Request $request)
	{
		$pertemuan_id = $request->input('pertemuan_id');

		$siswa_data = request()->session()->get('siswa');

		$pertemuan_data = DB::table('pertemuan')
			->join('mata_pelajaran', 'mata_pelajaran.id', '=', 'pertemuan.mata_pelajaran_id')
			->where('pertemuan.id', $pertemuan_id)
			->orderBy('pertemuan.urutan', 'asc')
			->select(
				'pertemuan.*',
				'pertemuan.mata_pelajaran_id as mata_pelajaran_id',
				'mata_pelajaran.nama as mata_pelajaran'
			)
			->first();

		$tugas_data = DB::table('tugas')
			->where('tugas.pertemuan_id', $pertemuan_id)
			->get();

		$tugas_file_data = DB::table('tugas_file')
			->where('siswa_id', '=', $siswa_data->id)
			->get();

		// ** Defined Variable
		$data = array();
		$data['title'] = 'tugas';
		$data['pertemuan_data'] = $pertemuan_data;
		$data['tugas_data'] = $tugas_data;
		$data['tugas_file_data'] = $tugas_file_data;
		
		// ** Return
		return view('mapel/tugas', $data);
	}

	public function tugas_upload (Request $request)
	{
		// ** Validation
		$validator = $request->validate([
			'tugas' => 'required',
		], [
			'tugas.required' => 'tugas harus diupload.',
		]);

		$siswa_data = $request->session()->get('siswa');
		$tugas_id = $request->input('tugas_id');
		$tugas_data = $request->file('tugas');

		$tugas_name = time() . '.' . $tugas_data->getClientOriginalExtension();
		Storage::disk("public")->put('tugas/'.$tugas_name, file_get_contents($tugas_data));

		DB::table('tugas_file')
			->where('id', '=', $tugas_id)
			->insert(array(
				'tugas_id' => $tugas_id,
				'siswa_id' => $siswa_data->id,
				'file' => $tugas_name,
			));
		
		// ** Return
		return redirect()->back();
	}

	public function forum (Request $request)
	{
		$pertemuan_id = $request->input('pertemuan_id');

		$pertemuan_data = DB::table('pertemuan')
			->join('mata_pelajaran', 'mata_pelajaran.id', '=', 'pertemuan.mata_pelajaran_id')
			->where('pertemuan.id', $pertemuan_id)
			->orderBy('pertemuan.urutan', 'asc')
			->select(
				'pertemuan.*',
				'pertemuan.mata_pelajaran_id as mata_pelajaran_id',
				'mata_pelajaran.nama as mata_pelajaran'
			)
			->first();

		$forum_data = DB::table('forum')
			->where('forum.pertemuan_id', $pertemuan_id)
			->first();

		// ** Defined Variable
		$data = array();
		$data['title'] = 'Forum';
		$data['pertemuan_data'] = $pertemuan_data;
		$data['forum_data'] = $forum_data;
		
		// ** Return
		return view('mapel/forum', $data);
	}

	public function forum_get_komentar (Request $request)
	{        
		$siswa_data = request()->session()->get('siswa');

		$forum_id = $request->input('forum_id');
		
		$forum_komentar_data = DB::table('forum_komentar')
			->join('siswa', 'siswa.id', '=', 'forum_komentar.siswa_id')    
			->where('forum_komentar.forum_id', '=', $forum_id)
			->select(
				'siswa.id as siswa_nama',
				'siswa.nama as siswa_nama',
				'forum_komentar.id as komentar_id',
				'forum_komentar.komentar as komentar'
			)
			->get();
		
		// ** Defined Variable
		$data = array();
		$data['forum_komentar_data'] = $forum_komentar_data;
		
		// ** Return
		return view('mapel/forum_komentar', $data)->render();
	}

	public function forum_kirim_komentar (Request $request)
	{
		$siswa_data = request()->session()->get('siswa');
		$forum_id = $request->input('forum_id');
		$komentar = $request->input('komentar');

		if (!empty($forum_id) && !empty(strip_tags($komentar))) {
			DB::table('forum_komentar')->insert(
				array(
					'forum_id' => $forum_id, 
					'siswa_id' => $siswa_data->id,
					'komentar' => $komentar,
				)
			);
		}
		
		// ** Return
		return 'success';
	}    
}