<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        <a href="#!" class="b-brand">
            <h2 style="color: white;">SIPAPA</h2>
        </a>
        <a href="#!" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <h4 class="system-title">
                    Sistem Penata Layanan Pemberhentian Pembayaran Gaji Secara Online
                </h4>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li>
                <div class="dropdown drp-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="feather icon-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            <img src="{{ (session()->get('foto') === null) ? '//placehold.co/150' : asset_upload('picture/'.session()->get('foto')) }}" class="img-radius" alt="User-Profile-Image">
                            <span>{{ session()->get('nama') }}</span>
                        </div>
                        <ul class="pro-body">
                            <li>
                                <a href="{{ route('operator.profil') }}" class="dropdown-item">
                                    <i class="feather icon-user"></i>Profil
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('auth.logout') }}" class="dropdown-item">
                                    <i class="feather icon-log-out"></i>Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>