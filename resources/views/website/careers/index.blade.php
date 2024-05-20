@extends('website.layouts.app')

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <br>
        <br>
        <br>
        <br>
        <br>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="position-relative mb-17">
                    <div class="overlay overlay-show">
                        <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-250px" style="background-image:url('/assets/media/stock/1600x800/img-1.jpg')"></div>
                        <div class="overlay-layer rounded bg-black" style="opacity: 0.4"></div>
                    </div>
                    <div class="position-absolute text-white mb-8 ms-10 bottom-0">
                        <h3 class="text-white fs-2qx fw-bold mb-3 m">Careers at KeenThemes</h3>
                        <div class="fs-5 fw-semibold">You sit down. You stare at your screen. The cursor blinks.</div>
                    </div>
                </div>
                @livewire('careerWebsite')
                <div class="mb-19">
                    <div class="text-center mb-12">
                        <h3 class="fs-2hx text-gray-900 mb-5">Publications</h3>
                        <div class="fs-5 text-muted fw-semibold">Our goal is to provide a complete and robust theme solution 
                        <br />to boost all of our customer’s project deployments</div>
                    </div>
                    <div class="row g-10">
                        <div class="col-md-4">
                            <div class="card-xl-stretch me-md-6">
                                <a class="d-block overlay mb-4" data-fslightbox="lightbox-hot-sales" href="/assets/media/stock/600x400/img-73.jpg">
                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('/assets/media/stock/600x400/img-73.jpg')"></div>
                                    <div class="overlay-layer bg-dark card-rounded bg-opacity-25">
                                        <i class="ki-outline ki-eye fs-2x text-white"></i>
                                    </div>
                                </a>
                                <div class="m-0">
                                    <a href="pages/user-profile/overview.html" class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">Admin Panel - How To Started the Dashboard Tutorial</a>
                                    <div class="fw-semibold fs-5 text-gray-600 text-gray-900 mt-3 mb-5">We’ve been focused on making a the from also not been afraid to and step away been focused create eye</div>
                                    <div class="fs-6 fw-bold">
                                        <a href="apps/projects/users.html" class="text-gray-700 text-hover-primary">Jane Miller</a>
                                        <span class="text-muted">on Mar 21 2021</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-xl-stretch mx-md-3">
                                <a class="d-block overlay mb-4" data-fslightbox="lightbox-hot-sales" href="/assets/media/stock/600x400/img-74.jpg">
                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('/assets/media/stock/600x400/img-74.jpg')"></div>
                                    <div class="overlay-layer bg-dark card-rounded bg-opacity-25">
                                        <i class="ki-outline ki-eye fs-2x text-white"></i>
                                    </div>
                                </a>
                                <div class="m-0">
                                    <a href="pages/user-profile/overview.html" class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">Admin Panel - How To Started the Dashboard Tutorial</a>
                                    <div class="fw-semibold fs-5 text-gray-600 text-gray-900 mt-3 mb-5">We’ve been focused on making the from v4 to v5 but we have also not been afraid to step away been focused</div>
                                    <div class="fs-6 fw-bold">
                                        <a href="apps/projects/users.html" class="text-gray-700 text-hover-primary">Cris Morgan</a>
                                        <span class="text-muted">on Apr 14 2021</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-xl-stretch ms-md-6">
                                <a class="d-block overlay mb-4" data-fslightbox="lightbox-hot-sales" href="/assets/media/stock/600x400/img-47.jpg">
                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('/assets/media/stock/600x400/img-47.jpg')"></div>
                                    <div class="overlay-layer bg-dark card-rounded bg-opacity-25">
                                        <i class="ki-outline ki-eye fs-2x text-white"></i>
                                    </div>
                                </a>
                                <div class="m-0">
                                    <a href="pages/user-profile/overview.html" class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">Admin Panel - How To Started the Dashboard Tutorial</a>
                                    <div class="fw-semibold fs-5 text-gray-600 text-gray-900 mt-3 mb-5">We’ve been focused on making the from v4 to v5 but we’ve also not been afraid to step away been focused</div>
                                    <div class="fs-6 fw-bold">
                                        <a href="apps/projects/users.html" class="text-gray-700 text-hover-primary">Carles Nilson</a>
                                        <span class="text-muted">on May 14 2021</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 bg-light text-center">
                    <div class="card-body py-12">
                        <a href="#" class="mx-4">
                            <img src="/assets/media/svg/brand-logos/facebook-4.svg" class="h-30px my-2" alt="" />
                        </a>
                        <a href="#" class="mx-4">
                            <img src="/assets/media/svg/brand-logos/instagram-2-1.svg" class="h-30px my-2" alt="" />
                        </a>
                        <a href="#" class="mx-4">
                            <img src="/assets/media/svg/brand-logos/github.svg" class="h-30px my-2" alt="" />
                        </a>
                        <a href="#" class="mx-4">
                            <img src="/assets/media/svg/brand-logos/behance.svg" class="h-30px my-2" alt="" />
                        </a>
                        <a href="#" class="mx-4">
                            <img src="/assets/media/svg/brand-logos/pinterest-p.svg" class="h-30px my-2" alt="" />
                        </a>
                        <a href="#" class="mx-4">
                            <img src="/assets/media/svg/brand-logos/twitter.svg" class="h-30px my-2" alt="" />
                        </a>
                        <a href="#" class="mx-4">
                            <img src="/assets/media/svg/brand-logos/dribbble-icon-1.svg" class="h-30px my-2" alt="" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="kt_app_footer" class="app-footer">
        <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
            <div class="text-gray-900 order-2 order-md-1">
                <span class="text-muted fw-semibold me-1">2024&copy;</span>
                <a href="#" target="_blank" class="text-gray-800 text-hover-primary">Treework</a>
            </div>
            <!--end::Copyright-->
            <!--begin::Menu-->
            <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                <li class="menu-item">
                    <a href="#" target="_blank" class="menu-link px-2">About</a>
                </li>
                <li class="menu-item">
                    <a href="#" target="_blank" class="menu-link px-2">Support</a>
                </li>
                <li class="menu-item">
                    <a href="#" target="_blank" class="menu-link px-2">Purchase</a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection