<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
<title>Treework HR & Productivity</title>
<link rel="stylesheet" type="text/css" href="/assets/mobiles/styles/bootstrap.css">
<link rel="stylesheet" type="text/css" href="/assets/mobiles/styles/style.css">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/assets/mobiles/fonts/css/fontawesome-all.min.css">    
<link rel="manifest" href="/_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js">
<link rel="apple-touch-icon" sizes="180x180" href="/assets/mobiles/app/icons/icon-192x192.png">
</head>
    
<body class="theme-light">
    
<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>
    
<div id="page">
    
    <div class="page-content pb-0">
        
        
        <div class="splide single-slider slider-no-arrows slider-no-dots" id="single-slider-1">
            <div class="splide__track">
                <div class="splide__list">
                    <div class="splide__slide">

                        <div class="card bg-9" data-card-height="cover">
                            <div class="card-center text-center">
                                <img src="{{ $general->logo_url ?? '/assets/media/logos/logo-dark.png' }}" width="200px">
                                <h4 class="font-300 color-highlight mt-2">Optimal HR & Productivity</h4>
                                <p class="boxed-text-xl pt-4 font-14">
                                    Selamat datang di Treework! Aplikasi manajemen HR dan produktivitas yang dirancang untuk memaksimalkan efisiensi kerja dan meningkatkan kinerja tim Anda.
                                </p>
                            </div>
                            <div class="card-bottom mb-5 pb-4">
                                <a href="#" class="slider-next btn btn-center-m btn-m bg-highlight rounded-sm font-900 text-uppercase scale-box">Mulai Sekarang</a>
                            </div>
                            <div class="card-overlay bg-theme opacity-95"></div>
                        </div>

                    </div>
                    <div class="splide__slide">


                        <div class="card bg-9" data-card-height="cover">
                            <div class="card-center text-center">
                                <h1 class="font-34 color-theme font-800">Fitur Lengkap</h1>
                                <p class="font-14 mt-n1 color-highlight">Kembangkan Manajemen Karyawan dengan Mudah!</p>
                                <p class="boxed-text-xl font-14">
                                    Manajemen karyawan, pelacakan kehadiran, evaluasi kinerja, serta fitur-fitur untuk meningkatkan produktivitas tim Anda!
                                </p>
                            </div>
                            <div class="card-bottom ms-4 me-4 mb-5">
                                <a href="#" class="slider-next btn-full btn btn-m bg-highlight color-white rounded-sm font-900 text-uppercase scale-box">Slide Berikutnya</a>
                            </div>
                            <div class="card-overlay bg-theme opacity-95"></div>
                        </div>

                    </div>
                    <div class="splide__slide">

                        <div class="card bg-9" data-card-height="cover">
                            <div class="card-center text-center">
                                <h1 class="font-36 color-theme font-800">Dan Banyak Lagi</h1>
                                <p class="font-18 font-300 mt-n1 color-highlight">Jelajahi Treework! Sangat Powerful!</p>
                                <p class="boxed-text-xl font-14">
                                    Terdapat banyak fitur menarik yang tidak bisa kami sebutkan semua! Mulailah menjelajah dan dapatkan Treework hari ini!
                                </p>
                            </div>
                            <div class="card-bottom ms-4 me-4 mb-5 pb-4">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="#" class="btn-full btn btn-m btn-border border-green-dark color-green-dark rounded-sm font-900 text-uppercase btn-install"><i class="fab fa-android">&nbsp;</i> Install</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('login') }}" class="slider-next btn-full btn btn-m bg-highlight color-white rounded-sm font-900 text-uppercase scale-box">Masuk</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-overlay bg-theme opacity-95"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>            
    </div>       
</div>    

<script type="text/javascript" src="/assets/mobiles/scripts/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/mobiles/scripts/custom.js"></script>
<script>
    let deferredPrompt;

        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault(); // Prevent the mini-infobar from appearing on mobile
            deferredPrompt = e; // Stash the event so it can be triggered later.
            
            // Optionally, show the install button here
            document.querySelector('.btn-install').style.display = 'block';
        });

        document.querySelector('.btn-install').addEventListener('click', () => {
            if (deferredPrompt) {
                deferredPrompt.prompt(); // Show the install prompt
                deferredPrompt.userChoice.then((choiceResult) => {
                    if (choiceResult.outcome === 'accepted') {
                        console.log('User accepted the A2HS prompt');
                    } else {
                        console.log('User dismissed the A2HS prompt');
                    }
                    deferredPrompt = null;
                });
            }
        });
</script>
</body>
