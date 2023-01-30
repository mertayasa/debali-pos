@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <strong> {{ $message }}</strong>
    </div>
    <script>
        window.localStorage.clear();
    </script>
@endif

@if ($message = Session::get('error') )
    <div class="alert alert-danger alert-block">

        <strong> {{$message}}</strong>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block">
    <strong> {{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block">
    <strong> {{ $message }}</strong>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="m-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="w-100 rounded p-2 text-white mb-2" x-bind:class="$store.global.flashClass" x-show="$store.global.isFlash">
    <ul class="mb-0">
        <template x-for="(value, index) in $store.global.flashData">
            <li x-text="value"></li>
        </template>
    </ul>
</div>

{{-- @push('scripts')
    <script>
        $(".alert-block").fadeTo(5000, 500).slideUp(500);
    </script>
@endpush --}}
