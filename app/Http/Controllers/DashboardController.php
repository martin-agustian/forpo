<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
	function __construct()
	{
		$this->middleware('dashboard_guard');
	}

	public function index()
	{
		$siswa_data = request()->session()->get('siswa');

		$hari_data = (object) array(
			'mon' => 'senin',
			'tue' => 'selasa',
			'wed' => 'rabu',
			'thu' => 'kamis',
			'fri' => 'jumat',
			'sat' => 'sabtu',
			'sun' => 'minggu',
		);

		$hari_ini_data = DB::table('hari')
			->where('hari.hari', $hari_data->{ strtolower(date('D')) })
			->first();

		$jadwal_hari_ini_data = DB::table('jadwal')
			->join('hari', 'hari.id', '=', 'jadwal.hari_id')
			->join('jam', 'jam.id', '=', 'jadwal.jam_id')
			->join('mata_pelajaran', 'mata_pelajaran.id', '=', 'jadwal.mata_pelajaran_id')
			->join('kelas', 'kelas.id', '=', 'mata_pelajaran.kelas_id')
			->join('guru', 'guru.id', '=', 'mata_pelajaran.guru_id')
			->where('jadwal.hari_id', '=', $hari_ini_data->id)
			->select(
				'jadwal.id as jadwal_id',
				'hari.id as hari_id',
				'hari.hari as hari',
				'jam.id as jam_id',
				'jam.mulai as jam_mulai',
				'jam.selesai as jam_selesai',
				'kelas.id as kelas_id',
				'kelas.kelas as kelas',
				'mata_pelajaran.id as mata_pelajaran_id',
				'mata_pelajaran.nama as mata_pelajaran',
				'guru.id as guru_id',
				'guru.nama as guru'
			)
			->get();

		$pengunguman_data = DB::table('pengunguman')
			->whereIn('pengunguman.siswa_id', [0, $siswa_data->id])
			->whereIn('pengunguman.kelas_id', [0, $siswa_data->kelas_id])
			->get();

		$nilai_data = DB::table('siswa')
			->join('nilai', 'nilai.siswa_id', '=', 'siswa.id')
			->join('mata_pelajaran', 'mata_pelajaran.id', '=', 'nilai.mata_pelajaran_id')
			->where('siswa.id', '=', $siswa_data->id)		
			->whereColumn('siswa.kelas_id', '=', 'mata_pelajaran.kelas_id')
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
		$data['title'] = 'Dashboard';
		$data['siswa_data'] = $siswa_data;
		$data['jadwal_hari_ini_data'] = $jadwal_hari_ini_data;
		$data['pengunguman_data'] = $pengunguman_data;
		$data['nilai_data'] = $nilai_data;
		
		// ** Return
		return view('dashboard/index', $data);
	}
}