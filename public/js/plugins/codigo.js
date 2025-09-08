// Aplicar https://obfuscator.io/ antes  de salir a produccion

/*  datatable antereior. Se cambió a server datatabla usando Yajra. si se desea volver al datatable normal debe descomentar esta linea y la tabla comentada en la vista 
var tabla
$(document).ready( function () {
    tabla = $('#tabla_usuarios').DataTable();   
    
} );
 
*/
    
$(document).on('click', '.editUsuario', async function (e) {
  e.preventDefault();

  $(".modal input").val("");
  $('.modal select').val("");
  const id = $(this).data('id');  
  $("#id_m").val(id);
  console.log('Click modal editar  id:', id);
  
  // Setear action del form
  const $form = $('#formEditarUsuario');
  $form.attr('action', `/crear_usuarios/${id}`);

  try {
    const res = await fetch(`/crear_usuarios/${id}`, { headers: { 'Accept': 'application/json' } });
    if (!res.ok) {
      console.error('Fetch error', res.status, await res.text());
      //alert('No se pudo cargar el usuario. Revisa la consola.');
       notie?.alert({ type: 'error', text: json?.message || 'No se pudo cargar el usuario. Revisa la consola', time: 3 });
      return;
    }
    const data = await res.json();
    console.log(" json data "  + data);
    $('#documento_m').val(data.documento ?? '');
    $('#nombre_m').val(data.name ?? '');
    $('#fecha_nacimiento_m').val(data.fecha_nacimiento ?? '');
    $('#fecha_ingreso_m').val(data.fecha_ingreso ?? '');
    $('#direccion_m').val(data.direccion ?? '');
    $('#telefono_m').val(data.telefono ?? '');
    $('#salario_m').val(data.salario ?? 0);
    $('#aux_transporte_m').val(data.auxilio_transporte ?? 0);
    $('#email_m').val(data.email ?? '');


    if (data.id_tipo_documento) {
        $('#tipo_documento_m').val(String(data.id_tipo_documento)).trigger('change');
    }

    if (data.id_grupo_empleado) {
        $('#grupo_empleado_m').val(String(data.id_grupo_empleado)).trigger('change');
    }

    if (data.id_jefedirecto) {
        $('#jefe_directo_m').val(String(data.id_jefedirecto)).trigger('change');
    } 


    // Password opcional en editar
    $('#password_m').prop('required', false).val('');
    $('#password_confirmation_m').prop('required', false).val('');

  } catch (err) {
    console.error('Error de red:', err);
    //alert('Error de red al cargar el usuario.');
    notie?.alert({ type: 'error', text: 'No fue posible cagar la información. Si su sesión ha expirado por favor vuelva a ingresar', time: 3 });
    window.location.reload();
    //notie?.alert({ type: 'error', text: msg, time: 3 });
  }
});

