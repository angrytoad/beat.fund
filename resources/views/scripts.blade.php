<script src="{{ asset('js/app.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fuse.js/3.0.0/fuse.min.js"></script>

<!-- Add Vex -->
<script src="/js/vex.combined.min.js"></script>
<script>vex.defaultOptions.className = 'vex-theme-os'</script>
<link rel="stylesheet" href="/css/vex.css" />
<link rel="stylesheet" href="/css/vex-theme-os.css" />

<!-- Add Dropzone -->
<script src="/js/dropzone.js"></script>

<!-- Cloudinary jQuery -->
<script src="https://cdn.jsdelivr.net/jquery.cloudinary/1.0.18/jquery.cloudinary.min.js"></script>
<script>
    $.cloudinary.config({ cloud_name: '{{ env('CLOUDINARY_CLOUD_NAME') }}' });
</script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css"/>

<!-- Dropzone Js -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css" />

<!-- Quill -->
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<!-- Bootstrap Switch -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>

<!-- jQuery UI -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<!-- Bootstrap tagsinput -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />

<!-- Wavesurver -->
<script src="//cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/2.0.5/wavesurfer.min.js"></script>

<!-- TouchPunch -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>

<!-- Stripe Elements -->
<script src="https://js.stripe.com/v3/"></script>

<!-- Fuse -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fuse.js/3.0.4/fuse.min.js"></script>

@yield('scripts')