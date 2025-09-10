<aside class="app-sidebar bg-primary-subtle" data-bs-theme="dark">
  <!--aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark" style="overflow-x:hidden"-->
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="<?php echo e(url('/')); ?>" class="brand-link">
      <!--begin::Brand Image-->
      <!--img src="<?php echo e(url('/')); ?>/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow"-->
      <i class="nav-icon bi bi-wifi"></i>
      <!--end::Brand Image-->
      <!--begin::Brand Text-->
      <span class="brand-text fw-light">Bienvenido !!</span>
      <!--end::Brand Text-->
    </a>
    <!--end::Brand Link-->
  </div>
  <!--end::Sidebar Brand-->
  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper" data-overlayscrollbars="host">
    <div class="os-size-observer">
      <div class="os-size-observer-listener"></div>
    </div>
    <div class="" data-overlayscrollbars-viewport="scrollbarHidden overflowXHidden overflowYScroll" tabindex="-1"
      style="margin-right: -16px; margin-bottom: -16px; margin-left: 0px; top: -8px; right: auto; left: -8px; width: calc(100% + 16px); padding: 8px;">
      <nav class="mt-2">
        <!--begin::Sidebar Menu-->
        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
          aria-label="Main navigation" data-accordion="false" id="navigation">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Talento Humano|Administrador')): ?>
              <i class="nav-icon bi bi-people-fill"></i>
              <p>
                Talento humano
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
              <?php endif; ?>
            </a>
            <ul class="nav nav-treeview" role="navigation" aria-label="Navigation 4">
              <li class="nav-item">
                <a href="<?php echo e(url('/crear_usuarios')); ?>" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Crear Usuarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(url('/generar_prorrogas')); ?>" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Generar Prórrogas </p>
                </a>
              </li>
            </ul>
          </li>
          <!--li class="nav-item">
                <a href="../generate/theme.html" class="nav-link">
                  <i class="nav-icon bi bi-palette"></i>
                  <p>Theme Generate</p>
                </a>
              </li-->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-file-word"></i>
              <!--i class="nav-icon bi bi-card-checklist"></i-->
              <p>
                Gestión documental
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" role="navigation" aria-label="Navigation 5">
              <li class="nav-item">
                <a href="../widgets/small-box.html" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Small Box</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../widgets/info-box.html" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>info Box</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../widgets/cards.html" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Cards</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-clipboard-fill"></i>
              <p>
                Activos fijos
                <!--span class="nav-badge badge text-bg-secondary me-3">6</span-->
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" role="navigation" aria-label="Navigation 6">
              <li class="nav-item">
                <a href="../layout/unfixed-sidebar.html" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Default Sidebar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../layout/fixed-sidebar.html" class="nav-link active">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Fixed Sidebar</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-hospital"></i>
              <p>
                Asistencial
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" role="navigation" aria-label="Navigation 7">
              <li class="nav-item">
                <a href="../UI/general.html" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>General</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../UI/icons.html" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Icons</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../UI/timeline.html" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Timeline</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-cart-check"></i>
              <p>
                Compras y suministros
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" role="navigation" aria-label="Navigation 8">
              <li class="nav-item">
                <a href="../forms/general.html" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>General Elements</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi-robot"></i>
              <p>
                Biomédica
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" role="navigation" aria-label="Navigation 9">
              <li class="nav-item">
                <a href="../tables/simple.html" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Simple Tables</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi-gpu-card"></i>
              <p>
                Sistemas
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" role="navigation" aria-label="Navigation 9">
              <li class="nav-item">
                <!--a href="../tables/simple.html" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Simple Tables</p>
                    </a-->
              <li class="nav-item">
                <a href="<?php echo e(url('/gestion_roles')); ?>" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Gestión de Usuarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(url('/crear_roles')); ?>" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Gestión roles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(url('/gestion_solicitudes')); ?>" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Gestión Solicitudes</p>
                </a>
              </li>
          </li>
        </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi-chat-square-dots"></i>
            <p>
              Comunicaciones
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" role="navigation" aria-label="Navigation 9">
            <li class="nav-item">
              <a href="../tables/simple.html" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Simple Tables</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi-cone-striped"></i>
            <p>
              Infraestructura
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" role="navigation" aria-label="Navigation 9">
            <li class="nav-item">
              <a href="../tables/simple.html" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Simple Tables</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi-table"></i>
            <p>
              Reportes
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" role="navigation" aria-label="Navigation 9">
            <li class="nav-item">
              <a href="../tables/simple.html" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Simple Tables</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fa-solid fa-headset"></i>
            <p>
              Solicitudes
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" role="navigation" aria-label="Navigation 9">
            <li class="nav-item">
              <a href="../tables/simple.html" class="nav-link">
                <i class="fa-solid fa-laptop-code"></i>
                <p>Sistemas</p>
              </a>
            </li>
          </ul>
        </li>
        </ul>
        <!--end::Sidebar Menu-->
      </nav>
    </div>
    <div
      class="os-scrollbar os-scrollbar-horizontal os-theme-light os-scrollbar-auto-hide os-scrollbar-handle-interactive os-scrollbar-track-interactive os-scrollbar-cornerless os-scrollbar-unusable os-scrollbar-auto-hide-hidden"
      style="--os-viewport-percent: 1; --os-scroll-direction: 0;">
      <div class="os-scrollbar-track">
        <div class="os-scrollbar-handle"></div>
      </div>
    </div>
    <div
      class="os-scrollbar os-scrollbar-vertical os-theme-light os-scrollbar-auto-hide os-scrollbar-handle-interactive os-scrollbar-track-interactive os-scrollbar-visible os-scrollbar-cornerless os-scrollbar-auto-hide-hidden"
      style="--os-viewport-percent: 0.3438; --os-scroll-direction: 0;">
      <div class="os-scrollbar-track">
        <div class="os-scrollbar-handle"></div>
      </div>
    </div>
  </div>
  <!--end::Sidebar Wrapper-->
</aside><?php /**PATH E:\Documentos\LARAVEL\EpsilonV2-VersionControl\Epsilon2\resources\views/modulos/sidebar.blade.php ENDPATH**/ ?>