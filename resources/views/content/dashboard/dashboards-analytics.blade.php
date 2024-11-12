@extends('layouts/layoutMaster')

@section('title', 'Kindshare - Dashboard')

@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/apex-charts/apex-charts.scss',
  'resources/assets/vendor/libs/swiper/swiper.scss',
  'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.scss'
])
@endsection

@section('page-style')
<!-- Page -->
@vite(['resources/assets/vendor/scss/pages/cards-advance.scss'])
@endsection

@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/apex-charts/apexcharts.js',
  'resources/assets/vendor/libs/swiper/swiper.js',
  'resources/assets/vendor/libs/chartjs/chartjs.js',
  'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
  ])

@endsection

@section('page-script')
@vite([
  'resources/assets/js/dashboards-analytics.js',
  'resources/assets/js/charts-chartjs.js'
])
@endsection

@section('content')



<div class="row g-6">


  <!-- Total Money Donation  -->
  <div class="col-xxl-4 col-md-4 col-6">
    <div class="card h-100">
      <div class="card-body">
        <div class="badge p-2 bg-label-danger mb-3 rounded"><i class="ti ti-credit-card ti-28px"></i></div>
        <h5 class="card-title mb-1">Total Money Received</h5>

        <p class="text-heading mb-3 mt-1">₱1.28k</p>

      </div>
    </div>
  </div>

  <!-- Total Sales -->
  <div class="col-xxl-4 col-md-4 col-6">
    <div class="card h-100">
      <div class="card-body">
        <div class="badge p-2 bg-label-success mb-3 rounded"><i class="ti ti-credit-card ti-28px"></i></div>
        <h5 class="card-title mb-1">Total Food Donation Received</h5>
        <p class="text-heading mb-3 mt-1">₱24.67k</p>
      </div>
    </div>
  </div>

    <!-- Total Profit -->
    <div class="col-xxl-4 col-md-4 col-6">
      <div class="card h-100">
        <div class="card-body">
          <div class="badge p-2 bg-label-danger mb-3 rounded"><i class="ti ti-credit-card ti-28px"></i></div>
          <h5 class="card-title mb-1">Total Inkinds</h5>
          <p class="text-heading mb-3 mt-1">1.28k</p>

        </div>
      </div>
    </div>


</div>


<div class="row mt-10">

<div class="col-lg-4 col-12 mb-6">
    <div class="card">
      <h5 class="card-header">Monetary Donations</h5>
      <div class="card-body">
        <canvas id="monetaryChart" class="chartjs mb-6" data-height="350"></canvas>

      </div>
    </div>
  </div>
  <div class="col-lg-4 col-12 mb-6">
    <div class="card">
      <h5 class="card-header">Food Donations</h5>
      <div class="card-body">
        <canvas id="foodChart" class="chartjs mb-6" data-height="350"></canvas>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-12 mb-6">
    <div class="card">
      <h5 class="card-header">Indkind Donations</h5>
      <div class="card-body">
        <canvas id="inkindChart" class="chartjs mb-6" data-height="350"></canvas>
      </div>
    </div>
  </div>



</div>


@endsection
