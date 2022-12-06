<div class="header pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 d-inline-block mb-0">@yield('title')</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links">
                            @yield('breadcrumb')
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    @yield('actions')
                </div>
            </div>
        </div>
    </div>
</div>
