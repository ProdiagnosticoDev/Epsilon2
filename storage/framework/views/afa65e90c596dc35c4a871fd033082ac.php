<div class="btn-group btn-group-sm" role="group">
  <button type="button"
          class="btn btn-primary btn-sm editRole"
          data-id="<?php echo e($role->id); ?>"
          data-name="<?php echo e($role->name); ?>"
          data-url="<?php echo e(route('roles.update', $role->id)); ?>"
          data-bs-toggle="modal"
          data-bs-target="#editarRoles">   
    <i class="fa-regular fa-user"></i>
  </button>
</div><?php /**PATH E:\Documentos\LARAVEL\EpsilonV2-VersionControl\Epsilon2\resources\views/paginas/partials/actions_roles.blade.php ENDPATH**/ ?>