<?php $__env->startSection('css'); ?>
<style>
.menu {
    color: #1a6a9b;
    cursor: pointer;
    margin-left: 30px;
    margin-right: 30px;
}

.menu:hover {
    color: #FFF;
    background-color: #337ab7;
}



</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Bootstrap CSS (si no está ya en tu plantilla base) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Bundle con Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<main class="app-main" id="main" tabindex="-1">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">

                    <div class="actions-block">
                        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#crearProrrogas" id="Crear" onclick="">
                            <i class="fa-solid fa-download"></i>
                            Exportar
                        </button>

                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#crearGastos" id="Crear" onclick="">
                            <i class="fa-solid fa-plus"></i>
                            Solicitar gasto
                        </button>

                    </div>                    
                    
                  <!--  <ul class="nav nav-tabs justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link active menu" data-bs-toggle="tab" href="#consulta">Consulta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu" data-bs-toggle="tab" href="#categoria">Categoría</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu" data-bs-toggle="tab" href="#criterio">Criterio</a>
                        </li>
                    </ul>-->
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Fixed Layout</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-info card-outline mb-4">
                <div class="card-header">
                    <!-- Contenido de pestañas 
                    <div class="tab-content mt-3">
                        <div class="tab-pane fade show active" id="consulta">-->
                    

                        <table class="table table-bordered table-striped responsive" id="tabla_usuarios">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha</th>
                                    <th>Tipo gasto</th>                                
                                    <th>Importe</th>
                                    <th>Tipo moneda</th>
                                    <th>Descripción</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                 <?php $__empty_1 = true; $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($usuario->id); ?></td>
                                    <td><?php echo e($usuario->fecha); ?></td>
                                    <td><?php echo e($usuario->tipo_gasto); ?></td>
                                    <td><?php echo e($usuario->importe); ?></td>
                                    <td><?php echo e($usuario->moneda); ?></td>
                                    <td><?php echo e($usuario->descripcion); ?></td>

                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" style="text-align:center">No hay usuarios registrados</td>
                                </tr>
                                <?php endif; ?> 
                            </tbody>
                        </table>






                        
                        </div>


                    <!--</div>-->
                </div>

                <!-- Scripts adicionales -->
                <script>

                    document.addEventListener('DOMContentLoaded', function () {
                        ClassicEditor
                        .create(document.querySelector('#descripcion'), {
                            /*ckfinder: {
                                uploadUrl: '/ckeditor/upload' 
                            }*/
                            toolbar: [
                                'heading', '|',
                                'bold', 'italic', 'link', '|',
                                'bulletedList', 'numberedList', '|',
                                // eliminar botón imagen, video y tabla
                                'undo', 'redo'
                            ]

                        })
                        .catch(error => {
                            console.error(error);
                        });
                    });
                

                    $(document).ready(function () {

                    
                        $('.tipo_gasto').select2();
                     
                    });

                    function getTipoGasto() {
                       

                        let id = document.getElementById("tipo_gasto").value;  

                        

  
                        fetch(`/get-tipo-gasto/${id}`)
                            .then(response => {
                                if (!response.ok) throw new Error("Network error");
                                return response.json();
                            })
                            .then(data => {
                                const gasto = data.tipo_gastos[0]; // assuming only one result
                                document.getElementById('min_max').innerHTML = `
                                <div style="background-color:#E3EEFC">
                                    <p><strong>Min:</strong> ${gasto.min}</p>
                                    <p><strong>Max:</strong> ${gasto.max}</p>                                
                                </div>
                                ` ;
                            })
                            .catch(error => {
                                console.error("Error fetching data:", error);
                                document.getElementById('resultBox').innerHTML = `<p style="color:red;">Error loading data</p>`;
                            });                        

                        
                    }

                    // Validación Bootstrap
                    (() => {
                        'use strict';
                        const forms = document.querySelectorAll('.needs-validation');
                        Array.from(forms).forEach((form) => {
                            form.addEventListener('submit', (event) => {
                                if (!form.checkValidity()) {
                                    event.preventDefault();
                                    event.stopPropagation();
                                }
                                form.classList.add('was-validated');
                            }, false);
                        });
                    })();
                </script>
            </div>
        </div>
    </div>
