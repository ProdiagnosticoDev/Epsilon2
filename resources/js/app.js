import './bootstrap';
import Alpine from 'alpinejs';

import DataTable from 'datatables.net-bs5';
import 'datatables.net-bs5/css/dataTables.bootstrap5.css';

import 'datatables.net-responsive-bs5';
import 'datatables.net-responsive-bs5/css/responsive.bootstrap5.css';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
  const el = document.querySelector('#tabla_usuarios');
  if (!el) return;

  const ajaxUrl = el.dataset.ajax;
  if (!ajaxUrl) { console.error('Missing data-ajax on #tabla_usuarios'); return; }

  const dt = new DataTable(el, {
    processing: true,
    serverSide: true,
    ajax: { url: ajaxUrl },

    // use una columna de control para el icono de expansion    
    // responsive: { details: { type: 'column', target: 0 } }, 
    responsive: {
      details: {
        type: 'column',
        target: 'td.dtr-control, td.dtr-aux' // ← multiple selectors = multiple controls
      }
    },
      columnDefs: [
    { targets: 0, className: 'dtr-control', orderable: false }, // primer acolumna muestra el ícnono 
    { targets: 4, className: 'dtr-aux' },                       // dar clic al nombre despliega el responsiveclicking “Nombre” also toggles
    { targets: -1, orderable: false, searchable: false },       
  ],
    autoWidth: false,
    language: {
      // Usa el JSON oficial de i18n para DataTables v2
      url: 'https://cdn.datatables.net/plug-ins/2.0.0/i18n/es-ES.json'
      // (puedes subir a 2.0.8/2.3.x si prefieres; debe ser 2.x)
    },

    columns: [
      { data: null, defaultContent: '', className: 'dtr-control', orderable: false }, // control
      { data: 'id', className: 'all' },          
      { data: 'TipoDocumento', className: 'min-tablet' },   
      { data: 'documento', className: 'min-tablet-l' },         
      { data: 'name', className: 'min-tablet-l' },
      { data: 'email', className: 'none' },
      { data: 'cargo', className: 'min-desktop' },
      { data: 'actions', className: 'all', orderable: false, searchable: false },
    ],
    order: [[1, 'asc']], // porque la columna b es la columna de control
  });

  // ski la tabla empieza en una pestaña / modal
  document.addEventListener('shown.bs.modal', () => { dt.columns.adjust(); dt.responsive.recalc(); });
  document.addEventListener('shown.bs.tab', () => { dt.columns.adjust(); dt.responsive.recalc(); });
});



