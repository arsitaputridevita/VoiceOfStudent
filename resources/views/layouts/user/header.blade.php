<header id="header" class="header">

  <div class="branding d-flex align-items-center">
    <div class="container position-relative d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Vos</h1>
        <span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ url('/') }}" class="active">Home<br></a></li>
          <li><a href="{{ url('pengumuman') }}">Pengumuman</a></li>
          <li><a href="{{ url('departemen') }}">Departemen</a></li>
          <li><a href="{{ url('keluhan') }}">Keluhan</a></li>
          {{-- <li><a href="blog.html">Blog</a></li> --}}

          @auth
          <!-- Profile Dropdown untuk user yang login -->
          <li class="dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              Profile
            </a>
            <ul class="dropdown-menu" aria-labelledby="profileDropdown">
              <li><a class="dropdown-item" href="#">Name: {{ Auth::user()->name }}</a></li>
              <li><a class="dropdown-item" href="#">Email: {{ Auth::user()->email }}</a></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item" style="border: none; background: none; color: inherit;">
                    Logout
                  </button>
                </form>
              </li>
            </ul>
          </li>
          @endauth

          @guest
          <!-- Link login jika belum login -->
          <li><a href="{{ route('login') }}">Login</a></li>
          @endguest

        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </div>
</header>
