<!DOCTYPE html>
<html lang="en">

<head>

    <title>
        @yield('title')
    </title>

    <!--began::Header-->
        @include("layouts.includes.header")
        @yield('style')
</head>
    <!--end::Header-->
<div class="wrapper">
    <!--began::navbar-->
        @include("layouts.includes.nav_bar")
    <!--end::navbar-->
    <!--began::side_bar-->
        @include("layouts.includes.side_bar")
        @yield('content')
    <!--end::side_bar-->
</div>
    <!--began::footer-->
        @include("layouts.includes.footer")
        @yield('script')
    <!--end::footer-->
</html>
