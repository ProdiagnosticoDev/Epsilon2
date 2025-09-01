<div class="btn-group btn-group-sm" role="group" aria-label="Acciones">
  <button type="button"
      class="btn btn-primary btn-sm addRoles"
      data-id="{{ $u->id }}"
      data-show="{{ route('roles.show', $u->id) }}"            {{-- GET JSON /gestion_roles/{id} --}}
      data-update="{{ route('users.roles.update', $u->id) }}"  {{-- PUT    /gestion_role/{id}/roles --}}
      data-bs-toggle="modal"
      data-bs-target="#gestionRoles">
    <!--i class="fas fa-pencil-alt text-white"></i>
    <i class="fa-solid fa-person-circle-check"></i-->
    <i class="fa-regular fa-user"></i>
</button>