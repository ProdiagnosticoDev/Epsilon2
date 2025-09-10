
<?php $__env->startSection('content'); ?>

 

    <main class="app-main" id="main" tabindex="-1">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <!--h3 class="mb-0">Crear usuario</h3-->
                        <!--<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#crearProrrogas">Crear
                            Usuario</button>-->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Inicio</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Fixed Layout</li>
                        </ol>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="card card-info card-outline mb-4">
                    <!--begin::Header-->
                    <div class="card-header">
                        <div class="card-title"><b>Generar cartas</b></div>
                    </div>
                    <table class="table table-bordered table-striped responsive" id="tabla_usuarios_cartas" name="tabla_usuarios_cartas" data-ajax="<?php echo e(route('cartas.list')); ?>">
                        <thead>
                            <tr>
                                <th width="10px">ID</th>
                                <th>Tipo Documento</th>
                                <th>Documento</th>
                                <th>Nombre</th>                                
                                <th>Cargo</th>
                                <th>Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($usuario->id); ?></td>
                                    <td><?php echo e($usuario->TipoDocumento); ?></td>
                                    <td><?php echo e($usuario->documento); ?></td>
                                    <td><?php echo e($usuario->name); ?></td>
                                    <td><?php echo e($usuario->cargo); ?></td>
                                    <td>
                                       <!-- <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#crearProrrogas" id="Crear" 
                                        onclick="agregarInfo('<?php echo e($usuario->TipoDocumento); ?>', '<?php echo e($usuario->documento); ?>', '<?php echo e($usuario->name); ?>', '<?php echo e($usuario->cargo); ?>', '<?php echo e($usuario->fecha_ingreso); ?>')">Crear</button>-->
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3">No hay usuarios registrados</td>
                                </tr>
                            <?php endif; ?> 
                        </tbody>
                    </table>
                    <!--end::Header-->
                    <!--begin::Form-->
                    <!--end::Form-->
                    <!--begin::JavaScript-->
                    <script>

                        function agregarInfo(TipoDocumento, documento, name, cargo, fecha_ingreso){

                            document.getElementById("TipoDocumento").value = TipoDocumento;  
                            document.getElementById("documento").value = documento;  
                            document.getElementById("name").value = name;  
                            document.getElementById("cargo").value = cargo;
                            document.getElementById("fecha_ingreso").value = fecha_ingreso;    
                                                      
                        }  


                        // Example starter JavaScript for disabling form submissions if there are invalid fields
                        (() => {


                          

                            'use strict';

                            // Fetch all the forms we want to apply custom Bootstrap validation styles to
                            const forms = document.querySelectorAll('.needs-validation');

                            // Loop over them and prevent submission
                            Array.from(forms).forEach((form) => {
                                form.addEventListener(
                                    'submit',
                                    (event) => {
                                        if (!form.checkValidity()) {
                                            event.preventDefault();
                                            event.stopPropagation();
                                        }

                                        form.classList.add('was-validated');
                                    },
                                    false,
                                );
                            });
                        })();
                    </script> 
                    <!--end::JavaScript--> 
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
            <!--end::App Content-->
    </main>
    <div class="modal fade" id="crearProrrogas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-xs" >
            <div class="modal-content">
                <div class="modal-header">
                    <div class="card-title">Generar carta</div>                    
                </div>
                <div class="modal-body">
                    <form method="get" action="<?php echo e(route('pdf.generate')); ?>" class="needs-validation">
                        <?php echo csrf_field(); ?>
                        <!--begin::Body-->
                        <div class="card-body">
                            
                            <div class="row g-3">
                                <div class="col-md-5">
                                    <select name="tipo_carta" id="tipo_carta" class="form-control" required="">
                                        <option value="">--Seleccione--</option>
                                        <?php $__currentLoopData = $tipo_carta_th; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($id->id); ?>"><?php echo e($id->tipo_carta); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>   
                                </div>                                
                                <div class="col-md-5">
                                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required=""> 
                                </div>                                                                                   
                            </div>

                            <input type="hidden" class="form-control" id="TipoDocumento" name="TipoDocumento">   
                            <input type="hidden" class="form-control" id="documento" name="documento"> 
                            <input type="hidden" class="form-control" id="name" name="name"> 
                            <input type="hidden" class="form-control" id="cargo" name="cargo">                             
                            <input type="hidden" class="form-control" id="fecha_ingreso" name="fecha_ingreso">  
                            
                            <!--<div class="row g-3">
                                <div class="col-md-10">
                                    <select name="cargo" id="cargo" class="form-control" required="">   
                                        <option value="">--Seleccione--</option>                                     
                                        <?php $__currentLoopData = $grupoEmpleado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($id->id); ?>"><?php echo e($id->descripcion); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>   
                                </div>                                                                                                                   
                            </div>-->                            

                        </div>

                        <br>
                        <div class="modal-footer">
                            <div class="card-footer">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantilla', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Epsilon2-Desarrollo2PDX\Epsilon2\resources\views/paginas/TalentoHumano/Cartas/generar_prorrogas.blade.php ENDPATH**/ ?>