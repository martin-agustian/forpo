<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>{{ $title }}</title>
		<!-- Base Url -->
		<base href="{{ url('/') }}" target="_self">
		<!-- Viewport -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Csrf Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Favicon -->
		<link href="{{ asset('images/logos/favicon.png') }}" rel="shortcut icon" type="image/png">
		<!-- Style (CSS) -->
		@include('layouts.include.style')
	</head>
	<body>
		<div id="app">
			<input id="segment1" type="hidden" value="{{ request()->segment(1) }}">
			<main class="main">
				<div class="container-fluid">
					<div class="row min-vh-100">
						<div class="col-3 border-right">
							<nav class="nav nav-forpo flex-column">
								<a class="nav-brand" href="{{ url('/dashboard') }}">
									FORPO
								</a>
								<hr class="divider">
								<ul class="list-unstyled">
									<li>
										<a 
											class="nav-link {{ request()->segment(1) == 'dashboard' ? 'active': '' }}" 
											href="{{ url('/dashboard') }}"
										>
											Dashboard
										</a>
									</li>
									<li>
										<a 
											class="nav-link {{ request()->segment(1) == 'mapel' ? 'active': '' }}" 
											href="{{ url('/mapel') }}"
										>
											Mapel
										</a>
									</li>
									<li>
										<a 
											class="nav-link {{ request()->segment(1) == 'nilai' ? 'active': '' }}" 
											href="{{ url('/nilai') }}"
										>
											Nilai
										</a>
									</li>
									<li>
										<a 
											class="nav-link {{ request()->segment(1) == 'jadwal' ? 'active': '' }}" 
											href="{{ url('/jadwal') }}"
										>
											Jadwal
										</a>
									</li>
								</ul>
							</nav>
						</div>
						<div class="col">
							<div class="row gutters-10px header-forpo">
								<div class="col header-title">
									Forum Pembelajaran Online
								</div>
								<div class="col-auto header-account">
									<div class="text-semi-bold">
										{{ ucfirst(request()->session()->get('siswa')->nama) }}
									</div>
									
									<a href="{{ url('/logout') }}" class="text-white">
										Logout
									</a>
								</div>
								<div class="col-auto header-account-img">
									<em class="fas fa-circle"></em>
								</div>
							</div>

							@yield('content')
						</div>
					</div>
				</div>
			</main>
		</div>

		<!-- Script (JS) -->
		@include('layouts.include.script')
	</body>
</html>