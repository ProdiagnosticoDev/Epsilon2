
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
                <div class="card card-info card-outline mb-3">
                    <form>
                        <div class="row g-2">
                      
                            <div class="row g-2 mb-3">
                            <div class="col-auto">
                                <input type="date" id="f-start" class="form-control form-control-sm" placeholder="Desde" required="">
                            </div>
                            <div class="col-auto">
                                <input type="date" id="f-end" class="form-control form-control-sm" placeholder="Hasta" required="">
                            </div>
                            <div class="col-auto">
                               <select id="estado" name="estado" class="form-control">
                               </select>
                            </div>
                            <div class="col-auto">
                                <button id="btn-apply" class="btn btn-sm btn-primary">Filtrar</button>
                                <button id="btn-clear" class="btn btn-sm btn-outline-secondary">Limpiar</button>
                            </div>
                            </div>
                        </div>
                        <div>&nbsp;</div>
                  </form>
                </div>
            </div>
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


<div class="modal" id="gestionarSolicitud" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header big-info">
                <!--div class="card-title">Datos Personales</div-->
                <h4 class="modal-title">Gestionar Solicitud</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="" class="needs-validation" id="formGestionarSolicitud" autocomplete="off">                    
                    <?php echo method_field('PUT'); ?>
                    <!--begin::Body-->
                 <!--begin::Body-->
                        <div class="card-body">
                            <div class="row g-2">
                                <!--begin::Col-->
                                <div class="col-md-3">
                                    <label for="validationCustom01" class="form-label">Solicitante
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <select name="tipo_documento_m" id="tipo_documento_m" class="form-control tipo_documento" required="">
                                        <option value="">-- Seleccione --</option>
                                        <!--option value="1">Cédula de ciudadanía</option-->
                    
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="validationCustomUsername" class="form-label">Asunto
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">#</span>
                                        <input type="text" class="form-control" id="documento_m"
                                            name="documento_m" aria-describedby="inputGroupPrepend" required=""
                                            value="">
                                        <div class="invalid-feedback">Ingresa el número de documento.</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="validationCustom01" class="form-label">Sede
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <input type="text" class="form-control" id="nombre_m" name="nombre_m"
                                        required="" value="Usuario De pruebas">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="validationCustom01" class="form-label">Área a quien solicita
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <input type="date" class="form-control" id="fecha_nacimiento_m" name="fecha_nacimiento_m"
                                        required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                            <!--begin::Row-->
                            <div class="row g-2">
                                <!--begin::Col-->
                                <div class="col-md-3">
                                    <label for="validationCustom01" class="form-label">Fecha y hora solicitud
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <input type="text" class="form-control" id="direccion_m" name="direccion_m"
                                        required="" value="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-3">
                                    <label for="validationCustom01" class="form-label">Fecha y hora cierre
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">#</span>
                                        <input type="text" class="form-control" id="telefono_m"
                                            name="telefono_m" aria-describedby="inputGroupPrepend" required=""
                                            value="">
                                        <div class="invalid-feedback">Ingresa el número de teléfono.</div>
                                    </div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-3">
                                    <label for="validationCustom01" class="form-label">Prioridad
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <input type="date" class="form-control" id="fecha_ingreso_m" name="fecha_ingreso_m"
                                        required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <!--end::Col-->
                                <div class="col-md-3">
                                    <label for="validationCustom01" class="form-label">Tipo Solicitud
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <select name="grupo_empleado_m" id="grupo_empleado_m" class="form-control" required="">
                                        <!--option value="12">-- Practicante --</option-->
                                        <option value="">-- Seleccione --</option>
               
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Row-->
                            </div>
                            <!--begin::Row-->
                            <div class="row g-2">
                                <div class="col-md-3">
                                    <label for="validationCustom01" class="form-label">Estado Solicitud
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">$</span>
                                        <input type="text" class="form-control" id="salario_m" name="salario_m"
                                            aria-describedby="inputGroupPrepend" required="" value="0">
                                        <div class="invalid-feedback">Ingresa el número de teléfono.</div>
                                    </div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="validationCustom01" class="form-label">Categoría
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">$</span>
                                        <input type="text" class="form-control" id="aux_transporte_m" name="aux_transporte_m"
                                            aria-describedby="inputGroupPrepend" required=""
                                            value="0">
                                        <div class="invalid-feedback">Ingresa el número de teléfono.</div>
                                    </div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="validationCustom01" class="form-label">ANS
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <select name="jefe_directo_m" id="jefe_directo_m" class="form-control">
                                        <!--option value="2">Usuario de pruebas</option-->
                                        <option value="">-- Seleccione --</option>         
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div> 
                            <div class="row g-2">
                                <div class="col-md-3">   
                                    text area va aqui 
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


<div class="modal" id="asignarSolicitud" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header big-info">
                <!--div class="card-title">Datos Personales</div-->
                <h4 class="modal-title">Asginar Solicitud</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="" class="needs-validation" id="formGestionarSolicitud" autocomplete="off">                    
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Documentos\LARAVEL\EpsilonV2-VersionControl\Epsilon2\resources\views/paginas/Sistemas/gestion_solicitudes.blade.php ENDPATH**/ ?>