/*
$(document).on('submit', '#frmEditarUsuario', function (e) {
  e.preventDefault();

  const $form = $(this);
  const actionUrl = $form.attr('action'); // ← ya es /crear_usuarios/{id}
  const $btn = $form.find('button[type="submit"]');

  console.log("actionUrl =>" + actionUrl);

  $form.find('.is-invalid').removeClass('is-invalid');
  $form.find('.invalid-feedback.dynamic').remove();
  $btn.prop('disabled', true).data('orig', $btn.html()).html('Guardando...');

  $.ajax({
    url: actionUrl,
    type: 'PUT', // ← PUT real
    data: $form.serialize(), // incluye _token por @csrf
    headers: {
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },

    success: function (json) {
      notie?.alert({ type: 'success', text: json?.message || 'Usuario modificado exitosamente !', time: 3 });
      // Si usas DataTables server-side:
      // DataTable.tables({ api:true }).ajax.reload(null, false);
      window.location.reload();
    },

    error: function (xhr) {
      const json = xhr.responseJSON;
      let msg = 'Error al guardar.';
      if (xhr.status === 422 && json?.errors) {
        const errs = json.errors, lines = [];
        for (const field in errs) {
          const text = errs[field].join(' ');
          lines.push(text);
          let $input = $form.find(`[name="${field}"]`);
          if (!$input.length) $input = $form.find(`#${field}_m`);
          if ($input.length) {
            $input.addClass('is-invalid');
            const $msg = $('<div class="invalid-feedback dynamic"></div>').text(text);
            const $group = $input.closest('.input-group');
            $group.length ? $group.after($msg) : $input.after($msg);
          }
        }
        msg = lines.join('\n');
      } else if (xhr.status === 419) {
        msg = 'Tu sesión expiró. Recarga la página.';
      } else if (json?.message) {
        msg = json.message;
      }
      notie?.alert({ type: 'error', text: msg, time: 3 });
      $form.find('.is-invalid').first().trigger('focus');
    },

    complete: function () {
      $btn.prop('disabled', false).html($btn.data('orig'));
    }
  });
});
*/
/*
$(document).on('submit', '#frmEditarUsuario', function (e) {
  //const id = $(this).data('id');
  var id = $("#id_m").val();
  console.log('Click boton editar  id:', id);

  e.preventDefault();

  const $form = $(this);
  const actionUrl = $form.attr('action'); // already full /crear_usuarios/{id}
  console.log('[submit] actionUrl=', actionUrl);

  const $btn = $form.find('button[type="submit"]');
  $form.find('.is-invalid').removeClass('is-invalid');
  $form.find('.invalid-feedback.dynamic').remove();
  $btn.prop('disabled', true).data('orig', $btn.html()).html('Guardando...');
  var id = $("#id_m").val();

  $.ajax({
    url: actionUrl,//'/crear_usuarios/'+id,
    method: 'PUT', // @method('PUT') in the form spoofs PUT
    data: $form.serialize(),
        headers: {
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },

    success: function (json) {
        notie?.alert({ type: 'success', text: json?.message || 'Usuario modificado exitosamente !', time: 3 });
        window.location.reload();
    },

    error: function (xhr) {
      const json = xhr.responseJSON;
      let msg = 'Error al guardar.';
      if (xhr.status === 422 && json?.errors) {
        const errs = json.errors, lines = [];
        for (const field in errs) {
          const text = errs[field].join(' ');
          lines.push(text);
          let $input = $form.find(`[name="${field}"]`);
          if (!$input.length) $input = $form.find(`#${field}_m`);
          if ($input.length) {
            $input.addClass('is-invalid');
            const $msg = $('<div class="invalid-feedback dynamic"></div>').text(text);
            const $group = $input.closest('.input-group');
            $group.length ? $group.after($msg) : $input.after($msg);
          }
        }
        msg = lines.join('\n');
      } else if (xhr.status === 419) {
        msg = 'Tu sesión expiró. Recarga la página.';
      } else if (json?.message) {
        msg = json.message;
      }
      notie?.alert({ type: 'error', text: msg, time: 3 });
      $form.find('.is-invalid').first().trigger('focus');
    },

    complete: function () {
      $btn.prop('disabled', false).html($btn.data('orig'));
    }
  });
});
*/ //tira 405



$(document).on('submit', '#frmEditarUsuario', function (e) {
  e.preventDefault();

  const $form = $(this);
  let actionUrl = $form.attr('action');           // ← /crear_usuarios/{id}
  console.log('[submit] actionUrl=', actionUrl);

  const $btn = $form.find('button[type="submit"]');
  $form.find('.is-invalid').removeClass('is-invalid');
  $form.find('.invalid-feedback.dynamic').remove();
  $btn.prop('disabled', true).data('orig', $btn.html()).html('Guardando...');

  // Aseguramos que _method=PUT vaya en el body aunque falte en el form
  const data = $form.serialize();
  const payload = data.includes('_method=PUT') ? data : (data + '&_method=PUT');

  $.ajax({
    url: actionUrl,
    method: 'POST',  // POST (el spoof hace el PUT)
    data: payload,
    headers: {
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },

    success: function (json) {
      notie?.alert({ type: 'success', text: json?.message || 'Usuario actualizado exitosamente !!', time: 3 });
      // Si prefieres no recargar toda la página:
      // DataTable.tables({ api:true }).ajax.reload(null, false);
      window.location.reload();
    },

    error: function (xhr) {
      const json = xhr.responseJSON;
      let msg = 'Error al guardar.';
      if (xhr.status === 422 && json?.errors) {
        const errs = json.errors, lines = [];
        for (const field in errs) {
          const text = errs[field].join(' ');
          lines.push(text);
          let $input = $form.find(`[name="${field}"]`);
          if (!$input.length) $input = $form.find(`#${field}_m`);
          if ($input.length) {
            $input.addClass('is-invalid');
            const $msg = $('<div class="invalid-feedback dynamic"></div>').text(text);
            const $group = $input.closest('.input-group');
            $group.length ? $group.after($msg) : $input.after($msg);
          }
        }
        msg = lines.join('\n');
      } else if (xhr.status === 419) {
        msg = 'Tu sesión expiró. Recarga la página.';
      } else if (json?.message) {
        msg = json.message;
      }
      notie?.alert({ type: 'error', text: msg, time: 3 });
      console.error('[submit error]', xhr.status, xhr.responseText);
    },

    complete: function () {
      $btn.prop('disabled', false).html($btn.data('orig'));
    }
  });
});


