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
                    <!--h3 class="mb-0">Gestión de usuario</h3-->
                    <!--button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#crearUsuario">Crear
                                    Usuario</button-->
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
                    <div class="card-title"><b>Gestión de usuario</b></div>
                </div>
                {{-- Este datatable es del lado del servidor, Se usa Yajra y su configuración se encuentra en el archivo
                    app.js --}}
                <table id="tabla_roles_usuario" class="table table-striped table-hover align-middle w-100"
                    data-ajax="{{ route('gestionU.list') }}">
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
{{-- gestion roles --}}
<div class="modal" id="gestionRoles" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header big-info">
                <!--div class="card-title">Datos Personales</div-->
                <h4 class="modal-title">Asignar Roles</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="#" class="needs-validation" id="formaAsignarRoles">
                    @csrf
                    @method('PUT')
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-md-3">
                                <label for="validationCustom02" class="form-label"><b>Nombre</b></label>
                                <div>
                                    <span id="nombre"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="validationCustom08" class="form-label"><b>Grupo Empleado</b></label>
                                <div>
                                    <span id="grupo_empleado"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="validationCustomUsername" class="form-label"><b>Correo / Usuario</b></label>
                                <div class="input-group has-validation">
                                    <div>
                                        <span id="email"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>&nbsp;</div>
                        <div class="row g-2">
                            <!--input type="text" id="rolesFilter" class="form-control form-control-sm mb-2" placeholder="Filtrar roles…"-->
                            <label class="form-label mb-2"><b>Roles asignados</b></label>
                            <div id="rolesContainer" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-2">
                            {{-- AQUÍ: contenedor donde se inyectan los checkboxes de roles --}}
                                
                                <div id="rolesContainer" class="d-grid gap-3">
                                    <div class="text-muted">Cargando roles…</div>
                                </div>
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
</div> <!-- php artisan route:list | grep gestion_role -->
@endsection