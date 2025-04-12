@extends('welcome')

@section('content')
<!-- Hero Section -->
<section id="hero" class="hero section accent-background">

  <div class="container position-relative fade-in" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-5 justify-content-between">
      <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
        <h2><span>Welcome to </span><span class="accent">VoiceOfStudent</span></h2>
        <p>Ayo suarakan pendapatmu melalui website ini! Bersama, kita ciptakan lingkungan sekolah yang lebih nyaman dan menyenangkan. Sampaikan keluhan dan masukanmu demi perubahan yang lebih baik!</p>
        <div class="d-flex">
          <a href="{{route('user.keluhan.create')}}" class="btn-get-started">Ajukan</a>
          <a href="{{url('pengumuman')}}" class="glightbox btn-watch-video d-flex align-items-center">
            {{-- <i class="bi bi-play-circle"></i><span>Watch Video</span> --}}
          </a>
        </div>
      </div>
      <div class="col-lg-5 order-1 order-lg-2">
        <img src="{{asset('frontend/assets/img/siswa.png')}}" class="img-fluid fade-in" alt="">
      </div>
    </div>
  </div>

  <div class="icon-boxes position-relative" data-aos="fade-up" data-aos-delay="200">
    <div class="container position-relative">
      <div class="row gy-4 mt-5">

        <div class="col-xl-3 col-md-6 fade-in">
          <div class="icon-box text-center px-2">
            <div class="icon"><i class="bi bi-lightbulb"></i></div>
            <h5 class="title mb-1"><a href="#" class="stretched-link">Tips Keluhan</a></h5>
            <p class="small m-0">Gunakan bahasa sopan dan jelas.</p>
          </div>
        </div><!--End Icon Box -->

        <div class="col-xl-3 col-md-6 fade-in">
          <div class="icon-box text-center p-0">
             <img src="{{ asset('frontend/assets/img/school.jpg') }}" alt="Foto Sekolah" class="img-fluid rounded">
              <h4 class="title">Lingkungan Ramah</h4>
             <p style="font-size: 14px;">Bersama kita ciptakan sekolah yang aman dan ceria!</p>
          </div>
        </div><!--End Icon Box -->

        <div class="col-xl-3 col-md-6 fade-in">
          <div class="icon-box text-center p-0">
             <img src="{{ asset('frontend/assets/img/siswa diskusi.jpg') }}" alt="Foto Sekolah" class="img-fluid rounded">
              <h4 class="title">Suara Siswa</h4>
             <p style="font-size: 14px;">Setiap aspirasi kamu penting dan didengar!</p>
          </div>
        </div><!--End Icon Box -->

        <div class="col-xl-3 col-md-6 fade-in">
          <div class="icon-box text-center">
            <div class="icon"><i class="bi bi-telephone-fill"></i></div>
            <h4 class="title">Kontak Admin</h4>
            <p class="mb-1">📧 admin@vos.sch.id</p>
            <p class="mb-1">📞 0857-1234-5678</p>
            <p class="mb-0">🕐 08.00 - 15.00 WIB</p>
          </div>
        </div><!--End Icon Box -->

      </div>
    </div>
  </div>

</section><!-- /Hero Section -->

<style>
  /* Efek Fade In */
  .fade-in {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.8s ease-out, transform 0.8s ease-out;
  }

  .fade-in.visible {
    opacity: 1;
    transform: translateY(0);
  }

  /* Animasi Hover untuk Icon Box */
  .icon-box {
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
  }

  .icon-box:hover {
    transform: translateY(-10px);
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
  }

  /* Efek animasi pada tombol */
  .btn-get-started,
  .btn-watch-video {
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
  }

  .btn-get-started:hover {
    transform: scale(1.05);
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
  }

  .btn-watch-video:hover {
    transform: scale(1.05);
  }

  .icon-box p {
    color: #fff;
    font-size: 14px;
    margin-bottom: 0.3rem;
  }
</style>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const fadeElements = document.querySelectorAll(".fade-in");

    function checkScroll() {
      fadeElements.forEach((el) => {
        if (el.getBoundingClientRect().top < window.innerHeight - 100) {
          el.classList.add("visible");
        }
      });
    }

    window.addEventListener("scroll", checkScroll);
    checkScroll();
  });
</script>
@endsection
