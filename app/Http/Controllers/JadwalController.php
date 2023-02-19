<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class JadwalController extends Controller
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

		$hari_data = (object) array(
			'mon' => 'senin',
			'tue' => 'selasa',
			'wed' => 'rabu',
			'thu' => 'kamis',
			'fri' => 'jumat',
			'sat' => 'sabtu',
		);

		$hari_ini_data = DB::table('hari')
			->where('hari.hari', $hari_data->{ strtolower(date('D')) })
			->first();

		$hari_data = DB::table('hari')->get();

		// ** Defined Variable
		$data = array();
		$data['title'] = 'Mata Pelajaran';
		$data['siswa_data'] = $siswa_data; 
		$data['tahun_ajaran_data'] = $tahun_ajaran_data;
		$data['hari_data'] = $hari_data;
		$data['hari_ini_data'] = $hari_ini_data;
		
		// ** Return
		return view('jadwal/index', $data);
	}

	public function get_jadwal (Request $request)
	{
		$siswa_data = request()->session()->get('siswa');

		$hari_id = $request->input('hari_id');
		$tahun_ajaran_id = $request->input('tahun_ajaran_id');

		$jadwal_data = DB::table('jadwal')
			->join('hari', 'hari.id', '=', 'jadwal.hari_id')
			->join('jam', 'jam.id', '=', 'jadwal.jam_id')
			->join('mata_pelajaran', 'mata_pelajaran.id', '=', 'jadwal.mata_pelajaran_id')
			->join('guru', 'guru.id', '=', 'mata_pelajaran.guru_id')
			->where('jadwal.hari_id', $hari_id)
			->where('jadwal.tahun_ajaran_id', $tahun_ajaran_id)
			->where('mata_pelajaran.kelas_id', $siswa_data->kelas_id)
			->orderBy('jam.mulai', 'desc')
			->select(
				'mata_pelajaran.id as mata_pelajaran_id',
				'mata_pelajaran.nama as mata_pelajaran',
				'jam.id as jam_id',
				'jam.mulai as jam_mulai',
				'jam.selesai as jam_selesai',
				'guru.id as guru_id',
				'guru.nama as guru'
			)
			->get();

		// ** Defined Variable
		$data = array();
		// $data['guru'] = $guru;
		$data['jadwal_data'] = $jadwal_data;
		
		// ** Return
		return view('jadwal/jadwal', $data)->render();
	}
}