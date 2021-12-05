<section class="navbar-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg">

                    <a class="navbar-brand" href="#">
                        <img src="{{ url('logo-unib.png') }}" alt="Logo" width="100">
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTwo" aria-controls="navbarTwo" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse sub-menu-bar" id="navbarTwo">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="page-scroll" href="">Beranda</a>
                            </li>
                        </ul>
                    </div>

                    <div class="navbar-btn d-none d-sm-inline-block">
                        <ul>
                            @if (Auth::user())
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="solid" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                            Keluar
                                        </a>
                                    </form>
                                </li>
                            @else
                                <li><a class="solid" href="{{ route('login') }}">Masuk</a></li>
                                <li><a class="solid" href="{{ route('register') }}">Daftar</a></li>
                            @endif
                        </ul>
                    </div>
                </nav> <!-- navbar -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>
