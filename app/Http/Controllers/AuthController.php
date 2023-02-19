<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;

use DB;
use Illuminate\Http\Request;

class AuthController extends Controller
{   
	function __construct()
	{
		$this->middleware('auth_guard', ['except' => ['logout']]);
	}

	public function login()
	{
		// ** Defined Variable
		$data = array();
		$data['title'] = 'Login';
		$data['meta_description'] = 'Login Page';
		$data['meta_keywords'] = 'Login Page';
		$data['meta_images'] = asset('/images/logos/logo-company.png');
		
		// ** Return
		return view('auth/login', $data);
	}


	public function login_post(Request $request)
	{
		// ** Validation
		$validator = $request->validate([
			'nama' => 'required',
			'password' => 'required|min:6'
		], [
			'nama.required' => 'Nama harus diisi.',
			'password.required' => 'Kata sandi harus diisi.',
			'password.min' => 'Kata sandi minimal :min karakter.'
		]);

		$nama = $request->input('nama');
		$password = md5($request->input('password'));

		$siswa_data = DB::table('siswa')
			->join('kelas', 'kelas.id', '=', 'siswa.kelas_id')
			->join('guru', 'guru.id', '=', 'kelas.wali')
			->join('tahun_ajaran', 'tahun_ajaran.id', '=', 'siswa.tahun_ajaran_id')
			->join('semester', 'semester.id', '=', 'siswa.semester_id')
			->where('siswa.nama', '=', $nama)
			->where('siswa.password', '=', $password)
			->select(
				'siswa.id as id',
				'siswa.nama as nama',
				'siswa.status as status',
				'siswa.tahun_masuk as tahun_masuk',
				'siswa.tahun_lulus as tahun_lulus',
				'kelas.id as kelas_id',
				'kelas.kelas as kelas',
				'kelas.grup as kelas_grup',
				'tahun_ajaran.id as tahun_ajaran_id',
				'tahun_ajaran.mulai as tahun_ajaran_mulai',
				'tahun_ajaran.selesai as tahun_ajaran_selesai',
				'semester.id as semester_id',
				'semester.semester as semester',
				'guru.id as wali_id',
				'guru.nama as wali_nama'
			)
			->first();

		if (empty($siswa_data)) {
			return redirect()->back()->withErrors(['Akun tidak ditemukan !']);
		}
		else {
			$request->session()->put('siswa', $siswa_data);

			return redirect('/dashboard');
		}
    }

	public function logout(Request $request)
	{
		$request->session()->flush();
		
		return redirect('/login');
	}
}