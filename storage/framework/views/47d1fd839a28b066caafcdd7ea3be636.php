
<?php $__env->startSection('content'); ?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <main class="app-main" id="main" tabindex="-1">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
            <div class="row">

                <!--div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Inicio</a></li>
                    </ol>
                </div-->
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
                        <div class="card-title"><b>Solicitudes Registradas</b></div>
                    </div>
                    
                    <table id="tabla_gestion_solicitudes_sistemas" class="table table-striped table-hover align-middle w-100" data-ajax="<?php echo e(route('listar.solicitudes')); ?>">
                    <thead>
                        <tr>
                        <th></th> 
                        <th>#</th>
                        <th>Sede</th>     
                        <th>Asunto</th>     
                        <th>Funcionario</th>     
                        <th>Fecha Solicitud</th>     
                        <th>Fecha Cierre</th>     
                        <th>Prioridad</th>     
                        <th>Categoría</th>     
                        <th>Estado</th>                                
                        <th>Asignar</th>     
                        <th>Acciones</th>                        
                        </tr>
                    </thead>
                    </table>            
                    <script>
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


<div class="modal" id="editarRoles" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header big-info">
                <!--div class="card-title">Datos Personales</div-->
                <h4 class="modal-title">Editar Rol</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="" class="needs-validation" id="formEditarRol" autocomplete="off">                    
                    <?php echo method_field('PUT'); ?>
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-md-">
                                <label for="validationCustom02" class="form-label"><b>Nombre</b>
                                    <span class="required-indicator sr-only"> (required)</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    required="" value="">
                                <div class="valid-feedback">Looks good!</div>
                            </div>     
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <input type="hidden" class="form-control" id="id" name="id" />
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="crearRol" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header big-info">                
                <h4 class="modal-title">Crear Rol</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="" class="needs-validation" id="crearRol" autocomplete="off">                    
                    <?php echo csrf_field(); ?>
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-md-">
                                <label for="validationCustom02" class="form-label"><b>Nombre</b>
                                    <span class="required-indicator sr-only"> (required)</span></label>
                                <input type="text" class="form-control" id="name_m" name="name_m"
                                    required="" value="">
                                <div class="valid-feedback">Looks good!</div>
                            </div>     
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>                    
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Documentos\LARAVEL\EpsilonV2-VersionControl\Epsilon2\resources\views/paginas/Sistemas/gestion_solicitudes.blade.php ENDPATH**/ ?>