<header id="header" class="header">

  {{-- <div class="topbar d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
      </div>
    </div>
  </div><!-- End Top Bar --> --}}

  <div class="branding d-flex align-items-cente">

    <div class="container position-relative d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Vos</h1>
        <span>.</span>
      </a>

     <nav id="navmenu" class="navmenu">
  <ul>
    <li><a href="{{url('/')}}" class="active">Home<br></a></li>
    <li><a href="{{url('pengumuman')}}">Pengumuman</a></li>
    <li><a href="{{url('departemen')}}">Departemen</a></li>
    <li><a href="{{url('keluhan')}}">Keluhan</a></li>
    {{-- <li><a href="blog.html">Blog</a></li> --}}
    <li>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-link nav-link" style="padding: 0; border: none; background: none; color: white;">
          Logout
        </button>
      </form>
    </li>
  </ul>
  <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>


    </div>

  </div>

</header>
