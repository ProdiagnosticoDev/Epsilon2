<div class="btn-group btn-group-sm align-items-center" role="group">
  <button type="button"
          class="btn btn-primary btn-sm gestion"
          data-id="{{-- $role->id --}}"
          data-name="{{-- $role->name --}}"
          data-url="{{-- route('roles.update', $role->id) --}}"
          data-bs-toggle="modal"
          data-bs-target="#editarRoles">
    <i class="fa-solid fa-ticket"></i>
  </button>

  <select class="form-select form-select-sm ms-1 seleccionar-estado"
          data-id="{{-- $role->id --}}"
          data-url="{{-- route('roles.cambiar-estado', $role->id) --}}">
      {{--  @foreach($opciones as $op)
          <option value="{{ $op->id }}"
              @selected(optional($role->estado)->id == $op->id)>{{ $op->nombre }}</option>
      @endforeach --}}
  </select>
</div>
