// To clear cache on devices, always increase APP_VER number after making changes.
// The app will serve fresh content right away or after 2-3 refreshes (open / close)
var APP_NAME = 'Treework';
var APP_VER = '3.4.1L';
var CACHE_NAME = APP_NAME + '-' + APP_VER;

// Files required to make this app work offline.
// Add all files you want to view offline below.
// Leave REQUIRED_FILES = [] to disable offline.
var REQUIRED_FILES = [
	// HTML Files
	'index.html',
	// Styles
	'/assets/mobiles/styles/style.css',
	'/assets/mobiles/styles/bootstrap.css',
	// Scripts
	'/assets/mobiles/scripts/custom.js',
	'/assets/mobiles/scripts/bootstrap.min.js',
	// Plugins
	'/assets/mobiles/plugins/charts/charts.js',
	'/assets/mobiles/plugins/charts/charts-call-graphs.js',
	'/assets/mobiles/plugins/countdown/countdown.js',
	'/assets/mobiles/plugins/filterizr/filterizr.js',
	'/assets/mobiles/plugins/filterizr/filterizr.css',
	'/assets/mobiles/plugins/filterizr/filterizr-call.js',
	'/assets/mobiles/plugins/galleryViews/gallery-views.js',
	'/assets/mobiles/plugins/glightbox/glightbox.js',
	'/assets/mobiles/plugins/glightbox/glightbox.css',
	'/assets/mobiles/plugins/glightbox/glightbox-call.js',
	// Fonts
	'/assets/mobiles/fonts/css/fontawesome-all.min.css',
	'/assets/mobiles/fonts/webfonts/fa-brands-400.woff2',
	'/assets/mobiles/fonts/webfonts/fa-regular-400.woff2',
	'/assets/mobiles/fonts/webfonts/fa-solid-900.woff2',
	// Images
	'/assets/mobiles/images/empty.png',
];

// Service Worker Diagnostic. Set true to get console logs.
var APP_DIAG = false;

//Service Worker Function Below.
self.addEventListener('install', function(event) {
	event.waitUntil(
		caches.open(CACHE_NAME)
		.then(function(cache) {
			//Adding files to cache
			return cache.addAll(REQUIRED_FILES);
		}).catch(function(error) {
			//Output error if file locations are incorrect
			if(APP_DIAG){console.log('Service Worker Cache: Error Check REQUIRED_FILES array in _service-worker.js - files are missing or path to files is incorrectly written -  ' + error);}
		})
		.then(function() {
			//Install SW if everything is ok
			return self.skipWaiting();
		})
		.then(function(){
			if(APP_DIAG){console.log('Service Worker: Cache is OK');}
		})
	);
	if(APP_DIAG){console.log('Service Worker: Installed');}
});

self.addEventListener('fetch', function(event) {
    if (event.request.mode === 'navigate') {
        event.respondWith(
            fetch(event.request)
                .then(function(response) {
                    // Always return a fresh response for navigation requests
                    return response;
                })
                .catch(function() {
                    return caches.match('/offline.html'); // Menampilkan halaman offline jika gagal
                })
        );
    } else {
        event.respondWith(
            caches.match(event.request)
                .then(function(response) {
                    return response || fetch(event.request);
                })
        );
    }
});


self.addEventListener('activate', function(event) {
	event.waitUntil(self.clients.claim());
	event.waitUntil(
		//Check cache number, clear all assets and re-add if cache number changed
		caches.keys().then(cacheNames => {
			return Promise.all(
				cacheNames
					.filter(cacheName => (cacheName.startsWith(APP_NAME + "-")))
					.filter(cacheName => (cacheName !== CACHE_NAME))
					.map(cacheName => caches.delete(cacheName))
			);
		})
	);
	if(APP_DIAG){console.log('Service Worker: Activated')}
});