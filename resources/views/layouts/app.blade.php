<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
    <div class="grid grid-cols-12 gap-0">
        <div class="col-span-2">
            @include('includes.sidebar')
        </div>
        <div class="col-span-10 bg-primary-50/5 pt-8 px-6">
            @include('includes.navbar')
            @yield('content')
            @include('includes.footer')
        </div>
    </div>
</body>
</html>