let pop = null;

$(document).on('click', '.edit-btn', function (e) {
  e.preventDefault();

  pop?.dispose?.(); pop = null;

  const $btn  = $(this);
  const pk    = String($btn.data('pk') ?? '');
  const url   = $btn.data('url');                 
  const value = String($btn.data('value') ?? '1'); // "0" or "1"

  if (!pk || !url) { console.error('Missing pk or url', { pk, url }); return; }

  pop = new bootstrap.Popover(this, {
    trigger: 'manual',
    placement: 'bottom',
    container: 'body',
    title: 'Habilitado',
    html: true,
    sanitize: false,
    content: `
      <div class="d-flex align-items-center gap-2">
        <select class="form-select form-select-sm" id="sel-${pk}">
          <option value="1" ${value==='1'?'selected':''}>Sí</option>
          <option value="2" ${value==='2'?'selected':''}>No</option>
        </select>
        <button class="btn btn-sm btn-primary" data-role="ok" data-url="${url}" data-pk="${pk}">✓</button>
        <button class="btn btn-sm btn-light border" data-role="cancel">✕</button>
      </div>`
  });
  pop.show();
  setTimeout(() => document.getElementById(`sel-${pk}`)?.focus(), 0);
});


$(document).on('click', '[data-role="cancel"]', function () {
  pop?.dispose?.(); pop = null;
});

$(document).on('click', '[data-role="ok"]', function () {
  const $ok   = $(this);
  const url   = $ok.data('url');       
  const pk    = String($ok.data('pk'));
  const estado= String($(`#sel-${pk}`).val()); // "0" | "1"

  // Disable while saving
  $ok.prop('disabled', true).text('…');
  $('[data-role="cancel"]').prop('disabled', true);

  const csrfToken = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: url,
    type: 'PATCH', // or: type:'POST', data:{ _method:'PATCH', estado }
    data: { estado },
    headers: {
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    }
  })
  .done(function (resp) {
    // Update UI
    const yes = (estado === '1');
    const $badge = $(`[data-field="enabled-${pk}"]`);
    $badge
      .toggleClass('text-bg-success', yes)
      .toggleClass('text-bg-secondary', !yes)
      .text(yes ? 'sí' : 'no');

    // Remember for next open
    $(`.edit-btn[data-pk="${pk}"]`).data('value', estado);

    notie?.alert({ type: 'success', text: (resp?.message || 'Estado actualizado'), time: 2 });
    pop?.dispose?.(); pop = null;
  })
  .fail(function (xhr) {
    const json = xhr.responseJSON;
    const msg = (json?.message || json?.error || xhr.responseText || 'No se pudo guardar.');
    notie?.alert({ type: 'error', text: msg, time: 3 });
    $ok.prop('disabled', false).text('✓');
    $('[data-role="cancel"]').prop('disabled', false);
  });
});



/*
$(document).on('click', '.addRoles', async function (e) {
  e.preventDefault();

  $(".modal input").val("");
  $('.modal select').val("");
  const id = $(this).data('id');  
  $("#id").val(id);
  //console.log('Click modal editar  id:', id);
  
  // Setear action del form
  const $form = $('#formaAsignarRoles');
  $form.attr('action', `/gestion_roles/${id}`);

  try {
    const res = await fetch(`/gestion_roles/${id}`, { headers: { 'Accept': 'application/json' } });
    if (!res.ok) {
      console.error('Fetch error', res.status, await res.text());
      //alert('No se pudo cargar el usuario. Revisa la consola.');
       notie?.alert({ type: 'error', text: json?.message || 'No se pudo cargar el usuario. Revisa la consola', time: 3 });
      return;
    }
    const data = await res.json();
    //console.log(" json data "  + JSON.stringify(data));
    //$('#tipo_documento').val(data.Tipodocumento ?? '');
    $('#documento').html(data.documento ?? '');
    $('#nombre').html(data.name ?? '');    
    $('#grupo_empleado').html(data.cargo ?? '');
    $('#email').html(data.email ?? '');
    

  } catch (err) {
    console.error('Error de red:', err);
    //alert('Error de red al cargar el usuario.');
    notie?.alert({ type: 'error', text: 'No fue posible cagar la información. Si su sesión ha expirado por favor vuelva a ingresar', time: 3 });
    //window.location.reload();
    //notie?.alert({ type: 'error', text: msg, time: 3 });
  }
});*/

