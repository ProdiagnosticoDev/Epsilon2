<div class="btn-group btn-group-sm" role="group" aria-label="Acciones">
  <!-- EDITAR TODO -->
  <button type="button"
          class="btn btn-primary btn-sm editUsuario"
          data-id="<?php echo e($u->id); ?>"
          data-update="<?php echo e(route('usuarios.update', $u->id)); ?>"
          data-show="<?php echo e(route('usuarios.show', $u->id)); ?>"
          data-bs-toggle="modal"
          data-bs-target="#editarUsuario"
          title="Actualizar usuario">
      <i class="fas fa-pencil-alt text-white"></i>
  </button>
  &nbsp;
  <!-- CAMBIAR SOLO ESTADO --> 
  <button type="button"
          class="btn btn-success btn-sm edit-btn"
          data-pk="<?php echo e($u->id); ?>"
          data-url="<?php echo e(route('usuarios.update_state', $u->id)); ?>"
          data-value="<?php echo e((int) $u->estado); ?>"
          title="Cambiar estado">
      <i class="fa-solid fa-square-check"></i>
  </button>
</div><?php /**PATH E:\Documentos\LARAVEL\EpsilonV2-VersionControl\Epsilon-1\Epsilon\resources\views/paginas/partials/actions_th.blade.php ENDPATH**/ ?>