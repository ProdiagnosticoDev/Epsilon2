<div class="btn-group btn-group-sm" role="group" aria-label="Acciones">
  <button type="button"
      class="btn btn-primary btn-sm addRoles"
      data-id="<?php echo e($u->id); ?>"
      data-show="<?php echo e(route('roles.show', $u->id)); ?>"            
      data-update="<?php echo e(route('users.roles.update', $u->id)); ?>"  
      data-bs-toggle="modal"
      data-bs-target="#gestionRoles">
    <!--i class="fas fa-pencil-alt text-white"></i>
    <i class="fa-solid fa-person-circle-check"></i-->
    <i class="fa-regular fa-user"></i>
</button><?php /**PATH E:\Documentos\LARAVEL\EpsilonV2-VersionControl\2025-08-27-CrearRolesEpsilon-1\Epsilon-1\Epsilon\resources\views/paginas/partials/actions_gu.blade.php ENDPATH**/ ?>