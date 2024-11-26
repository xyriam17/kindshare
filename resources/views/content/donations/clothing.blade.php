@extends('layouts/layoutMaster')

@section('title', 'KindSahre - Money Donation ')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
'resources/assets/vendor/libs/select2/select2.scss',
'resources/assets/vendor/libs/@form-validation/form-validation.scss',
'resources/assets/vendor/libs/animate-css/animate.scss',
'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss',
'resources/assets/vendor/libs/dropzone/dropzone.scss'
])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite([
'resources/assets/vendor/libs/moment/moment.js',
'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
'resources/assets/vendor/libs/select2/select2.js',
'resources/assets/vendor/libs/@form-validation/popular.js',
'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
'resources/assets/vendor/libs/@form-validation/auto-focus.js',
'resources/assets/vendor/libs/cleavejs/cleave.js',
'resources/assets/vendor/libs/cleavejs/cleave-phone.js',
'resources/assets/vendor/libs/sweetalert2/sweetalert2.js',
'resources/assets/vendor/libs/dropzone/dropzone.js',
'resources/assets/js/modal-edit-user.js',
])
@endsection






<!-- Page Scripts -->
@section('page-script')
@vite([

'resources/js/donation.js',

])
@endsection

@section('content')
<div class="row g-6 mb-10">
  <!-- Total Money Donation  -->
  <div class="col-xxl-4 col-md-4 col-6">
    <div class="card h-100">
      <div class="card-body">
        <div class="badge p-2 bg-label-success mb-3 rounded"><i class="ti ti-credit-card ti-28px"></i></div>
        <h5 class="card-title mb-1">Total Received</h5>
        <p class="text-heading mb-3 mt-1">{{ $total_recieved }} sacks</p>

      </div>
    </div>
  </div>

  <!-- Total Sales -->
  <div class="col-xxl-4 col-md-4 col-6">
    <div class="card h-100">
      <div class="card-body">
        <div class="badge p-2 bg-label-warning mb-3 rounded"><i class="ti ti-credit-card ti-28px"></i></div>
        <h5 class="card-title mb-1">Pending Approval</h5>
        <p class="text-heading mb-3 mt-1">{{ $total_expired }} sacks</p>
      </div>
    </div>
  </div>

  <!-- Total Profit -->
  <div class="col-xxl-4 col-md-4 col-6">
    <div class="card h-100">
      <div class="card-body">
        <div class="badge p-2 bg-label-success mb-3 rounded"><i class="ti ti-credit-card ti-28px"></i></div>
        <h5 class="card-title mb-1">Donated</h5>
        <p class="text-heading mb-3 mt-1">{{ $total_recieved }} sacks</p>

      </div>
    </div>
  </div>


</div>
<!-- Users List Table -->
<div class="card">
  <div class="card-datatable table-responsive">
    <table class="datatables-clothing table" id="clothingTable">
      <thead class="border-top">
        <tr>
          <th></th>
          <th>Id</th>
          <th>Donor</th>
          <th>Item</th>
          <th>Quanity</th>
          <th>Unit</th>
          <th>Donation Date</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
    </table>
  </div>



</div>



@endsection
