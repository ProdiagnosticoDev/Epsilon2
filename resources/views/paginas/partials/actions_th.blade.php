<div class="btn-group btn-group-sm" role="group" aria-label="Acciones">
  <!-- EDITAR TODO -->
  <button type="button"
          class="btn btn-primary btn-sm editUsuario"
          data-id="{{ $u->id }}"
          data-update="{{ route('usuarios.update', $u->id) }}"
          data-show="{{ route('usuarios.show', $u->id) }}"
          data-bs-toggle="modal"
          data-bs-target="#editarUsuario"
          title="Actualizar usuario">
      <i class="fas fa-pencil-alt text-white"></i>
  </button>
  &nbsp;
  <!-- CAMBIAR SOLO ESTADO --> 
  <button type="button"
          class="btn btn-success btn-sm edit-btn"
          data-pk="{{ $u->id }}"
          data-url="{{ route('usuarios.update_state', $u->id) }}"
          data-value="{{ (int) $u->estado }}"
          title="Cambiar estado">
      <i class="fa-solid fa-square-check"></i>
  </button>
</div>