document.addEventListener('DOMContentLoaded', () => {
  const modalEl = document.getElementById('editarUsuario');
  const form    = document.getElementById('frmEditarUsuario');

  if (!modalEl || !form) return;

  // Cuando se abre el modal, Bootstrap pasa el botón que lo disparó en relatedTarget
  modalEl.addEventListener('show.bs.modal', async (event) => {
    const btn = event.relatedTarget;
    if (!btn) return;

    const updateUrl = btn.getAttribute('data-update'); // /crear_usuarios/{id}
    const showUrl   = btn.getAttribute('data-show');   // /crear_usuarios/{id}
    form.setAttribute('action', updateUrl);            // <<< AQUÍ seteamos el action

    // (Opcional) si usuarios.show devuelve JSON con X-Requested-With, puedes precargar:
    try {
      const res = await fetch(showUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' }});
      if (res.ok && res.headers.get('content-type')?.includes('application/json')) {
        const u = await res.json();
        document.getElementById('edit_nombre').value = u.name  ?? '';
        document.getElementById('edit_email').value  = u.email ?? '';
        // ...rellena el resto de inputs si quieres...
      }
    } catch (_) {}
  });
});


// tabla roles de usuarios

document.addEventListener('DOMContentLoaded', () => {
  const el = document.querySelector('#tabla_roles_usuario');
  if (!el) return;

  const ajaxUrl = el.dataset.ajax;
  if (!ajaxUrl) { console.error('Missing data-ajax on #tabla_roles_usuario'); return; }

  const dt = new DataTable(el, {
    processing: true,
    serverSide: true,
    ajax: { url: ajaxUrl },

    // use una columna de control para el icono de expansion    
    // responsive: { details: { type: 'column', target: 0 } }, 
    responsive: {
      details: {
        type: 'column',
        target: 'td.dtr-control, td.dtr-aux' // ← multiple selectors = multiple controls
      }
    },
      columnDefs: [
    { targets: 0, className: 'dtr-control', orderable: false }, // primer acolumna muestra el ícnono 
    { targets: 4, className: 'dtr-aux' },                       // dar clic al nombre despliega el responsiveclicking “Nombre” also toggles
    { targets: -1, orderable: false, searchable: false },       
  ],
    autoWidth: false,
    language: {
      // Usa el JSON oficial de i18n para DataTables v2
      url: 'https://cdn.datatables.net/plug-ins/2.0.0/i18n/es-ES.json'
      // (puedes subir a 2.0.8/2.3.x si prefieres; debe ser 2.x)
    },

    columns: [
      { data: null, defaultContent: '', className: 'dtr-control', orderable: false }, // control
      { data: 'id', className: 'all' },          
      { data: 'TipoDocumento', className: 'min-tablet' },   
      { data: 'documento', className: 'none' },         
      { data: 'name', className: 'min-tablet-l' },
      { data: 'email', className: 'min-desktop' },
      { data: 'cargo', className: 'min-desktop' },
      { data: 'actions', className: 'all', orderable: false, searchable: false },
    ],
    order: [[1, 'asc']], // porque la columna b es la columna de control
  });

  // ski la tabla empieza en una pestaña / modal
  document.addEventListener('shown.bs.modal', () => { dt.columns.adjust(); dt.responsive.recalc(); });
  document.addEventListener('shown.bs.tab', () => { dt.columns.adjust(); dt.responsive.recalc(); });
});



// tabja roles
document.addEventListener('DOMContentLoaded', () => {
  const el = document.querySelector('#tabla_roles');
  if (!el) return;

  const ajaxUrl = el.dataset.ajax;
  if (!ajaxUrl) { console.error('Missing data-ajax on #tabla_roles'); return; }

  const dt = new DataTable(el, {
    processing: true,
    serverSide: true,
    ajax: { url: ajaxUrl },

    // use una columna de control para el icono de expansion    
    // responsive: { details: { type: 'column', target: 0 } }, 
    responsive: {
      details: {
        type: 'column',
        target: 'td.dtr-control, td.dtr-aux' // ← multiple selectors = multiple controls
      }
    },
      columnDefs: [
    { targets: 0, className: 'dtr-control', orderable: false }, // primer acolumna muestra el ícnono 
    { targets: 1, className: 'dtr-aux' },                       // dar clic al nombre despliega el responsiveclicking “Nombre” also toggles
    { targets: -1, orderable: false, searchable: false },       
  ],
    autoWidth: false,
    language: {
      // Usa el JSON oficial de i18n para DataTables v2
      url: 'https://cdn.datatables.net/plug-ins/2.0.0/i18n/es-ES.json'
      // (puedes subir a 2.0.8/2.3.x si prefieres; debe ser 2.x)
    },

    columns: [
      { data: null, defaultContent: '', className: 'dtr-control', orderable: false }, // control
      { data: 'id', className: 'all' },                  
      { data: 'name', className: 'min-tablet-l' },
      { data: 'created_at', className: 'min-tablet-l' },
      { data: 'updated_at', className: 'none' },
      { data: 'actions', className: 'all', orderable: false, searchable: false },
    ],
    order: [[1, 'asc']], // porque la columna b es la columna de control
  });

  // ski la tabla empieza en una pestaña / modal
  document.addEventListener('shown.bs.modal', () => { dt.columns.adjust(); dt.responsive.recalc(); });
  document.addEventListener('shown.bs.tab', () => { dt.columns.adjust(); dt.responsive.recalc(); });
});