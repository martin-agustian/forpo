<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
	function __construct ()
	{
		$this->middleware('dashboard_guard');
	}

	public function index ()
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
		return view('nilai/index', $data);
	}

	function get_nilai (Request $request)
	{
		$siswa_data = request()->session()->get('siswa');

		$tahun_ajaran_id = $request->input('tahun_ajaran_id');
		
		$nilai_data = DB::table('nilai')
			->join('mata_pelajaran', 'mata_pelajaran.id', '=', 'nilai.mata_pelajaran_id')
			->where('nilai.siswa_id', '=', $siswa_data->id)
			->where('nilai.tahun_ajaran_id', $tahun_ajaran_id)
			->select(
				'mata_pelajaran.id as mata_pelajaran_id',
				'mata_pelajaran.nama as mata_pelajaran',
				'mata_pelajaran.kkm as kkm',
				'nilai.id as nilai_id',
				'nilai.nilai as nilai'
			)
			->get();

		// ** Defined Variable
		$data = array();
		$data['nilai_data'] = $nilai_data;
		
		// ** Return
		return view('nilai/nilai', $data);
	}
}