</main>


    <div class="modal" id="crearGastos" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header big-info">
                    <!--div class="card-title">Datos Personales</div-->
                    <h4 class="modal-title">Crear gasto</h4>
                </div>
                <div class="modal-body">
                    <form id="crear_gastos" method="POST" action="<?php echo e(url('/crear_gastos')); ?>" class="needs-validation">
                        <?php echo csrf_field(); ?>
                        <!--begin::Body-->
                        <div class="card-body">
                             <div class="row g-5">
                               
                                <!--<div class="col-md-6">
                                    <label for="validationCustom01" class="form-label">Número documento
                                        <span class="required-indicator sr-only"> (required)</span></label>



                                        <select class="form-control select2" style="width: 100%;">
                                            <option value="1">Option One</option>
                                            <option value="2">Option Two</option>
                                            <option value="3">Option Three</option>
                                        </select>

                                    <div class="valid-feedback">Looks good!</div>
                                </div>-->
                                <div class="col-md-6">
                                    <label for="validationCustom02" class="form-label">Documento
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <input type="text" class="form-control" name="documento" id="documento" value="<?php echo e($currentuser); ?>" required="" readonly>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>



                            </div>
                            <br>
                            <!--begin::Row-->
                            <div class="row g-5">
                                <!--begin::Col-->

                                <div class="col-md-6">
                                    <label for="validationCustom04" class="form-label">Fecha 
                                        <span class="required-indicator sr-only"> (required)</span></label>
                                    <input type="date" class="form-control" id="fecha" name="fecha"  required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>   
                                
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label">Tipo de gasto
                                    <span class="required-indicator sr-only"> (required)</span></label>

                                    <select name="tipo_gasto" id="tipo_gasto" class="form-control" required="" onchange="getTipoGasto()">
                                        <option value="">-- Seleccione --</option-->
                                       <?php $__currentLoopData = $tipo_gastos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $descripcion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($descripcion->id); ?>"><?php echo e($descripcion->descripcion); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                        
                                    </select>
                                    
                                    <div class="valid-feedback">Looks good!</div>
                                </div>                                
                            </div>
                            <br>
                            <!--begin::Row-->
                            <div class="row g-5">
                                <div class="col-md-6">
  
                                    <label for="expense-form_money" class="label control-label required">
                                        Importe
                                    </label>

                                    <div class="input-group">
                                        <input class="form-control" type="number" id="importe" name="importe" required="">
                                        <span class="input-group-addon">
                                            <select name="tipo_moneda" id="tipo_moneda" class="form-control" style="margin-right:20px">
                                                <option value="1">COP</option>
                                                <option value="2">USD</option>      
                                                <option value="3">EUR</option>                                        
                                            </select>                                             
                                        </span>
                                            
                                    </div>
                                
                                      
                                </div>                                
                                
          
                                <div class="col-md-6">

                                    <div id="min_max"></div>

                                </div>                             


                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-12">
  
                                    <label  class="label control-label required">
                                        Descripción
                                    </label>

                                    <div class="card-body">
                                        <textarea name="descripcion" id="descripcion" class="form-control" rows="5" required><?php echo e(old('contenido')); ?></textarea>

                                    </div>
                                </div>                                
                           
                            </div> 
                            <br>  
                            
                            <!--<div class="row">
                                <div class="col-md-12">
  
                                    <label  class="label control-label required">
                                        Fichero (factura, ticket, etc...)
                                    </label>

                                    <div class="filepicker" data-id="expense-form_documents" data-name="expense[documents][]" data-multiple="" data-accept=".pdf,.doc,.docx,.csv,.xls,.xlsx,.txt,.png,.jpg,.jpeg,.zip,.rar,.mp4,.ppt,.pptx"><input type="file" accept=".pdf,.doc,.docx,.csv,.xls,.xlsx,.txt,.png,.jpg,.jpeg,.zip,.rar,.mp4,.ppt,.pptx" multiple="" name="expense[documents][]" id="expense-form_documents"> 
                                        <div class="filepicker-content">
                                            <div class="file-default-message">
                                                <i class="huge-icon huge-upload-04-stroke-rounded is-small text-current "></i> 
                                                <span class="text-grey-400">Arrastra uno o varios archivos a esta zona o haz clic para explorar</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>                                
                           
                            </div>-->                             

                        </div>
                        <br>
                        <!--end::Row-->

                        <!--begin::Row-->

                        
                </div>
                <br>
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

<?php echo $__env->make('plantilla', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Epsilon2-Desarrollo2PDX\Epsilon2\resources\views/paginas/TalentoHumano/Gastos/inicio.blade.php ENDPATH**/ ?>