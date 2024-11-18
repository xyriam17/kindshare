<!-- Edit Permission Modal -->
<div class="modal fade" id="changePassword" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-simple">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-6">
          <h4 class="mb-2">Change Password</h4>
        </div>
        <form id="editPermissionForm" class="row pt-2 update-password" onsubmit="return false">
          @csrf
          <input type="hidden" name="user_id" id="user_id">
          <div class="col-sm-12 mb-20">
            <label class="form-label" for="editPermissionName">New Password</label>
            <input type="password" id="password" name="password" class="form-control mb-6" placeholder="Password" tabindex="-1" />
          </div>
          <div class="col-sm-12">
            <label class="form-label" for="editPermissionName">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control mb-6" placeholder="Password Confirmation" tabindex="-1" />
          </div>

          <div class="col-md-12 text-center mt-20">
            <button type="button" class="btn btn-primary me-3" id="updatePassword"> <i class="ti ti-device-floppy"></i>Save</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--/ Edit Permission Modal -->

</style>
