<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
  <ul class="navbar-nav mr-3">
    <li>
      <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
        <i class="fas fa-bars"></i>
      </a>
    </li>
    {{-- <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a> --}}
    </li>
  </ul>
  {{-- <div class="search-element">
      <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
      <button class="btn" type="submit"><i class="fas fa-search"></i></button>
      <div class="search-backdrop"></div>
      <div class="search-result">
        <div class="search-header">
          Histories
        </div>
        <div class="search-item">
          <a href="#">How to hack NASA using CSS</a>
          <a href="#" class="search-close"><i class="fas fa-times"></i></a>
        </div>
        <div class="search-item">
          <a href="#">Kodinger.com</a>
          <a href="#" class="search-close"><i class="fas fa-times"></i></a>
        </div>
        <div class="search-item">
          <a href="#">#Stisla</a>
          <a href="#" class="search-close"><i class="fas fa-times"></i></a>
        </div>
        <div class="search-header">
          Result
        </div>
        <div class="search-item">
          <a href="#">
            <img class="mr-3 rounded" width="30" src="../assets/img/products/product-3-50.png" alt="product">
            oPhone S9 Limited Edition
          </a>
        </div>
        <div class="search-item">
          <a href="#">
            <img class="mr-3 rounded" width="30" src="../assets/img/products/product-2-50.png" alt="product">
            Drone X2 New Gen-7
          </a>
        </div>
        <div class="search-item">
          <a href="#">
            <img class="mr-3 rounded" width="30" src="../assets/img/products/product-1-50.png" alt="product">
            Headphone Blitz
          </a>
        </div>
        <div class="search-header">
          Projects
        </div>
        <div class="search-item">
          <a href="#">
            <div class="search-icon bg-danger text-white mr-3">
              <i class="fas fa-code"></i>
            </div>
            Stisla Admin Template
          </a>
        </div>
        <div class="search-item">
          <a href="#">
            <div class="search-icon bg-primary text-white mr-3">
              <i class="fas fa-laptop"></i>
            </div>
            Create a new Homepage Design
          </a>
        </div>
      </div>
    </div> --}}
  <div class="form-inline mr-auto w-50">
    <img class="logoku" src="{{ $_logo_url }}" alt="{{ $_company_name }}">
    <h5 class="nama_perusahaan">
      {{ $_company_name }}
    </h5>
  </div>
  <ul class="navbar-nav navbar-right">
    {{-- <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Messages
                    <div class="float-right">
                        <a href="#">Mark All As Read</a>
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-message">
                    <a href="#" class="dropdown-item dropdown-item-unread">
                        <div class="dropdown-item-avatar">
                            <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle">
                            <div class="is-online"></div>
                        </div>
                        <div class="dropdown-item-desc">
                            <b>Kusnaedi</b>
                            <p>Hello, Bro!</p>
                            <div class="time">10 Hours Ago</div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item dropdown-item-unread">
                        <div class="dropdown-item-avatar">
                            <img alt="image" src="../assets/img/avatar/avatar-2.png" class="rounded-circle">
                        </div>
                        <div class="dropdown-item-desc">
                            <b>Dedik Sugiharto</b>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                            <div class="time">12 Hours Ago</div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item dropdown-item-unread">
                        <div class="dropdown-item-avatar">
                            <img alt="image" src="../assets/img/avatar/avatar-3.png" class="rounded-circle">
                            <div class="is-online"></div>
                        </div>
                        <div class="dropdown-item-desc">
                            <b>Agung Ardiansyah</b>
                            <p>Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            <div class="time">12 Hours Ago</div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <div class="dropdown-item-avatar">
                            <img alt="image" src="../assets/img/avatar/avatar-4.png" class="rounded-circle">
                        </div>
                        <div class="dropdown-item-desc">
                            <b>Ardian Rahardiansyah</b>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit ess</p>
                            <div class="time">16 Hours Ago</div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <div class="dropdown-item-avatar">
                            <img alt="image" src="../assets/img/avatar/avatar-5.png" class="rounded-circle">
                        </div>
                        <div class="dropdown-item-desc">
                            <b>Alfa Zulkarnain</b>
                            <p>Exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                            <div class="time">Yesterday</div>
                        </div>
                    </a>
                </div>
                <div class="dropdown-footer text-center">
                    <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </li> --}}
    {{-- @if (cekHakAkses('Notifikasi Lihat'))
      @php
        $_notifikasi = \App\Models\Notifikasi::take(10)
            ->where('user_id', Auth::id())
            ->whereNull('sudah_dibaca')
            ->get();
      @endphp
      <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
          class="nav-link notification-toggle nav-link-lg {{ $_notifikasi->count() ? 'beep' : '' }}"><i
            class="far fa-bell"></i></a>
        <div class="dropdown-menu dropdown-list dropdown-menu-right">
          <div class="dropdown-header">Notifikasi
            @if ($_notifikasi->count())
              <div class="float-right">
                <a href="{{ route('notifikasi.tandai_semua') }}">Tandai semua telah dibaca</a>
              </div>
            @endif
          </div>
          <div class="dropdown-list-content dropdown-list-icons">
            @if ($_notifikasi->count())
              @foreach ($_notifikasi as $_n)
                <a href="{{ route('notifikasi.set', ['sudah_dibaca', $_n->id]) }}" class="dropdown-item">
                  <div class="dropdown-item-icon bg-{{ $_n->bg }} text-white">
                    <i class="fas fa-{{ $_n->ikon }}"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    {{ $_n->notifikasi }}
                    <div class="time text-primary">{{ time_since($_n->created_at) }}</div>
                  </div>
                </a>
              @endforeach
            @else
              <a href="#" class="dropdown-item">
                Tidak ada notifikasi
              </a>
            @endif
          </div>
          <div class="dropdown-footer text-center">
            <a href="{{ route('notifikasi.index') }}" class="text-grey">Lihat Semua <i
                class="fas fa-chevron-right"></i></a>
          </div>
        </div>
      </li>
    @endif --}}

    {{-- @if (!config('developer.no_developer'))
      <li><a href="{{ route('tentang-aplikasi') }}" class="nav-link nav-link-lg"><i class="fa fa-info-circle"></i></a>
    @endif --}}

    @if (Auth::check())
      <li class="dropdown">
        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
          @if (Auth::user()->avatar)
            <img alt="avatar" src="{{ asset('avatar/'.Auth::user()->avatar.'')}}" class="rounded-circle mr-1">
          @else
            <figure class="avatar mr-2 bg-success text-white"
              data-initial="{{ \App\Helpers\StringHelper::acronym(Auth::user()->name, 2) }}"></figure>
          @endif
          <div class="d-sm-none d-lg-inline-block">{{ __('Hai') }}, {{ Auth::user()->name }}</div>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <div class="dropdown-title">{{ __('Waktu masuk') }}
            <br>{{ Auth::user()->last_login }}
          </div>

          <a href="{{ route('profile.index') }}" class="dropdown-item has-icon">
            <i class="far fa-user"></i> {{ __('Profil') }}
          </a>

          <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger">
            <i class="fas fa-sign-out-alt"></i> Keluar
          </a>
        </div>
      </li>
    @else
      <li class="dropdown">
        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">

          <img alt="" src="" class="rounded-circle mr-1">
          <div class="d-sm-none d-lg-inline-block">Hai, Guest</div>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <div class="dropdown-title">Waktu masuk <br>senin 12:pm</div>
          <a href="#" class="dropdown-item has-icon">
            <i class="far fa-user"></i> Profil
          </a>
          <a href="#" class="dropdown-item has-icon text-danger">
            <i class="fas fa-sign-out-alt"></i> Keluar
          </a>
        </div>
      </li>
    @endif
    </li>
  </ul>
</nav>
