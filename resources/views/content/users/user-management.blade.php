@extends('layouts/layoutMaster')

@section('title', 'KindSahre - User Management ')

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
  'resources/assets/vendor/libs/dropzone/dropzone.js'
])
@endsection






<!-- Page Scripts -->
@section('page-script')
@vite([
        'resources/js/user-management.js',
        'resources/assets/js/forms-file-upload.js'
      ])
@endsection

@section('content')

<!-- Users List Table -->
<div class="card">
  <div class="card-header border-bottom">
    <h5 class="card-title mb-0">Search Filter</h5>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables-users table">
      <thead class="border-top">
        <tr>
          <th></th>
          <th>Id</th>
          <th>User</th>
          <th>Email</th>
          <th>Address</th>
          <th>Contact Number</th>
          <th>User Role</th>
          <th>Actions</th>
        </tr>
      </thead>
    </table>
  </div>
  <!-- Offcanvas to add new user -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header border-bottom">
      <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
      <form class="add-new-user pt-0" id="addNewUserForm">
        <input type="hidden" name="id" id="user_id">
        <div class="mb-6">
          <label class="form-label" for="add-user-fullname">Firstname</label>
          <input type="text" class="form-control" id="firtsname" placeholder=" " name="firtsname" aria-label="John" />
        </div>
        <div class="mb-6">
          <label class="form-label" for="add-user-fullname">Middlename</label>
          <input type="text" class="form-control" id="middle" placeholder="" name="middlename" aria-label="Albino" />
        </div>
        <div class="mb-6">
          <label class="form-label" for="add-user-fullname">Lastname</label>
          <input type="text" class="form-control" id="lastname" placeholder=" Doe" name="lastname" aria-label="" />
        </div>
        <div class="mb-6">
          <label class="form-label" for="add-user-email">Email</label>
          <input type="email" name="email" id="add-user-email" class="form-control" placeholder="" aria-label=""  />
        </div>
        <div class="mb-6">
          <label class="form-label" for="add-user-contact">Contact</label>
          <input type="text" id="add-user-contact" class="form-control phone-mask" placeholder="+1 (609) 988-44-11" aria-label="" name="contact_number" />
        </div>
          <div class="mb-6">
          <label class="form-label" for="add-user-contact">Adrress</label>
          <textarea class="form-control" name="address" id="address"></textarea>

        </div>


        <div class="mb-6">
          <label class="form-label" for="user-role">User Role</label>
          <select id="user-role" class="form-select" name="role_id">
            <option value="1">Staff</option>
            <option value="2">Admin</option>
            <option value="3">Super Admin</option>

          </select>
        </div>

        <button type="submit" class="btn btn-primary me-3 data-submit">Submit</button>
        <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Cancel</button>
      </form>
    </div>
  </div>


</div>
@endsection
