<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Register | Treework</title>
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
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="auth-bg bgi-size-cover bgi-attachment-fixed bgi-position-center">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<div class="d-flex flex-column flex-root">
			<style>body { background-image: url('/assets/media/auth/bg10.jpeg'); } [data-bs-theme="dark"] body { background-image: url('/assets/media/auth/bg10-dark.jpeg'); }</style>
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<div class="d-flex flex-lg-row-fluid">
					<div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
						<img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="/assets/media/auth/agency.png" alt="" />
						<img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="/assets/media/auth/agency-dark.png" alt="" />
						<h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">Fast, Efficient and Productive</h1>
						<div class="text-gray-600 fs-base text-center fw-semibold">In this kind of post, 
						<a href="#" class="opacity-75-hover text-primary me-1">the blogger</a>introduces a person they’ve interviewed 
						<br />and provides some background information about 
						<a href="#" class="opacity-75-hover text-primary me-1">the interviewee</a>and their 
						<br />work following this is a transcript of the interview.</div>
					</div>
				</div>
				<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
					<div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
						<div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
							<div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
								<form class="form w-100" novalidate="novalidate" method="POST" action="{{ route('register') }}">
									@csrf
									<div class="text-center mb-11">
										<!--begin::Title-->
										<h1 class="text-gray-900 fw-bolder mb-3">Sign Up</h1>
										<!--end::Title-->
										<!--begin::Subtitle-->
										<div class="text-gray-500 fw-semibold fs-6">Your Social Campaigns</div>
										<!--end::Subtitle=-->
									</div>
									<div class="row g-3 mb-9">
										<!--begin::Col-->
										<div class="col-md-6">
											<!--begin::Google link=-->
											<a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
											<img alt="Logo" src="/assets/media/svg/brand-logos/google-icon.svg" class="h-15px me-3" />Sign in with Google</a>
											<!--end::Google link=-->
										</div>
										<!--end::Col-->
										<!--begin::Col-->
										<div class="col-md-6">
											<!--begin::Google link=-->
											<a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
											<img alt="Logo" src="/assets/media/svg/brand-logos/apple-black.svg" class="theme-light-show h-15px me-3" />
											<img alt="Logo" src="/assets/media/svg/brand-logos/apple-black-dark.svg" class="theme-dark-show h-15px me-3" />Sign in with Apple</a>
											<!--end::Google link=-->
										</div>
										<!--end::Col-->
									</div>
									<div class="separator separator-content my-14">
										<span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span>
									</div>
									<div class="fv-row mb-8">
										<input type="text" placeholder="Nama" name="name" autocomplete="off" class="form-control bg-transparent" />
									</div>
									<div class="fv-row mb-8">
										<input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" />
									</div>
									<div class="fv-row mb-8" data-kt-password-meter="true">
										<div class="mb-1">
											<div class="position-relative mb-3">
												<input class="form-control bg-transparent" type="password" placeholder="Password" name="password" autocomplete="off" />
												<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
													<i class="ki-duotone ki-eye-slash fs-2"></i>
													<i class="ki-duotone ki-eye fs-2 d-none"></i>
												</span>
											</div>
											<div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
												<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
												<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
												<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
												<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
											</div>
											<!--end::Meter-->
										</div>
										<div class="text-muted">Use 8 or more characters with a mix of letters, numbers & symbols.</div>										<!--end::Hint-->
									</div>
									<div class="fv-row mb-8">
										<input placeholder="Ulangi Password" name="password_confirmation" type="password" autocomplete="off" class="form-control bg-transparent" />
									</div>
									<div class="fv-row mb-8">
										<label class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" value="1" />
											<span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">I Accept the 
											<a href="#" class="ms-1 link-primary">Terms</a></span>
										</label>
									</div>
									<div class="d-grid mb-10">
										<button type="submit" class="btn btn-primary">
											<span class="indicator-label">Sign up</span>
											<span class="indicator-progress">Please wait... 
											<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
										</button>
									</div>
									<div class="text-gray-500 text-center fw-semibold fs-6">Already have an Account? 
									<a href="{{ route('login') }}" class="link-primary fw-semibold">Sign in</a></div>
								</form>
							</div>
							<div class="w-lg-500px d-flex flex-stack">
								<div class="me-10">
									<button class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, 0px">
										<img data-kt-element="current-lang-flag" class="w-20px h-20px rounded me-3" src="/assets/media/flags/united-states.svg" alt="" />
										<span data-kt-element="current-lang-name" class="me-1">English</span>
										<i class="ki-duotone ki-down fs-5 text-muted rotate-180 m-0"></i>
									</button>
									<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4 fs-7" data-kt-menu="true" id="kt_auth_lang_menu">
										<!--begin::Menu item-->
										<div class="menu-item px-3">
											<a href="#" class="menu-link d-flex px-5" data-kt-lang="English">
												<span class="symbol symbol-20px me-4">
													<img data-kt-element="lang-flag" class="rounded-1" src="/assets/media/flags/united-states.svg" alt="" />
												</span>
												<span data-kt-element="lang-name">English</span>
											</a>
										</div>
										<div class="menu-item px-3">
											<a href="#" class="menu-link d-flex px-5" data-kt-lang="Spanish">
												<span class="symbol symbol-20px me-4">
													<img data-kt-element="lang-flag" class="rounded-1" src="/assets/media/flags/spain.svg" alt="" />
												</span>
												<span data-kt-element="lang-name">Spanish</span>
											</a>
										</div>
										<div class="menu-item px-3">
											<a href="#" class="menu-link d-flex px-5" data-kt-lang="German">
												<span class="symbol symbol-20px me-4">
													<img data-kt-element="lang-flag" class="rounded-1" src="/assets/media/flags/germany.svg" alt="" />
												</span>
												<span data-kt-element="lang-name">German</span>
											</a>
										</div>
										<div class="menu-item px-3">
											<a href="#" class="menu-link d-flex px-5" data-kt-lang="Japanese">
												<span class="symbol symbol-20px me-4">
													<img data-kt-element="lang-flag" class="rounded-1" src="/assets/media/flags/japan.svg" alt="" />
												</span>
												<span data-kt-element="lang-name">Japanese</span>
											</a>
										</div>
										<div class="menu-item px-3">
											<a href="#" class="menu-link d-flex px-5" data-kt-lang="French">
												<span class="symbol symbol-20px me-4">
													<img data-kt-element="lang-flag" class="rounded-1" src="/assets/media/flags/france.svg" alt="" />
												</span>
												<span data-kt-element="lang-name">French</span>
											</a>
										</div>
									</div>
								</div>
								<div class="d-flex fw-semibold text-primary fs-base gap-5">
									<a href="pages/team.html" target="_blank">Terms</a>
									<a href="pages/pricing/column.html" target="_blank">Plans</a>
									<a href="pages/contact.html" target="_blank">Contact Us</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="/assets/plugins/global/plugins.bundle.js"></script>
		<script src="/assets/js/scripts.bundle.js"></script>
		<script src="/assets/js/custom/authentication/sign-up/general.js"></script>
	</body>
</html>