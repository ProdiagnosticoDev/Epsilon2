<link rel="stylesheet" href="https://unpkg.com/notie/dist/notie.min.css">
<script src="https://unpkg.com/notie"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    <?php if(session('success')): ?>
        notie.alert({ 
        type: 'success', 
        text: <?php echo json_encode(session('success'), 15, 512) ?>,
        time: 3
    });
    <?php endif; ?>

    <?php if(session('error')): ?>
        notie.alert({ 
        type: 'error', 
        text: <?php echo json_encode(session('error'), 15, 512) ?>,
        time: 3 
    });
    <?php endif; ?>

    <?php if($errors->any()): ?>
        notie.alert({ 
        type: 'error',
        text: <?php echo json_encode($errors->first(), 15, 512) ?>,
        time: 3
     });
    <?php endif; ?>
});
</script>
<style>
.notie-container {
    z-index: 9999 !important;
}
.notie-textbox {
    color: #fff !important;
    font-size: 16px !important;
    text-shadow: none !important;
}
</style><?php /**PATH C:\xampp\htdocs\Epsilon2-Desarrollo2PDX\Epsilon2\resources\views/modulos/notie-alerts.blade.php ENDPATH**/ ?>