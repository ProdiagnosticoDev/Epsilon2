
<?php $__env->startSection('content'); ?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <main class="app-main" id="main" tabindex="-1">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <!--h3 class="mb-0">Crear usuario</h3--> 
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#crearUsuario">Crear
                            Usuario</button>
                    </div>
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
                        <div class="card-title"><b>Usuarios registrados</b></div>
                    </div>
                    
                    <table id="tabla_usuarios" class="table table-striped table-hover align-middle w-100" data-ajax="<?php echo e(route('usuarios.list')); ?>">
                    <thead>
                        <tr>
                        <th></th> 
                        <th>#</th>
                        <th>TipoDocumento</th>
                        <th>Documento</th>
                        <th>Nombre</th>
                        <th>Correo / Usuario</th>
                        <th>Cargo</th>
                        <th>Acciones</th>                        
                        </tr>
                    </thead>
                    </table>
                    
                    <!--table class="table table-bordered table-striped responsive" id="tabla_usuarios"-->
                        
                    <!--/table-->
                    <!--end::Header-->
                    <!--begin::Form-->
                    <!--end::Form-->
                    <!--begin::JavaScript-->
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
    
    <div class="modal" id="crearUsuario" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header big-info">
                    <!--div class="card-title">Datos Personales</div-->
                    <h4 class="modal-title">Datos Personales</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?php echo e(route('usuarios.store')); ?>" class="needs-validation" email>
                        <?php echo csrf_field(); ?>
                        <!--begin::Body-->
                        <div class="card-body">
                            <div class="row g-2">
                                <!--begin::Col-->
                                <div class="col-md-3">
                                    <label for="validationCustom01" class="form-label">Tipo documento
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <select name="tipo_documento" id="tipo_documento" class="form-control" required="">
                                        <!--option value="">-- Seleccione --</option-->
                                        <option value="1">Cédula de ciudadanía</option>
                                        <?php $__currentLoopData = $tipoDocumento; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $documento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($documento->id); ?>"><?php echo e($documento->descripcion); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="validationCustomDocumento1" class="form-label">Nro documento
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">#</span>
                                        <input type="text" class="form-control" id="validationCustomDocumento1"
                                            id="documento" name="documento" aria-describedby="inputGroupPrepend" required=""
                                            value="123456">
                                        <div class="invalid-feedback">Ingresa el número de documento.</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="validationCustom02" class="form-label">Nombre completo
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <input type="text" class="form-control" id="validationCustom03" id="nombre" name="nombre"
                                        required="" value="Usuario De pruebas">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="validationCustom04" class="form-label">Fecha de nacimiento
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <input type="date" class="form-control" id="validationCustom05" name="fecha_nacimiento"
                                        required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                            <!--begin::Row-->
                            <div class="row g-2">
                                <!--begin::Col-->
                                <div class="col-md-3">
                                    <label for="validationCustom05" class="form-label">Dirección
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <input type="text" class="form-control" id="validationCustom06" name="direccion"
                                        required="" value="Avenida siempreviva 123">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-3">
                                    <label for="validationCustom01" class="form-label">Teléfono
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">#</span>
                                        <input type="text" class="form-control" id="validationCustomTelefonoGuardar"
                                            name="telefono" aria-describedby="inputGroupPrepend" required=""
                                            value="3127545136">
                                        <div class="invalid-feedback">Ingresa el número de teléfono.</div>
                                    </div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-3">
                                    <label for="validationCustom07" class="form-label">Fecha ingreso
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <input type="date" class="form-control" id="validationCustom01" name="fecha_ingreso"
                                        required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <!--end::Col-->
                                <div class="col-md-3">
                                    <label for="validationCustom08" class="form-label">Grupo Empleado
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <select name="grupo_empleado" id="grupo_empleado" class="form-control" required="">
                                        <option value="12">-- Practicante --</option>
                                        <!--option value="">-- Seleccione --</option-->
                                        <?php $__currentLoopData = $grupoEmpleado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grupo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($grupo->id); ?>"><?php echo e($grupo->descripcion); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Row-->
                            </div>
                            <!--begin::Row-->
                            <div class="row g-2">
                                <div class="col-md-3">
                                    <label for="validationCustom01" class="form-label">Salario
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">$</span>
                                        <input type="text" class="form-control" id="validationCustomUsernameSalarioG" name="salario"
                                            aria-describedby="inputGroupPrepend" required="" value="0">
                                        <div class="invalid-feedback">Ingresa el número de teléfono.</div>
                                    </div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="validationCustom09" class="form-label">Aux transporte
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">$</span>
                                        <input type="text" class="form-control" id="validationCustomAuxTransporteG"
                                            aria-describedby="inputGroupPrepend" name="aux_transporte" required=""
                                            value="0">
                                        <div class="invalid-feedback">Ingresa el número de teléfono.</div>
                                    </div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="validationCustom10" class="form-label">Jefe directo
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <select name="jefe_directo" class="form-control" >
                                        <option value="2">Usuario de pruebas</option>
                                        <!--option value="">-- Seleccione --</option-->
                                        <?php $__currentLoopData = $listaUsuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($usuario->id); ?>"><?php echo e($usuario->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-3">
                                    <label for="validationCustomUsername" class="form-label">Correo / Usuario
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="text" class="form-control" id="validationCustomUsername"
                                            aria-describedby="inputGroupPrepend" required="" id="email" name="email"
                                            value="sincorreo@gmail.com">
                                        <div class="invalid-feedback">Por favor ingrese el correo.</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['for' => 'password','value' => __('Password'),'class' => 'form-label']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'password','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Password')),'class' => 'form-label']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'password','class' => 'form-control','type' => 'password','name' => 'password','value' => '123456789','required' => true,'autocomplete' => 'new-password']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'password','class' => 'form-control','type' => 'password','name' => 'password','value' => '123456789','required' => true,'autocomplete' => 'new-password']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('password'),'class' => '@vite([\'resources/css/app.css\', \'resources/js/app.js\'])']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('password')),'class' => '@vite([\'resources/css/app.css\', \'resources/js/app.js\'])']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                                    <!--label for="validationCustom01" class="form-label">Contraseña
                               <span class="required-indicator sr-only"> (required)</span></label>
                               <input type="text" class="form-control" id="validationCustom01" value="" required="">
                               <div class="valid-feedback">Looks good!</div-->
                                </div>
                                <div class="col-md-3">
                                    <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['for' => 'password_confirmation','value' => __('Confirm Password'),'class' => 'form-label']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'password_confirmation','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Confirm Password')),'class' => 'form-label']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'password_confirmation','class' => 'form-control','type' => 'password','value' => '123456789','name' => 'password_confirmation','required' => true,'autocomplete' => 'new-password']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'password_confirmation','class' => 'form-control','type' => 'password','value' => '123456789','name' => 'password_confirmation','required' => true,'autocomplete' => 'new-password']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('password_confirmation'),'class' => 'form-control']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('password_confirmation')),'class' => 'form-control']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
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

    

    <div class="modal" id="editarUsuario" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header big-info">
                    <!--div class="card-title">Datos Personales</div-->
                    <h4 class="modal-title">Editar usuario</h4>
                </div>
                <div class="modal-body">                    
                    <form method="POST" action="" class="needs-validation" id="frmEditarUsuario" autocomplete="off">
                        <?php echo method_field('PUT'); ?>
                        <?php echo csrf_field(); ?>
                        <!--begin::Body-->
                        <div class="card-body">
                            <div class="row g-2">
                                <!--begin::Col-->
                                <div class="col-md-3">
                                    <label for="validationCustom01" class="form-label">Tipo documento
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <select name="tipo_documento_m" id="tipo_documento_m" class="form-control tipo_documento" required="">
                                        <option value="">-- Seleccione --</option>
                                        <!--option value="1">Cédula de ciudadanía</option-->
                                        <?php $__currentLoopData = $tipoDocumento; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $documento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($documento->id); ?>"><?php echo e($documento->descripcion); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="validationCustomUsername" class="form-label">Nro documento
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
                                    <label for="validationCustom01" class="form-label">Nombre completo
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <input type="text" class="form-control" id="nombre_m" name="nombre_m"
                                        required="" value="Usuario De pruebas">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="validationCustom01" class="form-label">Fecha de nacimiento
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
                                    <label for="validationCustom01" class="form-label">Dirección
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <input type="text" class="form-control" id="direccion_m" name="direccion_m"
                                        required="" value="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-3">
                                    <label for="validationCustom01" class="form-label">Teléfono
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
                                    <label for="validationCustom01" class="form-label">Fecha ingreso
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <input type="date" class="form-control" id="fecha_ingreso_m" name="fecha_ingreso_m"
                                        required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <!--end::Col-->
                                <div class="col-md-3">
                                    <label for="validationCustom01" class="form-label">Grupo Empleado
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <select name="grupo_empleado_m" id="grupo_empleado_m" class="form-control" required="">
                                        <!--option value="12">-- Practicante --</option-->
                                        <option value="">-- Seleccione --</option>
                                        <?php $__currentLoopData = $grupoEmpleado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grupo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($grupo->id); ?>"><?php echo e($grupo->descripcion); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Row-->
                            </div>
                            <!--begin::Row-->
                            <div class="row g-2">
                                <div class="col-md-3">
                                    <label for="validationCustom01" class="form-label">Salario
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
                                    <label for="validationCustom01" class="form-label">Aux transporte
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
                                    <label for="validationCustom01" class="form-label">Jefe directo
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <select name="jefe_directo_m" id="jefe_directo_m" class="form-control">
                                        <!--option value="2">Usuario de pruebas</option-->
                                        <option value="">-- Seleccione --</option>
                                        <?php $__currentLoopData = $listaUsuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($usuario->id); ?>"><?php echo e($usuario->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <label for="validationCustomUsername" class="form-label">Correo / Usuario
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="text" class="form-control" id="email_m" name="email_m"
                                            aria-describedby="inputGroupPrepend" required="true" 
                                            value="" required="" readonly>
                                        <div class="invalid-feedback">Por favor ingrese el correo.</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['for' => 'password','value' => __('Password'),'class' => 'form-label']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'password','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Password')),'class' => 'form-label']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'password_m','class' => 'form-control','type' => 'password','name' => 'password','value' => '','required' => true,'autocomplete' => 'new-password']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'password_m','class' => 'form-control','type' => 'password','name' => 'password','value' => '','required' => true,'autocomplete' => 'new-password']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('password'),'class' => '@vite([\'resources/css/app.css\', \'resources/js/app.js\'])']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('password')),'class' => '@vite([\'resources/css/app.css\', \'resources/js/app.js\'])']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                                    <!--label for="validationCustom01" class="form-label">Contraseña
                               <span class="required-indicator sr-only"> (required)</span></label>
                               <input type="text" class="form-control" id="validationCustom01" value="" required="">
                               <div class="valid-feedback">Looks good!</div-->
                                </div>
                                <div class="col-md-3">
                                    <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['for' => 'password_confirmation','value' => __('Confirm Password'),'class' => 'form-label']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'password_confirmation','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Confirm Password')),'class' => 'form-label']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'password_confirmation','class' => 'form-control','type' => 'password','value' => '','name' => 'password_confirmation','required' => true,'autocomplete' => 'new-password']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'password_confirmation','class' => 'form-control','type' => 'password','value' => '','name' => 'password_confirmation','required' => true,'autocomplete' => 'new-password']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('password_confirmation'),'class' => 'form-control']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('password_confirmation')),'class' => 'form-control']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <input type="hidden" class="form-control" id="id_m" name="id_m" />
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Documentos\LARAVEL\EpsilonV2-VersionControl\Epsilon2\resources\views/paginas/TalentoHumano/crear_usuarios.blade.php ENDPATH**/ ?>