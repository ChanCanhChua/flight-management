<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('client.partials.meta')
</head>
<body>
@include('client.partials.header')

<div class="content">
    @yield('content')
</div>

@include('client.partials.footer')
</body>
</html>
