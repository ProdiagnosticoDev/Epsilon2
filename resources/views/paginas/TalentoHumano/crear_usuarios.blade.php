@extends('plantilla')
@section('content')

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
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
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
                    {{-- Este datatable es del lado del servidor, Se usa Yajra y su configuración se encuentra en el archivo app.js --}}
                    <table id="tabla_usuarios" class="table table-striped table-hover align-middle w-100" data-ajax="{{ route('usuarios.list') }}">
                    <thead>
                        <tr>
                        <th></th> {{-- control column --}}
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
                    {{-- Este es el datatable habitual. Si se desea usar debe descomentar los scripts en la plantilla  y en el archivo codigo.js --}}
                    <!--table class="table table-bordered table-striped responsive" id="tabla_usuarios"-->
                        {{--<thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo Documento</th>
                                <th>Documento</th>
                                <th>Nombre</th>                                
                                <th>Email</th>
                                <th>Cargo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->id }}</td>
                                    <td>{{ $usuario->TipoDocumento }}</td>
                                    <td>{{ $usuario->documento }}</td>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>{{ $usuario->cargo }}</td>
                                    <td>
                                        <button type="button" 
                                                class="btn btn-primary btn-sm editUsuario"
                                                data-id="{{ $usuario->id }}"
                                                data-update="{{ route('usuarios.update', $usuario->id) }}"  
                                                data-show="{{ route('usuarios.show', $usuario->id) }}"      
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editarUsuario"
                                                title="Actualizar usuario">                                                
                                            <i class="fas fa-pencil-alt text-white"></i>
                                        </button>
                                        <button
                                            class="btn btn-sm btn-success edit-btn"
                                            data-pk="{{ $usuario->id }}"
                                            data-url="{{ route('usuarios.update_state', $usuario->id) }}"  
                                            data-value="{{ (int)$usuario->estado }}"
                                            title="Cambiar estado">
                                            <i class="fa-solid fa-square-check"></i>
                                        </button>                                        
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No hay usuarios registrados</td>
                                </tr>
                            @endforelse 
                        </tbody> --}}
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
    {{--  Crear usuario --}}
    <div class="modal" id="crearUsuario" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header big-info">
                    <!--div class="card-title">Datos Personales</div-->
                    <h4 class="modal-title">Datos Personales</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('usuarios.store') }}" class="needs-validation" email>
                        @csrf
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
                                        @foreach($tipoDocumento as $documento)
                                            <option value="{{ $documento->id }}">{{ $documento->descripcion }}</option>
                                        @endforeach
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
                                        @foreach($grupoEmpleado as $grupo)
                                            <option value="{{ $grupo->id }}">{{ $grupo->descripcion }}</option>
                                        @endforeach
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
                                        @foreach($listaUsuarios as $usuario)
                                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                        @endforeach
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
                                    <x-input-label for="password" :value="__('Password')" class="form-label" />
                                    <x-text-input id="password" class="form-control" type="password" name="password"
                                        value="123456789" required autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password')"
                                        class="@vite(['resources/css/app.css', 'resources/js/app.js'])" />
                                    <!--label for="validationCustom01" class="form-label">Contraseña
                               <span class="required-indicator sr-only"> (required)</span></label>
                               <input type="text" class="form-control" id="validationCustom01" value="" required="">
                               <div class="valid-feedback">Looks good!</div-->
                                </div>
                                <div class="col-md-3">
                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')"
                                        class="form-label" />
                                    <x-text-input id="password_confirmation" class="form-control" type="password"
                                        value="123456789" name="password_confirmation" required
                                        autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="form-control" />
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

    {{-- Editar usuario --}}

    <div class="modal" id="editarUsuario" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header big-info">
                    <!--div class="card-title">Datos Personales</div-->
                    <h4 class="modal-title">Editar usuario</h4>
                </div>
                <div class="modal-body">                    
                    <form method="POST" action="" class="needs-validation" id="frmEditarUsuario" autocomplete="off">
                        @method('PUT')
                        @csrf
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
                                        @foreach($tipoDocumento as $documento)
                                            <option value="{{ $documento->id }}">{{ $documento->descripcion }}</option>
                                        @endforeach
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
                                        @foreach($grupoEmpleado as $grupo)
                                            <option value="{{ $grupo->id }}">{{ $grupo->descripcion }}</option>
                                        @endforeach
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
                                        @foreach($listaUsuarios as $usuario)
                                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                        @endforeach
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
                                    <x-input-label for="password" :value="__('Password')" class="form-label" />
                                    <x-text-input id="password_m" class="form-control" type="password" name="password"
                                        value="" required autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password')"
                                        class="@vite(['resources/css/app.css', 'resources/js/app.js'])" />
                                    <!--label for="validationCustom01" class="form-label">Contraseña
                               <span class="required-indicator sr-only"> (required)</span></label>
                               <input type="text" class="form-control" id="validationCustom01" value="" required="">
                               <div class="valid-feedback">Looks good!</div-->
                                </div>
                                <div class="col-md-3">
                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')"
                                        class="form-label" />
                                    <x-text-input id="password_confirmation" class="form-control" type="password"
                                        value="" name="password_confirmation" required
                                        autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="form-control" />
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
@endsection