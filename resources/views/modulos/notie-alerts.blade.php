<link rel="stylesheet" href="https://unpkg.com/notie/dist/notie.min.css">
<script src="https://unpkg.com/notie"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    @if (session('success'))
        notie.alert({ 
        type: 'success', 
        text: @json(session('success')),
        time: 3
    });
    @endif

    @if (session('error'))
        notie.alert({ 
        type: 'error', 
        text: @json(session('error')),
        time: 3 
    });
    @endif

    @if ($errors->any())
        notie.alert({ 
        type: 'error',
        text: @json($errors->first()),
        time: 3
     });
    @endif
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
</style>