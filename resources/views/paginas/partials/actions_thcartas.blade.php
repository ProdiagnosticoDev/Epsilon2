<button class="btn btn-primary btn-sm" 
data-bs-toggle="modal" 
data-bs-target="#crearProrrogas"
 id="Crear"
  onclick="agregarInfo(
  '{{ $u->TipoDocumento }}', 
  '{{ $u->documento }}',
  '{{ $u->name }}', 
  '{{ $u->cargo }}',
   '{{ $u->fecha_ingreso }}')
   ">Crear</button>