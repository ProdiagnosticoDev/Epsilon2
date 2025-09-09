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
                        <div class="card-title"><b>Solicitudes Registradas</b></div>
                    </div>
                    {{-- Este datatable es del lado del servidor, Se usa Yajra y su configuración se encuentra en el archivo app.js --}}
                    <table id="tabla_gestion_solicitudes_sistemas" class="table table-striped table-hover align-middle w-100" data-ajax="{{ route('listar.solicitudes') }}">
                    <thead>
                        <tr>
                        <th></th> {{-- control column --}}
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

{{-- edit roles --}}
<div class="modal" id="editarRoles" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header big-info">
                <!--div class="card-title">Datos Personales</div-->
                <h4 class="modal-title">Editar Rol</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="" class="needs-validation" id="formEditarRol" autocomplete="off">                    
                    @method('PUT')
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

{{-- Crear rol --}}
<div class="modal" id="crearRol" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header big-info">                
                <h4 class="modal-title">Crear Rol</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{-- route('users.roles.store' ) --}}" class="needs-validation" id="crearRol" autocomplete="off">                    
                    @csrf
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


@endsection