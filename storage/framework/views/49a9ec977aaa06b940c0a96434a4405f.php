<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Epsilon</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <style>
    .popover {
      outline: 2px solid red !important;
      /* <- debug */
      z-index: 99999 !important;
      /* <- float above everything */
    }
  </style>
  <!----
        PLUGINS DE CSS - PENDIENTE DESCARGARLOS PARA TENERLOS DE FORMA LOCAL
  <--> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
    integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
    onload="this.media='all'" />
  <!--end::Fonts-->
  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
    crossorigin="anonymous" />
  <!--end::Third Party Plugin(OverlayScrollbars)-->
  <!--begin::Third Party Plugin(Bootstrap Icons)-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    crossorigin="anonymous" />
  <!--end::Third Party Plugin(Bootstrap Icons)-->
  <!--begin::Required Plugin(AdminLTE)-->

  <link rel="stylesheet" href="<?php echo e(url('/')); ?>/css/plugins/adminlte.css" />
  <!--link rel="stylesheet" href="<?php echo e(url('/')); ?>/css/plugins/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/css/plugins/responsive.bootstrap.min.css" /-->
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <!--end::Required Plugin(AdminLTE)-->
  <!-- apexcharts -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
    integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />
  <!-- jsvectormap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
    integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous" />

  <?php echo app('Tighten\Ziggy\BladeRouteGenerator')->generate(); ?>
  <?php echo app('Illuminate\Foundation\Vite')('resources/js/app.js'); ?>
  <!--<?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.js']); ?> -->
  <!-- 'css/plugins/adminlte.css', -->

  <!--script src="https://kit.fontawesome.com/e632f1f723.js" crossorigin="anonymous"></script-->
  <!----
        PLUGINS DE JAVACRIPT - PENDIENTE DESCARGARLOS PARA TENERLOS DE FORMA LOCAL
    <-->
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
    crossorigin="anonymous"></script>
  <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    crossorigin="anonymous"></script>
  <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
  <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->

  <script src="<?php echo e(url('/')); ?>/js/plugins/adminlte.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <!--script src="<?php echo e(url('/')); ?>/js/plugins/jquery.dataTables.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/js/plugins/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/js/plugins/dataTables.responsive.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/js/plugins/responsive.bootstrap.min.js"></script-->
  <script src="<?php echo e(url('/')); ?>/js/plugins/codigo.js"></script>


  <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js" crossorigin="anonymous"></script>
  <!-- sortablejs -->
  <script>

    new Sortable(document.querySelector('.connectedSortable'), {
      group: 'shared',
      handle: '.card-header',
    });

    const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
    cardHeaders.forEach((cardHeader) => {
      cardHeader.style.cursor = 'move';
    });
  </script>

  <!-- apexcharts -->
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
    integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>

</head>

  <?php if(Route::has('login')): ?>
    <?php if(auth()->guard()->check()): ?>

      <body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">

      <div class="app-wrapper">

      <?php echo $__env->make('modulos.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <?php echo $__env->make('modulos.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <?php echo $__env->yieldContent('content'); ?>
      
      <?php echo $__env->make('modulos.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

      </div>
      <?php echo $__env->make('modulos.notie-alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      </body>

    <?php else: ?>

      <?php echo $__env->make('paginas.login', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php endif; ?>

  <?php endif; ?>



</html><?php /**PATH E:\Documentos\LARAVEL\EpsilonV2-VersionControl\2025-08-27-CrearRolesEpsilon-1\Epsilon-1\Epsilon\resources\views/plantilla.blade.php ENDPATH**/ ?>