@php
    $success = session('success');
    $error = session('error');
    $warning = session('warning');
    $info = session('info');
@endphp

@if ($success)
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $success }}
    </div>
@endif

@if ($error)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $error }}
    </div>
@endif

@if ($warning)
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ $warning }}
    </div>
@endif

@if ($info)
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ $info }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Please check the form below for errors</strong>
    </div>
@endif
