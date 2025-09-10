<button class="btn btn-primary btn-sm" 
data-bs-toggle="modal" 
data-bs-target="#crearProrrogas"
 id="Crear"
  onclick="agregarInfo(
  '<?php echo e($u->TipoDocumento); ?>', 
  '<?php echo e($u->documento); ?>',
  '<?php echo e($u->name); ?>', 
  '<?php echo e($u->cargo); ?>',
   '<?php echo e($u->fecha_ingreso); ?>')
   ">Crear</button><?php /**PATH C:\xampp\htdocs\Epsilon2-Desarrollo2PDX\Epsilon2\resources\views/paginas/partials/actions_thcartas.blade.php ENDPATH**/ ?>