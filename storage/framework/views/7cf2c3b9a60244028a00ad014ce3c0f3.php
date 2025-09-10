<!-- Mostrara modal gestion solicitud -->
<div class="btn-group btn-group-sm align-items-center" role="group">
  <button type="button"
    class="btn btn-primary btn-sm gestion"
    data-id="<?php echo e($u->idsolicitud); ?>"    
    data-bs-toggle="modal"
    data-bs-target="#gestionarSolicitud"
    title="Gestionar Solicitud">
    <i class="fa-solid fa-ticket"></i>
  </button>
  &nbsp;
  <!-- Asignar solicitud --> 
  <button type="button"
    class="btn btn-primary btn-sm asignacion"
    data-id="<?php echo e($u->idsolicitud); ?>"    
    data-bs-toggle="modal"
    data-bs-target="#asignarSolicitud"
    title="Gestionar Solicitud">
    <i class="fa-regular fa-user"></i>
  </button>  
</div>
<?php /**PATH E:\Documentos\LARAVEL\EpsilonV2-VersionControl\Epsilon2\resources\views/paginas/partials/actions_gestion_solcitudes.blade.php ENDPATH**/ ?>