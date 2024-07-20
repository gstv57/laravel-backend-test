<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Clientes</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">Menu</li>

                    <!-- Clientes -->
                    <li class="nav-item {{ Request::is('clientes*') ? 'active' : '' }}">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                            data-target="#submenu-clientes" aria-controls="submenu-clientes">
                            <i class="fa fa-fw fa-user-circle"></i>Clientes <span class="badge badge-success">6</span>
                        </a>
                        <div id="submenu-clientes" class="collapse submenu">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('clientes.index') }}">Ver clientes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('clientes.create') }}">Criar cliente</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Produtos -->
                    <li class="nav-item {{ Request::is('produtos*') ? 'active' : '' }}">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                            data-target="#submenu-produtos" aria-controls="submenu-produtos">
                            <i class="fa fa-fw fa-box"></i>Produtos <span class="badge badge-success">10</span>
                        </a>
                        <div id="submenu-produtos" class="collapse submenu">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('produtos.index') }}">Ver produtos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('produtos.create') }}">Criar produto</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('categorias.index') }}">Ver categorias</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('categorias.create') }}">Criar categoria</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Pedidos -->
                    <li class="nav-item {{ Request::is('pedidos*') ? 'active' : '' }}">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                            data-target="#submenu-pedidos" aria-controls="submenu-pedidos">
                            <i class="fas fa-shopping-basket"></i>Pedidos <span class="badge badge-success">10</span>
                        </a>
                        <div id="submenu-pedidos" class="collapse submenu">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pedidos.index') }}">Ver pedidos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pedidos.create') }}">Criar pedido</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
