@include('layouts.header')
{{ $slot }}
@if (session()->has('success'))
    <div id="flass_success">
        <p></p>
        <div class="alert alert-success" role="alert" style="
            right: 0;
            margin: 10px;
            bottom: 0;
            position: fixed;">
            <h4 class="alert-heading">Well done!</h4>
            <p>{{ session()->get('success') }}</p>

        </div>
    </div>
@endif
<script>
    let flass = document.getElementById('flass_success');
    if (flass) {
        setTimeout(function() {
            flass.remove();
        }, 4000);
    }
</script>
@yield('footer-scripts')
@include('layouts.footer')