$(document).on('click', '.addRoles', async function (e) {
  e.preventDefault();

  // Limpia campos del modal
  $(".modal input").val("");
  $('.modal select').val("");
  $('#rolesContainer').empty();

  const id = $(this).data('id');
  $("#id").val(id);

  // IMPORTANTE: action debe ser el endpoint de UPDATE (PUT)
  const $form = $('#formaAsignarRoles');
  $form.attr('action', `/gestion_role/${id}/roles`);
  

  try {
    // Trae JSON del usuario + roles
    const res = await fetch(`/gestion_roles/${id}`, { headers: { 'Accept': 'application/json' } });
    const raw = await res.text();

    let data;
    try { data = JSON.parse(raw); } catch (e) { throw new Error(raw || 'Respuesta inválida'); }

    if (!res.ok) {
      const msg = data?.message || 'No se pudo cargar el usuario.';
      throw new Error(msg);
    }

    // Soporta tanto "user" como "usuario"
    const u = data.user || data.usuario || {};
    $('#documento').text(u.documento ?? '');
    $('#nombre').text(u.name ?? '');
    $('#grupo_empleado').text(u.cargo ?? '');
    $('#email').text(u.email ?? '');

    // Pintar roles
    const roles = Array.isArray(data.roles) ? data.roles : [];
    if (!roles.length) {
      $('#rolesContainer').html('<div class="text-muted">No hay roles definidos.</div>');
    } else {
      const html = roles.map(r => {
        const checked = (r.has === true || r.has === 1 || r.has === '1') ? 'checked' : '';
        return `
          <label class="d-flex align-items-center gap-2">
            <input type="checkbox" name="roles[]" value="${r.name}" ${checked}>
            <span>${r.name}</span>
          </label>`;
      }).join('');
      $('#rolesContainer').html(html);
    }

  } catch (err) {
    console.error('Error cargando roles:', err);
    notie?.alert({ type: 'error', text: err.message || 'No se pudo cargar la información.', time: 3 });
  }
});


// Guardar
/*
$(document).on('submit', '#formaAsignarRoles', function (e) {
  e.preventDefault();

  let action = this.action || '';
  // Safety: if action accidentally points to the JSON endpoint, fix it:
  if (/\/gestion_roles\/\d+$/i.test(action)) {
    const id = action.match(/(\d+)$/)[1];
    action = `/gestion_role/${id}/roles`;
  }

  const csrf  = $('meta[name="csrf-token"]').attr('content');
  const roles = $(this).find('input[name="roles[]"]:checked')
                       .map(function(){ return this.value; }).get();

  $.ajax({
    url: action,
    type: 'POST',                      // use POST…
    data: { roles, _method: 'PUT' },   // …spoofing PUT
    headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }
  })
  .done(function (json) {
    notie?.alert({ type: 'success', text: json?.message || 'Roles actualizados exitosamente !', time: 3 });
    if ($.fn.DataTable && $('#tabla_roles_usuario').length) {
      $('#tabla_roles_usuario').DataTable().ajax.reload(null, false);
        window.location.reload();
    }
     window.location.reload();
  })
  .fail(function (xhr) {
    const msg = (xhr.responseJSON && (xhr.responseJSON.message || xhr.responseJSON.error))
             || xhr.responseText || 'No se pudo guardar.';
    notie?.alert({ type: 'error', text: msg, time: 3 });
    console.error('[roles] AJAX fail', xhr.status, xhr.responseText);
  });
});
*/

$(document).on('input', '#rolesFilter', function () {
  const q = this.value.toLowerCase();
  $('#rolesContainer label, #rolesContainer .form-check').each(function () {
    $(this).toggle($(this).text().toLowerCase().includes(q));
  });
});

