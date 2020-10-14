<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title')</title>
        {{-- styles --}}
        @include('includes.styles')
        @stack('styles')
    </head>
    <body class="sb-nav-fixed">
        {{-- navbar --}}
        @include('includes.navbar')
        <div id="layoutSidenav">
            {{-- sidebar --}}
            @include('includes.sidebar')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">@yield('sub-title')</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">@yield('breadcrumb')</li>
                        </ol>
                        <div class="row">
                            <div class="col-md-12">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </main>
                {{-- footer --}}
                @include('includes.footer')
            </div>
        </div>
        {{-- scripts --}}
        @include('includes.scripts')
        @stack('scripts')
    </body>
</html>
