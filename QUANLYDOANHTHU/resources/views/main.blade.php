<!DOCTYPE html>
<html lang="en">
<head>
    @include('parts.head')
</head>
<body>
    <section class="admin">
        <div class="row-grid">
            <div class="admin-sidebar">
                <div class="admin-sidebar-top">

                    <p>QUẢN LÝ BÁN HÀNG</p>
                </div>
                <div class="admin-sidebar-content">
                     @include('parts.sidebar')
                </div>
            </div>
            <div class="admin-content">
                <div class="admin-content-top">
                    @include('parts.header')
                </div>
                <div class="admin-content-main">
                    <div class="admin-content-main-title">
                        @yield('h1')
                    </div>
                    <div class="admin-content-main-content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </section>


<footer>
    @yield('footer')
</footer>
</body>
</html>
