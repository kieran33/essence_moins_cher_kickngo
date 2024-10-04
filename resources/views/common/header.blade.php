<!-- ================================
     Start Header Area
================================= -->

<!-- Navbar start -->
<div class="container-fluid">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">21 rue Ail, 67000 Strasbourg, France</a></small>
                <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">Essence-@moins-cher.com</a></small>
            </div>
        </div>
    </div>
    <div class="container px-0 py-2">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a class="nav-item nav-link px-5 {{classActivePathSite('/')}}" href="{{ URL::to('/') }}" title="{{trans('words.home')}}"
                    style="font-size: 1.5rem;"
                    >{{trans('words.home')}}</a>
                    <a class="nav-item nav-link px-5 {{classActivePathSite('categories')}}" href="{{ URL::to('ville') }}" title="{{trans('words.categories')}}"
                    style="font-size: 1.5rem;"
                    >{{trans('words.categories')}}</a>
                    <a class="nav-item nav-link px-5 {{classActivePathSite('a-proximite')}}" href="{{ URL::to('a-proximite') }}" title="a-proximite"
                    style="font-size: 1.5em;"
                    >A proximité</a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->