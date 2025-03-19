<!DOCTYPE html>
<html lang="en">
@include('admin.partials.meta')

<body class="position-relative">
<div class="position-absolute overlay w-100 h-100">
    <div class="d-flex align-items-center justify-content-center w-100 h-100">
        <div class="spinner-border text-danger" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>
@include('admin.partials.sidebar')
<div class="main d-flex flex-column gap-3 pb-3">
    @include('admin.partials.header')
    <div class="content p-3 rounded-2 shadow bg-white flex-grow-1 mx-3">
        @yield('content')
    </div>
</div>

@include('admin.partials.footer')
</body>
</html>
