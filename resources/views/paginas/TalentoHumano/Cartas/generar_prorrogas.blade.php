@extends('plantilla')
@section('content')

 

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
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
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
                    <table class="table table-bordered table-striped responsive" id="tabla_usuarios_cartas" name="tabla_usuarios_cartas" data-ajax="{{ route('cartas.list') }}">
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
                            @forelse ($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->id }}</td>
                                    <td>{{ $usuario->TipoDocumento }}</td>
                                    <td>{{ $usuario->documento }}</td>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->cargo }}</td>
                                    <td>
                                       <!-- <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#crearProrrogas" id="Crear" 
                                        onclick="agregarInfo('{{ $usuario->TipoDocumento }}', '{{ $usuario->documento }}', '{{ $usuario->name }}', '{{ $usuario->cargo }}', '{{ $usuario->fecha_ingreso }}')">Crear</button>-->
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No hay usuarios registrados</td>
                                </tr>
                            @endforelse 
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
                    <form method="get" action="{{ route('pdf.generate') }}" class="needs-validation">
                        @csrf
                        <!--begin::Body-->
                        <div class="card-body">
                            
                            <div class="row g-3">
                                <div class="col-md-5">
                                    <select name="tipo_carta" id="tipo_carta" class="form-control" required="">
                                        <option value="">--Seleccione--</option>
                                        @foreach($tipo_carta_th as $id)
                                        <option value="{{ $id->id }}">{{ $id->tipo_carta }}</option>
                                        @endforeach
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
                                        @foreach($grupoEmpleado as $id)
                                        <option value="{{ $id->id }}">{{ $id->descripcion }}</option>
                                        @endforeach
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
@endsection