$(document).on('submit', '#formaAsignarRoles', function (e) {
  e.preventDefault();

  const $form = $(this);
  const $btn  = $form.find('button[type="submit"]');
  const action = $form.attr('action');
  const csrf   = $('meta[name="csrf-token"]').attr('content');
  const roles  = $form.find('input[name="roles[]"]:checked').map(function(){ return this.value; }).get();
  const csrfToken = $('meta[name="csrf-token"]').attr('content');

  $btn.prop('disabled', true).data('old', $btn.text()).text('Guardando…');

  $.ajax({
    url: action,
    type: 'POST',
    data: { roles, _method: 'PUT' },
    //headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }
    headers: {
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    }
  })
  .done(json => {
    notie?.alert({ type: 'success', text: json?.message || 'Roles actualizados exitosamente !', time: 3 });
    if ($.fn.DataTable && $('#tabla_roles_usuario').length) {
      $('#tabla_roles_usuario').DataTable().ajax.reload(null, false);
    }
    window.location.reload();
  })
  .fail(xhr => {
    const msg = (xhr.responseJSON && (xhr.responseJSON.message || xhr.responseJSON.error))
             || xhr.responseText || 'No se pudo guardar.';
    notie?.alert({ type: 'error', text: msg, time: 3 });
    window.location.reload();
  })
  .always(() => {
    $btn.prop('disabled', false).text($btn.data('old') || 'Guardar');
  });
});


$(document).on('click', '.editRole', async function (e) {
  e.preventDefault();

  $(".modal input").val("");
  $('.modal select').val("");
  const id = $(this).data('id');  
  $("#id_m").val(id);
  console.log('Click modal editar  id:', id);
  
  // Setear action del form
  const $form = $('#formEditarRol');
  const csrfToken = $('meta[name="csrf-token"]').attr('content');
  $form.attr('action', `/crear_roles/${id}`);

  try {
    const res = await fetch(`/crear_roles/${id}`, { 
      //headers: { 'Accept': 'application/json' } 
      headers: {
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    }
    });
    if (!res.ok) {
      console.error('Fetch error', res.status, await res.text());
      //alert('No se pudo cargar el usuario. Revisa la consola.');
       notie?.alert({ type: 'error', text: json?.message || 'No se pudo cargar el usuario. Revisa la consola', time: 3 });
      return;
    }
    const data = await res.json();
    console.log(" json data "  + JSON.stringify(data));    
    $('#name').val(data.name ?? '');    


  } catch (err) {
    console.error('Error de red:', err);
    //alert('Error de red al cargar el usuario.');
    notie?.alert({ type: 'error', text: 'No fue posible cagar la información. Si su sesión ha expirado por favor vuelva a ingresar', time: 3 });
    //window.location.reload();
    //notie?.alert({ type: 'error', text: msg, time: 3 });
  }
});



$(document).on('submit', '#formEditarRol', function (e) {
  e.preventDefault();

  const $form = $(this);
  let actionUrl = $form.attr('action');           // ← /crear_usuarios/{id}
  console.log('[submit] actionUrl=', actionUrl);

  const $btn = $form.find('button[type="submit"]');
  $form.find('.is-invalid').removeClass('is-invalid');
  $form.find('.invalid-feedback.dynamic').remove();
  $btn.prop('disabled', true).data('orig', $btn.html()).html('Guardando...');

  // Aseguramos que _method=PUT vaya en el body aunque falte en el form
  const data = $form.serialize();
  const payload = data.includes('_method=PUT') ? data : (data + '&_method=PUT');  

  $.ajax({
    url: actionUrl,
    method: 'POST',  // POST (el spoof hace el PUT)
    data: payload,
    headers: {
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },

    success: function (json) {
      notie?.alert({ type: 'success', text: json?.message || 'Rol actualizado exitosamente !', time: 3 });
      // Si prefieres no recargar toda la página:
      // DataTable.tables({ api:true }).ajax.reload(null, false);
      window.location.reload();
    },

    error: function (xhr) {
      const json = xhr.responseJSON;
      let msg = 'Error al guardar.';
      if (xhr.status === 422 && json?.errors) {
        const errs = json.errors, lines = [];
        for (const field in errs) {
          const text = errs[field].join(' ');
          lines.push(text);
          let $input = $form.find(`[name="${field}"]`);
          if (!$input.length) $input = $form.find(`#${field}_m`);
          if ($input.length) {
            $input.addClass('is-invalid');
            const $msg = $('<div class="invalid-feedback dynamic"></div>').text(text);
            const $group = $input.closest('.input-group');
            $group.length ? $group.after($msg) : $input.after($msg);
          }
        }
        msg = lines.join('\n');
      } else if (xhr.status === 419) {
        msg = 'Tu sesión expiró. Recarga la página.';
      } else if (json?.message) {
        msg = json.message;
      }
      notie?.alert({ type: 'error', text: msg, time: 3 });
      console.error('[submit error]', xhr.status, xhr.responseText);
    },

    complete: function () {
      $btn.prop('disabled', false).html($btn.data('orig'));
    }
  });
});