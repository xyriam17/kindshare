<!-- Edit User Modal -->
<div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-edit-user">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-6">
          <h4 class="mb-2">Edit User Information</h4>

        </div>
          <form action="/upload" class="dropzone needsclick" id="dropzone-basic">
            <div class="dz-message needsclick">
              Drop files here or click to upload
              <span class="note needsclick"> Select image to  replace the profile photo.</span>
            </div>
            <div class="fallback">
              <input name="file" type="file" />
            </div>
          </form>
        <form id="updateForm" class="row g-6">
          @csrf
          <input type="hidden" name="profile_photo" id="profile-photo">
          <input type="hidden" name="id" value="{{ $user->id }}">
          <div class="col-12 col-md-4">
            <label class="form-label" for="modalEditUserFirstName">Firstname</label>
            <input type="text" id="modalEditUserFirstName" name="firstname" class="form-control" placeholder="" value="" />
          </div>
          <div class="col-12 col-md-4">
            <label class="form-label" for="modalEditMiddlename">Middlename</label>
            <input type="text" id="modalEditMiddlename" name="middlename" class="form-control" placeholder="Doe" value="Doe" />
          </div>
          <div class="col-12 col-md-4">
            <label class="form-label" for="modalEditUserLastName">Lastname</label>
            <input type="text" id="modalEditUserLastName" name="lastname" class="form-control" placeholder="Doe" value="Doe" />
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="modalEditUserName">Email/Username</label>
            <input type="text" id="modalEditUserName" name="modalEditUserName" class="form-control" placeholder="john.doe.007" value="john.doe.007" />
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label" for="modalEditUserPhone">Phone Number</label>
            <div class="input-group">
              <span class="input-group-text">PH (+63)</span>
              <input type="text" id="modalEditUserPhone" name="contact_no" class="form-control phone-number-mask" placeholder="202 555 0111" value="202 555 0111" />
            </div>
          </div>
          <div class="col-12 col-md-12">
            <label class="form-label" for="modalAddress">Address</label>

            <textarea name="address" id="modalAddress" class="form-control">
         
            </textarea>
          </div>
    


    
          @if( auth()->check() && auth()->user()->role_id == 3)
          <div class="col-12 col-md-12">
            <label class="form-label" for="modalEditRole">Role</label>
            <select id="modalEditRole" name="role" class="form-select" >
              <option value="">Select</option>
              <option value="1">Staff</option>
              <option value="2">Admin</option>
              <option value="3">Super Admin</option>

            </select>
          </div>
          @endif


          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-3">Save</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--/ Edit User Modal -->
