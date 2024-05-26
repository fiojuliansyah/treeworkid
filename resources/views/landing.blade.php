<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Career | Treework</title>
		<meta charset="utf-8" />
		<meta name="description" content="#" />
		<meta name="keywords" content="#" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="#" />
		<meta property="og:url" content="#" />
		<meta property="og:site_name" content="#" />
		<link rel="canonical" href="#" />
		<link rel="shortcut icon" href="/assets/media/logos/icon.png" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<link href="/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
		<link href="/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		<link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	</head>
	<body id="kt_body" data-bs-spy="scroll" data-bs-target="#kt_landing_menu" class="bg-body position-relative app-blank">
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<div class="mb-0" id="home">
				<div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom landing-dark-bg" style="background-image: url(/assets/media/svg/illustrations/landing.svg)">
					<div class="landing-header" data-kt-sticky="true" data-kt-sticky-name="landing-header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
						<div class="container">
							<div class="d-flex align-items-center justify-content-between">
								<div class="d-flex align-items-center flex-equal">
									<button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none" id="kt_landing_menu_toggle">
										<i class="ki-outline ki-abstract-14 fs-2hx"></i>
									</button>
									<a href="landing.html">
										<img alt="Logo" src="/assets/media/logos/logo.png" class="logo-default h-25px h-lg-30px" />
										<img alt="Logo" src="/assets/media/logos/logo-dark.png" class="logo-sticky h-20px h-lg-25px" />
									</a>
								</div>
								<div class="d-lg-block" id="kt_header_nav_wrapper">
									<div class="d-lg-block p-5 p-lg-0" data-kt-drawer="true" data-kt-drawer-name="landing-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="200px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_landing_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav_wrapper'}">
										<div class="menu menu-column flex-nowrap menu-rounded menu-lg-row menu-title-gray-600 menu-state-title-primary nav nav-flush fs-5 fw-semibold" id="kt_landing_menu">
											<div class="menu-item">
												<a class="menu-link nav-link active py-3 px-4 px-xxl-6" href="#kt_body" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Home</a>
											</div>
											<div class="menu-item">
												<a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#how-it-works" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">How it Works</a>
											</div>
											<div class="menu-item">
												<a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#achievements" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Achievements</a>
											</div>
											<div class="menu-item">
												<a class="menu-link nav-link py-3 px-4 px-xxl-6" href="{{ route('web-career') }}">Career</a>
											</div>
											<div class="menu-item">
												<a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#pricing" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Pricing</a>
											</div>
										</div>
									</div>
								</div>
								<div class="flex-equal text-end ms-1">
									@auth
									<a href="{{ route('dashboard') }}" class="btn btn-success">Dashboard</a>
									@else
									<a href="{{ route('login') }}" class="btn btn-success">Sign In</a>
									<a href="{{ route('register') }}" class="btn btn-info">Register</a>
									@endauth
								</div>
							</div>
						</div>
					</div>
					<div class="d-flex flex-column flex-center w-100 min-h-350px min-h-lg-500px px-9">
						<div class="text-center mb-5 mb-lg-10 py-10 py-lg-20">
							<h1 class="text-white lh-base fw-bold fs-2x fs-lg-3x mb-15">Build An Outstanding Solutions 
							<br />with 
							<span style="background: linear-gradient(to right, #12CE5D 0%, #FFD80C 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">
								<span id="kt_landing_hero_text">The Best Work Platform</span>
							</span></h1>
							<a href="index.html" class="btn btn-primary">Try Treework</a>
							<!--end::Action-->
						</div>
						<!--end::Heading-->
						<!--begin::Clients-->
						<div class="d-flex flex-center flex-wrap position-relative px-5">
							<!--begin::Client-->
							<div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Fujifilm">
								<img src="/assets/media/svg/brand-logos/fujifilm.svg" class="mh-30px mh-lg-40px" alt="" />
							</div>
							<!--end::Client-->
							<!--begin::Client-->
							<div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Vodafone">
								<img src="/assets/media/svg/brand-logos/vodafone.svg" class="mh-30px mh-lg-40px" alt="" />
							</div>
							<!--end::Client-->
							<!--begin::Client-->
							<div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="KPMG International">
								<img src="/assets/media/svg/brand-logos/kpmg.svg" class="mh-30px mh-lg-40px" alt="" />
							</div>
							<!--end::Client-->
							<!--begin::Client-->
							<div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Nasa">
								<img src="/assets/media/svg/brand-logos/nasa.svg" class="mh-30px mh-lg-40px" alt="" />
							</div>
							<!--end::Client-->
							<!--begin::Client-->
							<div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Aspnetzero">
								<img src="/assets/media/svg/brand-logos/aspnetzero.svg" class="mh-30px mh-lg-40px" alt="" />
							</div>
							<!--end::Client-->
							<!--begin::Client-->
							<div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="AON - Empower Results">
								<img src="/assets/media/svg/brand-logos/aon.svg" class="mh-30px mh-lg-40px" alt="" />
							</div>
							<!--end::Client-->
							<!--begin::Client-->
							<div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Hewlett-Packard">
								<img src="/assets/media/svg/brand-logos/hp-3.svg" class="mh-30px mh-lg-40px" alt="" />
							</div>
							<!--end::Client-->
							<!--begin::Client-->
							<div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Truman">
								<img src="/assets/media/svg/brand-logos/truman.svg" class="mh-30px mh-lg-40px" alt="" />
							</div>
							<!--end::Client-->
						</div>
						<!--end::Clients-->
					</div>
				</div>
				<div class="landing-curve landing-dark-color mb-10 mb-lg-20">
					<svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z" fill="currentColor"></path>
					</svg>
				</div>
			</div>
			<div class="mb-n10 mb-lg-n20 z-index-2">
				<!--begin::Container-->
				<div class="container">
					<!--begin::Heading-->
					<div class="text-center mb-17">
						<!--begin::Title-->
						<h3 class="fs-2hx text-gray-900 mb-5" id="how-it-works" data-kt-scroll-offset="{default: 100, lg: 150}">How it Works</h3>
						<!--end::Title-->
						<!--begin::Text-->
						<div class="fs-5 text-muted fw-bold">Save thousands to millions of bucks by using single tool 
						<br />for different amazing and great useful admin</div>
						<!--end::Text-->
					</div>
					<!--end::Heading-->
					<!--begin::Row-->
					<div class="row w-100 gy-10 mb-md-20">
						<!--begin::Col-->
						<div class="col-md-4 px-5">
							<!--begin::Story-->
							<div class="text-center mb-10 mb-md-0">
								<!--begin::Illustration-->
								<img src="/assets/media/illustrations/sketchy-1/2.png" class="mh-125px mb-9" alt="" />
								<!--end::Illustration-->
								<!--begin::Heading-->
								<div class="d-flex flex-center mb-5">
									<!--begin::Badge-->
									<span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">1</span>
									<!--end::Badge-->
									<!--begin::Title-->
									<div class="fs-5 fs-lg-3 fw-bold text-gray-900">Jane Miller</div>
									<!--end::Title-->
								</div>
								<!--end::Heading-->
								<!--begin::Description-->
								<div class="fw-semibold fs-6 fs-lg-4 text-muted">Save thousands to millions of bucks 
								<br />by using single tool for different 
								<br />amazing and great</div>
								<!--end::Description-->
							</div>
							<!--end::Story-->
						</div>
						<!--end::Col-->
						<!--begin::Col-->
						<div class="col-md-4 px-5">
							<!--begin::Story-->
							<div class="text-center mb-10 mb-md-0">
								<!--begin::Illustration-->
								<img src="/assets/media/illustrations/sketchy-1/8.png" class="mh-125px mb-9" alt="" />
								<!--end::Illustration-->
								<!--begin::Heading-->
								<div class="d-flex flex-center mb-5">
									<!--begin::Badge-->
									<span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">2</span>
									<!--end::Badge-->
									<!--begin::Title-->
									<div class="fs-5 fs-lg-3 fw-bold text-gray-900">Setup Your App</div>
									<!--end::Title-->
								</div>
								<!--end::Heading-->
								<!--begin::Description-->
								<div class="fw-semibold fs-6 fs-lg-4 text-muted">Save thousands to millions of bucks 
								<br />by using single tool for different 
								<br />amazing and great</div>
								<!--end::Description-->
							</div>
							<!--end::Story-->
						</div>
						<!--end::Col-->
						<!--begin::Col-->
						<div class="col-md-4 px-5">
							<!--begin::Story-->
							<div class="text-center mb-10 mb-md-0">
								<!--begin::Illustration-->
								<img src="/assets/media/illustrations/sketchy-1/12.png" class="mh-125px mb-9" alt="" />
								<!--end::Illustration-->
								<!--begin::Heading-->
								<div class="d-flex flex-center mb-5">
									<!--begin::Badge-->
									<span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">3</span>
									<!--end::Badge-->
									<!--begin::Title-->
									<div class="fs-5 fs-lg-3 fw-bold text-gray-900">Enjoy Nautica App</div>
									<!--end::Title-->
								</div>
								<!--end::Heading-->
								<!--begin::Description-->
								<div class="fw-semibold fs-6 fs-lg-4 text-muted">Save thousands to millions of bucks 
								<br />by using single tool for different 
								<br />amazing and great</div>
								<!--end::Description-->
							</div>
							<!--end::Story-->
						</div>
						<!--end::Col-->
					</div>
					<!--end::Row-->
					<!--begin::Product slider-->
					<div class="tns tns-default">
						<!--begin::Slider-->
						<div data-tns="true" data-tns-loop="true" data-tns-swipe-angle="false" data-tns-speed="2000" data-tns-autoplay="true" data-tns-autoplay-timeout="18000" data-tns-controls="true" data-tns-nav="false" data-tns-items="1" data-tns-center="false" data-tns-dots="false" data-tns-prev-button="#kt_team_slider_prev1" data-tns-next-button="#kt_team_slider_next1">
							<!--begin::Item-->
							<div class="text-center px-5 pt-5 pt-lg-10 px-lg-10">
								<img src="/assets/media/preview/demos/demo1/light-ltr.png" class="card-rounded shadow mh-lg-650px mw-100" alt="" />
							</div>
							<!--end::Item-->
							<!--begin::Item-->
							<div class="text-center px-5 pt-5 pt-lg-10 px-lg-10">
								<img src="/assets/media/preview/demos/demo2/light-ltr.png" class="card-rounded shadow mh-lg-650px mw-100" alt="" />
							</div>
							<!--end::Item-->
							<!--begin::Item-->
							<div class="text-center px-5 pt-5 pt-lg-10 px-lg-10">
								<img src="/assets/media/preview/demos/demo4/light-ltr.png" class="card-rounded shadow mh-lg-650px mw-100" alt="" />
							</div>
							<!--end::Item-->
							<!--begin::Item-->
							<div class="text-center px-5 pt-5 pt-lg-10 px-lg-10">
								<img src="/assets/media/preview/demos/demo5/light-ltr.png" class="card-rounded shadow mh-lg-650px mw-100" alt="" />
							</div>
							<!--end::Item-->
						</div>
						<!--end::Slider-->
						<!--begin::Slider button-->
						<button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_prev1">
							<i class="ki-outline ki-left fs-2x"></i>
						</button>
						<!--end::Slider button-->
						<!--begin::Slider button-->
						<button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_next1">
							<i class="ki-outline ki-right fs-2x"></i>
						</button>
						<!--end::Slider button-->
					</div>
					<!--end::Product slider-->
				</div>
				<!--end::Container-->
			</div>
			<div class="mt-sm-n10">
				<!--begin::Curve top-->
				<div class="landing-curve landing-dark-color">
					<svg viewBox="15 -1 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 48C4.93573 47.6644 8.85984 47.3311 12.7725 47H1489.16C1493.1 47.3311 1497.04 47.6644 1501 48V47H1489.16C914.668 -1.34764 587.282 -1.61174 12.7725 47H1V48Z" fill="currentColor"></path>
					</svg>
				</div>
				<!--end::Curve top-->
				<!--begin::Wrapper-->
				<div class="pb-15 pt-18 landing-dark-bg">
					<!--begin::Container-->
					<div class="container">
						<!--begin::Heading-->
						<div class="text-center mt-15 mb-18" id="achievements" data-kt-scroll-offset="{default: 100, lg: 150}">
							<!--begin::Title-->
							<h3 class="fs-2hx text-white fw-bold mb-5">We Make Things Better</h3>
							<!--end::Title-->
							<!--begin::Description-->
							<div class="fs-5 text-gray-700 fw-bold">Save thousands to millions of bucks by using single tool 
							<br />for different amazing and great useful admin</div>
							<!--end::Description-->
						</div>
						<!--end::Heading-->
						<!--begin::Statistics-->
						<div class="d-flex flex-center">
							<!--begin::Items-->
							<div class="d-flex flex-wrap flex-center justify-content-lg-between mb-15 mx-auto w-xl-900px">
								<!--begin::Item-->
								<div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain" style="background-image: url('/assets/media/svg/misc/octagon.svg')">
									<!--begin::Symbol-->
									<i class="ki-outline ki-element-11 fs-2tx text-white mb-3"></i>
									<!--end::Symbol-->
									<!--begin::Info-->
									<div class="mb-0">
										<!--begin::Value-->
										<div class="fs-lg-2hx fs-2x fw-bold text-white d-flex flex-center">
											<div class="min-w-70px" data-kt-countup="true" data-kt-countup-value="700" data-kt-countup-suffix="+">0</div>
										</div>
										<!--end::Value-->
										<!--begin::Label-->
										<span class="text-gray-600 fw-semibold fs-5 lh-0">Known Companies</span>
										<!--end::Label-->
									</div>
									<!--end::Info-->
								</div>
								<!--end::Item-->
								<!--begin::Item-->
								<div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain" style="background-image: url('/assets/media/svg/misc/octagon.svg')">
									<!--begin::Symbol-->
									<i class="ki-outline ki-chart-pie-4 fs-2tx text-white mb-3"></i>
									<!--end::Symbol-->
									<!--begin::Info-->
									<div class="mb-0">
										<!--begin::Value-->
										<div class="fs-lg-2hx fs-2x fw-bold text-white d-flex flex-center">
											<div class="min-w-70px" data-kt-countup="true" data-kt-countup-value="80" data-kt-countup-suffix="K+">0</div>
										</div>
										<!--end::Value-->
										<!--begin::Label-->
										<span class="text-gray-600 fw-semibold fs-5 lh-0">Statistic Reports</span>
										<!--end::Label-->
									</div>
									<!--end::Info-->
								</div>
								<!--end::Item-->
								<!--begin::Item-->
								<div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain" style="background-image: url('/assets/media/svg/misc/octagon.svg')">
									<!--begin::Symbol-->
									<i class="ki-outline ki-basket fs-2tx text-white mb-3"></i>
									<!--end::Symbol-->
									<!--begin::Info-->
									<div class="mb-0">
										<!--begin::Value-->
										<div class="fs-lg-2hx fs-2x fw-bold text-white d-flex flex-center">
											<div class="min-w-70px" data-kt-countup="true" data-kt-countup-value="35" data-kt-countup-suffix="M+">0</div>
										</div>
										<!--end::Value-->
										<!--begin::Label-->
										<span class="text-gray-600 fw-semibold fs-5 lh-0">Secure Payments</span>
										<!--end::Label-->
									</div>
									<!--end::Info-->
								</div>
								<!--end::Item-->
							</div>
							<!--end::Items-->
						</div>
						<!--end::Statistics-->
						<!--begin::Testimonial-->
						<div class="fs-2 fw-semibold text-muted text-center mb-3">
						<span class="fs-1 lh-1 text-gray-700">“</span>When you care about your topic, you’ll write about it in a 
						<br />
						<span class="text-gray-700 me-1">more powerful</span>, emotionally expressive way 
						<span class="fs-1 lh-1 text-gray-700">“</span></div>
						<!--end::Testimonial-->
						<!--begin::Author-->
						<div class="fs-2 fw-semibold text-muted text-center">
							<a href="account/security.html" class="link-primary fs-4 fw-bold">Marcus Levy,</a>
							<span class="fs-4 fw-bold text-gray-600">Treework CEO</span>
						</div>
						<!--end::Author-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Wrapper-->
				<!--begin::Curve bottom-->
				<div class="landing-curve landing-dark-color">
					<svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z" fill="currentColor"></path>
					</svg>
				</div>
				<!--end::Curve bottom-->
			</div>
			<div class="mt-sm-n20">
				<div class="py-20 landing-dark-bg">
					<div class="container">
						<div class="d-flex flex-column container pt-lg-20">
							<div class="mb-13 text-center">
								<h1 class="fs-2hx fw-bold text-white mb-5" id="pricing" data-kt-scroll-offset="{default: 100, lg: 150}">Clear Pricing Makes it Easy</h1>
								<div class="text-gray-600 fw-semibold fs-5">Save thousands to millions of bucks by using single tool for different 
								<br />amazing and outstanding cool and great useful admin</div>
							</div>
							<div class="text-center" id="kt_pricing">
								<div class="nav-group landing-dark-bg d-inline-flex mb-15" data-kt-buttons="true" style="border: 1px dashed #2B4666;">
									<a href="#" class="btn btn-color-gray-600 btn-active btn-active-success px-6 py-3 me-2 active" data-kt-plan="month">Monthly</a>
									<a href="#" class="btn btn-color-gray-600 btn-active btn-active-success px-6 py-3" data-kt-plan="annual">Annual</a>
								</div>
								<div class="row g-10">
									<div class="col-xl-4">
										<div class="d-flex h-100 align-items-center">
											<div class="w-100 d-flex flex-column flex-center rounded-3 bg-body py-15 px-10">
												<div class="mb-7 text-center">
													<h1 class="text-gray-900 mb-5 fw-boldest">Startup</h1>
													<div class="text-gray-500 fw-semibold mb-5">Best Settings for Startups</div>
													<!--end::Description-->
													<!--begin::Price-->
													<div class="text-center">
														<span class="mb-2 text-primary">$</span>
														<span class="fs-3x fw-bold text-primary" data-kt-plan-price-month="99" data-kt-plan-price-annual="999">99</span>
														<span class="fs-7 fw-semibold opacity-50" data-kt-plan-price-month="/ Mon" data-kt-plan-price-annual="/ Ann">/ Mon</span>
													</div>
													<!--end::Price-->
												</div>
												<!--end::Heading-->
												<!--begin::Features-->
												<div class="w-100 mb-10">
													<!--begin::Item-->
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-gray-800 text-start pe-3">Up to 10 Active Users</span>
														<i class="ki-outline ki-check-circle fs-1 text-success"></i>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-gray-800 text-start pe-3">Up to 30 Project Integrations</span>
														<i class="ki-outline ki-check-circle fs-1 text-success"></i>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-gray-800">Keen Analytics Platform</span>
														<i class="ki-outline ki-cross-circle fs-1"></i>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-gray-800">Targets Timelines & Files</span>
														<i class="ki-outline ki-cross-circle fs-1"></i>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack">
														<span class="fw-semibold fs-6 text-gray-800">Unlimited Projects</span>
														<i class="ki-outline ki-cross-circle fs-1"></i>
													</div>
													<!--end::Item-->
												</div>
												<!--end::Features-->
												<!--begin::Select-->
												<a href="#" class="btn btn-primary">Select</a>
												<!--end::Select-->
											</div>
											<!--end::Option-->
										</div>
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-xl-4">
										<div class="d-flex h-100 align-items-center">
											<!--begin::Option-->
											<div class="w-100 d-flex flex-column flex-center rounded-3 bg-primary py-20 px-10">
												<!--begin::Heading-->
												<div class="mb-7 text-center">
													<!--begin::Title-->
													<h1 class="text-white mb-5 fw-boldest">Business</h1>
													<!--end::Title-->
													<!--begin::Description-->
													<div class="text-white opacity-75 fw-semibold mb-5">Best Settings for Business</div>
													<!--end::Description-->
													<!--begin::Price-->
													<div class="text-center">
														<span class="mb-2 text-white">$</span>
														<span class="fs-3x fw-bold text-white" data-kt-plan-price-month="199" data-kt-plan-price-annual="1999">199</span>
														<span class="fs-7 fw-semibold text-white opacity-75" data-kt-plan-price-month="/ Mon" data-kt-plan-price-annual="/ Ann">/ Mon</span>
													</div>
													<!--end::Price-->
												</div>
												<!--end::Heading-->
												<!--begin::Features-->
												<div class="w-100 mb-10">
													<!--begin::Item-->
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-white opacity-75 text-start pe-3">Up to 10 Active Users</span>
														<i class="ki-outline ki-check-circle fs-1 text-white"></i>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-white opacity-75 text-start pe-3">Up to 30 Project Integrations</span>
														<i class="ki-outline ki-check-circle fs-1 text-white"></i>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-white opacity-75 text-start pe-3">Keen Analytics Platform</span>
														<i class="ki-outline ki-check-circle fs-1 text-white"></i>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-white opacity-75 text-start pe-3">Targets Timelines & Files</span>
														<i class="ki-outline ki-check-circle fs-1 text-white"></i>
													</div>
													<div class="d-flex flex-stack">
														<span class="fw-semibold fs-6 text-white opacity-75">Unlimited Projects</span>
														<i class="ki-outline ki-cross-circle fs-1 text-white"></i>
													</div>
												</div>
												<a href="#" class="btn btn-color-primary btn-active-light-primary btn-light">Select</a>
											</div>
										</div>
									</div>
									<div class="col-xl-4">
										<div class="d-flex h-100 align-items-center">
											<div class="w-100 d-flex flex-column flex-center rounded-3 bg-body py-15 px-10">
												<div class="mb-7 text-center">
													<h1 class="text-gray-900 mb-5 fw-boldest">Enterprise</h1>
													<div class="text-gray-500 fw-semibold mb-5">Best Settings for Enterprise</div>
													<div class="text-center">
														<span class="mb-2 text-primary">$</span>
														<span class="fs-3x fw-bold text-primary" data-kt-plan-price-month="999" data-kt-plan-price-annual="9999">999</span>
														<span class="fs-7 fw-semibold opacity-50" data-kt-plan-price-month="/ Mon" data-kt-plan-price-annual="/ Ann">/ Mon</span>
													</div>
												</div>
												<div class="w-100 mb-10">
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-gray-800 text-start pe-3">Up to 10 Active Users</span>
														<i class="ki-outline ki-check-circle fs-1 text-success"></i>
													</div>
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-gray-800 text-start pe-3">Up to 30 Project Integrations</span>
														<i class="ki-outline ki-check-circle fs-1 text-success"></i>
													</div>
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-gray-800 text-start pe-3">Keen Analytics Platform</span>
														<i class="ki-outline ki-check-circle fs-1 text-success"></i>
													</div>
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-gray-800 text-start pe-3">Targets Timelines & Files</span>
														<i class="ki-outline ki-check-circle fs-1 text-success"></i>
													</div>
													<div class="d-flex flex-stack">
														<span class="fw-semibold fs-6 text-gray-800 text-start pe-3">Unlimited Projects</span>
														<i class="ki-outline ki-check-circle fs-1 text-success"></i>
													</div>
												</div>
												<a href="#" class="btn btn-primary">Select</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="landing-curve landing-dark-color">
					<svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z" fill="currentColor"></path>
					</svg>
				</div>
			</div>
			<div class="mt-20 mb-n20 position-relative z-index-2">
				<div class="container">
					<div class="text-center mb-17">
						<h3 class="fs-2hx text-gray-900 mb-5" id="clients" data-kt-scroll-offset="{default: 125, lg: 150}">What Our Clients Say</h3>
						<div class="fs-5 text-muted fw-bold">Save thousands to millions of bucks by using single tool 
						<br />for different amazing and great useful admin</div>
					</div>
					<div class="row g-lg-10 mb-10 mb-lg-20">
						<div class="col-lg-4">
							<!--begin::Testimonial-->
							<div class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
								<!--begin::Wrapper-->
								<div class="mb-7">
									<!--begin::Rating-->
									<div class="rating mb-6">
										<div class="rating-label me-2 checked">
											<i class="ki-outline ki-star fs-5"></i>
										</div>
										<div class="rating-label me-2 checked">
											<i class="ki-outline ki-star fs-5"></i>
										</div>
										<div class="rating-label me-2 checked">
											<i class="ki-outline ki-star fs-5"></i>
										</div>
										<div class="rating-label me-2 checked">
											<i class="ki-outline ki-star fs-5"></i>
										</div>
										<div class="rating-label me-2 checked">
											<i class="ki-outline ki-star fs-5"></i>
										</div>
									</div>
									<!--end::Rating-->
									<!--begin::Title-->
									<div class="fs-2 fw-bold text-gray-900 mb-3">This is by far the cleanest template 
									<br />and the most well structured</div>
									<!--end::Title-->
									<!--begin::Feedback-->
									<div class="text-gray-500 fw-semibold fs-4">The most well thought out design theme I have ever used. The codes are up to tandard. The css styles are very clean. In fact the cleanest and the most up to standard I have ever seen.</div>
									<!--end::Feedback-->
								</div>
								<!--end::Wrapper-->
								<!--begin::Author-->
								<div class="d-flex align-items-center">
									<!--begin::Avatar-->
									<div class="symbol symbol-circle symbol-50px me-5">
										<img src="/assets/media/avatars/blank.png" class="" alt="" />
									</div>
									<!--end::Avatar-->
									<!--begin::Name-->
									<div class="flex-grow-1">
										<a href="#" class="text-gray-900 fw-bold text-hover-primary fs-6">Paul Miles</a>
										<span class="text-muted d-block fw-bold">Development Lead</span>
									</div>
									<!--end::Name-->
								</div>
								<!--end::Author-->
							</div>
							<!--end::Testimonial-->
						</div>
					</div>
					<div class="d-flex flex-stack flex-wrap flex-md-nowrap card-rounded shadow p-8 p-lg-12 mb-n5 mb-lg-n13" style="background: linear-gradient(90deg, #20AA3E 0%, #03A588 100%);">
						<div class="my-2 me-5">
							<div class="fs-1 fs-lg-2qx fw-bold text-white mb-2">Start With Treework Today, 
							<span class="fw-normal">Speed Up Performance!</span></div>
							<div class="fs-6 fs-lg-5 text-white fw-semibold opacity-75">Join over 100,000 Professionals Community to Stay Ahead</div>
						</div>
						<a href="#" class="btn btn-lg btn-outline border-2 btn-outline-white flex-shrink-0 my-2">Purchase on Treework Sales</a>
						<!--end::Link-->
					</div>
					<!--end::Highlight-->
				</div>
				<!--end::Container-->
			</div>
			<!--end::Testimonials Section-->
			<!--begin::Footer Section-->
			<div class="mb-0">
				<!--begin::Curve top-->
				<div class="landing-curve landing-dark-color">
					<svg viewBox="15 -1 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 48C4.93573 47.6644 8.85984 47.3311 12.7725 47H1489.16C1493.1 47.3311 1497.04 47.6644 1501 48V47H1489.16C914.668 -1.34764 587.282 -1.61174 12.7725 47H1V48Z" fill="currentColor"></path>
					</svg>
				</div>
				<!--end::Curve top-->
				<!--begin::Wrapper-->
				<div class="landing-dark-bg pt-20">
					<!--begin::Container-->
					<div class="container">
						<!--begin::Row-->
						<div class="row py-10 py-lg-20">
							<!--begin::Col-->
							<div class="col-lg-6 pe-lg-16 mb-10 mb-lg-0">
								<!--begin::Block-->
								<div class="rounded landing-dark-border p-9 mb-10">
									<!--begin::Title-->
									<h2 class="text-white">Would you need a Custom License?</h2>
									<!--end::Title-->
									<!--begin::Text-->
									<span class="fw-normal fs-4 text-gray-700">Email us to 
									<a href="#/support" class="text-white opacity-50 text-hover-primary">support@Treework.com</a></span>
									<!--end::Text-->
								</div>
								<!--end::Block-->
								<!--begin::Block-->
								<div class="rounded landing-dark-border p-9">
									<!--begin::Title-->
									<h2 class="text-white">How About a Custom Project?</h2>
									<!--end::Title-->
									<!--begin::Text-->
									<span class="fw-normal fs-4 text-gray-700">Use Our Custom Development Service. 
									<a href="#" class="text-white opacity-50 text-hover-primary">Click to Get a Quote</a></span>
									<!--end::Text-->
								</div>
								<!--end::Block-->
							</div>
							<!--end::Col-->
							<!--begin::Col-->
							<div class="col-lg-6 ps-lg-16">
								<!--begin::Navs-->
								<div class="d-flex justify-content-center">
									<!--begin::Links-->
									<div class="d-flex fw-semibold flex-column me-20">
										<!--begin::Subtitle-->
										<h4 class="fw-bold text-gray-500 mb-6">More for Metronic</h4>
										<!--end::Subtitle-->
										<!--begin::Link-->
										<a href="#/faqs" class="text-white opacity-50 text-hover-primary fs-5 mb-6">FAQ</a>
										<!--end::Link-->
										<!--begin::Link-->
										<a href="#" class="text-white opacity-50 text-hover-primary fs-5 mb-6">Documentaions</a>
										<!--end::Link-->
										<!--begin::Link-->
										<a href="#" class="text-white opacity-50 text-hover-primary fs-5 mb-6">Video Tuts</a>
										<!--end::Link-->
										<!--begin::Link-->
										<a href="#" class="text-white opacity-50 text-hover-primary fs-5 mb-6">Changelog</a>
										<!--end::Link-->
										<!--begin::Link-->
										<a href="#" class="text-white opacity-50 text-hover-primary fs-5 mb-6">Support Forum</a>
										<!--end::Link-->
										<!--begin::Link-->
										<a href="#" class="text-white opacity-50 text-hover-primary fs-5">Blog</a>
										<!--end::Link-->
									</div>
									<div class="d-flex fw-semibold flex-column ms-lg-20">
										<h4 class="fw-bold text-gray-500 mb-6">Stay Connected</h4>
										<a href="#" class="mb-6">
											<img src="/assets/media/svg/brand-logos/facebook-4.svg" class="h-20px me-2" alt="" />
											<span class="text-white opacity-50 text-hover-primary fs-5 mb-6">Facebook</span>
										</a>
										<a href="#" class="mb-6">
											<img src="/assets/media/svg/brand-logos/github.svg" class="h-20px me-2" alt="" />
											<span class="text-white opacity-50 text-hover-primary fs-5 mb-6">Github</span>
										</a>
										<a href="#" class="mb-6">
											<img src="/assets/media/svg/brand-logos/twitter.svg" class="h-20px me-2" alt="" />
											<span class="text-white opacity-50 text-hover-primary fs-5 mb-6">Twitter</span>
										</a>
										<a href="#" class="mb-6">
											<img src="/assets/media/svg/brand-logos/dribbble-icon-1.svg" class="h-20px me-2" alt="" />
											<span class="text-white opacity-50 text-hover-primary fs-5 mb-6">Dribbble</span>
										</a>
										<a href="#" class="mb-6">
											<img src="/assets/media/svg/brand-logos/instagram-2-1.svg" class="h-20px me-2" alt="" />
											<span class="text-white opacity-50 text-hover-primary fs-5 mb-6">Instagram</span>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="landing-dark-separator"></div>
					<div class="container">
						<div class="d-flex flex-column flex-md-row flex-stack py-7 py-lg-10">
							<div class="d-flex align-items-center order-2 order-md-1">
								<a href="landing.html">
									<img alt="Logo" src="/assets/media/logos/logo.png" class="h-15px h-md-20px" />
								</a>
								<span class="mx-5 fs-6 fw-semibold text-gray-600 pt-1" href="#">&copy; 2024 Treework ID</span>
							</div>
							<ul class="menu menu-gray-600 menu-hover-primary fw-semibold fs-6 fs-md-5 order-1 mb-5 mb-md-0">
								<li class="menu-item">
									<a href="#" target="_blank" class="menu-link px-2">About</a>
								</li>
								<li class="menu-item mx-5">
									<a href="#" target="_blank" class="menu-link px-2">Support</a>
								</li>
								<li class="menu-item">
									<a href="" target="_blank" class="menu-link px-2">Purchase</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
				<i class="ki-outline ki-arrow-up"></i>
			</div>
		</div>
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<i class="ki-outline ki-arrow-up"></i>
		</div>
		<script src="/assets/plugins/global/plugins.bundle.js"></script>
		<script src="/assets/js/scripts.bundle.js"></script>
		<script src="/assets/plugins/custom/fslightbox/fslightbox.bundle.js"></script>
		<script src="/assets/plugins/custom/typedjs/typedjs.bundle.js"></script>
		<script src="/assets/js/custom/landing.js"></script>
		<script src="/assets/js/custom/pages/pricing/general.js"></script>
	</body>
</html>