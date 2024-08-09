@extends('layouts.main')

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="row g-5 g-xl-8">
                    <div class="col-xl-3">
                        <a href="#" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                            <div class="card-body">
                                <i class="ki-outline ki-geolocation text-primary fs-2x ms-n1"></i>
                                <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">{{ $siteCount }}</div>
                                <div class="fw-semibold text-gray-400">Site / Project</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3">
                        <a href="#" class="card bg-dark hoverable card-xl-stretch mb-xl-8">
                            <div class="card-body">
                                <i class="ki-outline ki-people text-gray-100 fs-2x ms-n1"></i>
                                <div class="text-gray-100 fw-bold fs-2 mb-2 mt-5">{{ $userCount }}</div>
                                <div class="fw-semibold text-gray-100">Pegawai</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3">
                        <a href="#" class="card bg-warning hoverable card-xl-stretch mb-xl-8">
                            <div class="card-body">
                                <i class="ki-outline ki-briefcase text-white fs-2x ms-n1"></i>
                                <div class="text-white fw-bold fs-2 mb-2 mt-5">{{ $careerCount }}</div>
                                <div class="fw-semibold text-white">Lowongan Pekerjaan</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3">
                        <!--begin::Statistics Widget 5-->
                        <a href="#" class="card bg-info hoverable card-xl-stretch mb-5 mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body">
                                <i class="ki-outline ki-user-square text-white fs-2x ms-n1"></i>
                                <div class="text-white fw-bold fs-2 mb-2 mt-5">{{ $applicantCount }}</div>
                                <div class="fw-semibold text-white">Pelamar</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Statistics Widget 5-->
                    </div>
                </div>
                <div class="row g-5 g-xl-10 g-xl-10">
                    <!--begin::Col-->
                    <div class="col-xl-4 mb-xl-10">
                        <!--begin::Engage widget 1-->
                        <div class="card h-md-100" dir="ltr">
                            <!--begin::Body-->
                            <div class="card-body d-flex flex-column flex-center">
                                <!--begin::Heading-->
                                <div class="mb-2">
                                    <!--begin::Title-->
                                    <h1 class="fw-semibold text-gray-800 text-center lh-lg">Have you tried 
                                    <br />new 
                                    <span class="fw-bolder">Invoice Manager ?</span></h1>
                                    <!--end::Title-->
                                    <!--begin::Illustration-->
                                    <div class="py-10 text-center">
                                        <img src="/assets/media/svg/illustrations/easy/2.svg" class="theme-light-show w-200px" alt="" />
                                        <img src="/assets/media/svg/illustrations/easy/2-dark.svg" class="theme-dark-show w-200px" alt="" />
                                    </div>
                                    <!--end::Illustration-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Links-->
                                <div class="text-center mb-1">
                                    <!--begin::Link-->
                                    <a class="btn btn-sm btn-primary me-2" href="apps/ecommerce/customers/listing.html">Try now</a>
                                    <!--end::Link-->
                                    <!--begin::Link-->
                                    <a class="btn btn-sm btn-light" href="apps/invoices/view/invoice-1.html">Learn more</a>
                                    <!--end::Link-->
                                </div>
                                <!--end::Links-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Engage widget 1-->
                    </div>
                    <!--end::Col-->
                    <div class="col-xl-8 mb-xl-10">
                        <div class="card card-flush h-md-100">
                            <div class="card-body pt-5 ps-6">
                                <div id="kt_docs_google_chart_column"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', { packages: ['corechart', 'line'] });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Day');
            data.addColumn('number', 'Atendances');
            data.addColumn('number', 'Overtimes');
            data.addColumn('number', 'Berita Acara');

            data.addRows([
                [1, 37.8, 80.8, 41.8],
                [2, 30.9, 69.5, 32.4],
                [3, 25.4, 57, 25.7],
                [4, 11.7, 18.8, 10.5],
                [5, 11.9, 17.6, 10.4],
                [6, 8.8, 13.6, 7.7],
                [7, 7.6, 12.3, 9.6],
                [8, 12.3, 29.2, 10.6],
                [9, 16.9, 42.9, 14.8],
                [10, 12.8, 30.9, 11.6],
                [11, 5.3, 7.9, 4.7],
                [12, 6.6, 8.4, 5.2],
                [13, 4.8, 6.3, 3.6],
                [14, 4.2, 6.2, 3.4]
            ]);

            var options = {
                chart: {
                    title: 'Box Office Earnings in First Two Weeks of Opening',
                    subtitle: 'in millions of dollars (USD)'
                },
                colors: ['#6e4ff5', '#f6aa33', '#fe3995']
            };

            var chart = new google.charts.Line(document.getElementById('kt_docs_google_chart_column'));
            chart.draw(data, options);
        }
    </script>
@endpush
