<div class="btn-group btn-group-sm" role="group">
  <button type="button"
          class="btn btn-primary btn-sm gestion"
          data-id="{{-- $role->id --}}"
          data-name="{{-- $role->name --}}"
          data-url="{{-- route('roles.update', $role->id) --}}"
          data-bs-toggle="modal"
          data-bs-target="#editarRoles">   
    <i class="fa-regular fa-user"></i>
  </button>
</div>