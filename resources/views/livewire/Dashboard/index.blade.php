<section class="section">
    <div class="row ">
        <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-red">
                <div class="card-statistic-3">
                    <div class="card-icon card-icon-large" style="right:15px!important;top:10px!important;"><i class="fa fa-user-tie"></i></div>
                    <div class="card-content">
                        <h4 class="card-title">Empleados</h4>
                        <span>10,225</span>
                        <p class="mt-2 mb-0 text-sm">
                            <span class="mr-2" id="dash"><i class="fa fa-arrow-right"></i></span>
                            <a href="#" class="text-nowrap" id="link-dash">Más detalles</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-green">
                <div class="card-statistic-3">
                    <div class="card-icon card-icon-large" style="right:45px!important;top:10px!important;"><i class="fa fa-users"></i></div>
                    <div class="card-content">
                        <h4 class="card-title">Clientes</h4>
                        <span>{{ $customers }} Clientes</span>
                        <p class="mt-2 mb-0 text-sm">
                            <span class="mr-2" id="dash"><i class="fa fa-arrow-right"></i></span>
                            <a href="{{ route('admin.customers') }}" class="text-nowrap" id="link-dash">Más detalles</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-cyan">
                <div class="card-statistic-3">
                    <div class="card-icon card-icon-large" style="right:15px!important;top:8px!important;"><i class="fa fa-certificate"></i></div>
                    <div class="card-content">
                        <h4 class="card-title">Productos</h4>
                        <span>{{ $products }} Productos</span>
                        <p class="mt-2 mb-0 text-sm">
                            <span class="mr-2" id="dash"><i class="fa fa-arrow-right"></i></span>
                            <a href="{{ route('admin.products') }}" class="text-nowrap" id="link-dash">Más detalles</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-orange">
                <div class="card-statistic-3">
                    <div class="card-icon card-icon-large" style="right:45px!important;top:10px!important;"><i class="fa fa-truck-loading"></i></div>
                    <div class="card-content">
                        <h4 class="card-title">Proveedores</h4>
                        <span>{{ $providers }} Proveedores</span>
                        <p class="mt-2 mb-0 text-sm">
                            <span class="mr-2" id="dash"><i class="fa fa-arrow-right"></i></span>
                            <a href="{{ route('admin.providers') }}" class="text-nowrap" id="link-dash">Más detalles</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-yellow">
                <div class="card-statistic-3">
                    <div class="card-icon card-icon-large" style="right:10px!important;top:10px!important;"><i class="fa fa-bookmark"></i></div>
                    <div class="card-content">
                        <h4 class="card-title">Marcas</h4>
                        <span>{{ $brands }} Marcas</span>
                        <p class="mt-2 mb-0 text-sm">
                            <span class="mr-2" id="dash"><i class="fa fa-arrow-right"></i></span>
                            <a href="{{ route('admin.brands') }}" class="text-nowrap" id="link-dash">Más detalles</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-purple">
                <div class="card-statistic-3">
                    <div class="card-icon card-icon-large" style="right:40px!important;top:10px!important;"><i class="fa fa-tags"></i></div>
                    <div class="card-content">
                        <h4 class="card-title">Categorías</h4>
                        <span>{{ $categories }} Categorías</span>
                        <p class="mt-2 mb-0 text-sm">
                            <span class="mr-2" id="dash"><i class="fa fa-arrow-right"></i></span>
                            <a href="{{ route('admin.categories') }}" class="text-nowrap" id="link-dash">Más detalles</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-dark-gray">
                <div class="card-statistic-3">
                    <div class="card-icon card-icon-large" style="right:-8px!important;top:10px!important;" ><i class="fa fa-dollar-sign"></i></div>
                    <div class="card-content">
                        <h4 class="card-title">Compras del día</h4>
                        <span>10,225</span>
                        <p class="mt-2 mb-0 text-sm">
                            <span class="mr-2" id="dash"><i class="fa fa-arrow-right"></i></span>
                            <a href="#" class="text-nowrap" id="link-dash">Más detalles</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-red-dark">
                <div class="card-statistic-3">
                    <div class="card-icon card-icon-large" style="right:40px!important;top:10px!important;" ><i class="fa fa-money-bill-wave"></i></div>
                    <div class="card-content">
                        <h4 class="card-title">Ventas del día</h4>
                        <span>10,225</span>
                        <p class="mt-2 mb-0 text-sm">
                            <span class="mr-2" id="dash"><i class="fa fa-arrow-right"></i></span>
                            <a href="#" class="text-nowrap" id="link-dash">Más detalles</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
