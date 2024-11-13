<!-- Edit User Modal -->
<div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-edit-user">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-6">
          <h4 class="mb-2">Update Profile</h4>
        </div>
          <form action="/upload" class="dropzone needsclick mb-10 update-photo" id="dropzone-basic">
            @csrf
            <div class="dz-message needsclick">
              Drop files here or click to upload
              <span class="note needsclick"> Select image to  replace the profile photo.</span>
            </div>
            <div class="fallback">
              <input name="file" type="file" />
            </div>
            <input type="hidden" name="id" id="user_id">
            <input type="hidden" name="profile-photo" id="profile-photo">
          </form>

          <div class="col-12 text-center mt-20">
            <button type="button" class="btn btn-primary me-3" id="savePhoto"> <i class="ti ti-device-floppy"></i>Save</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
        </div>

      </div>
    </div>
  </div>
</div>
<!--/ Edit User Modal -->
