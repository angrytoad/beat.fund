<script src="https://cdnjs.cloudflare.com/ajax/libs/fuse.js/3.0.0/fuse.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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

@yield('scripts')