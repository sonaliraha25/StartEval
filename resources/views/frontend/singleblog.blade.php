<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <title>StartEval Blog</title>
</head>
<body >

  <!-- menu part start here -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container">
        <img src="{{ asset('frontend/image/logo.png') }}" class="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav m-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="{{ url('/') }}">Home</a>
            </li>
           <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Services
              </a>
              <ul class="dropdown-menu">
                 <li><a class="dropdown-item" href="#newsletter">Newsletter</a></li>
                  <li><a class="dropdown-item" href="{{url('/register')}}">Find Investors</a></li>
                   <li><a class="dropdown-item" href="{{url('/register')}}">Potential Startups</a></li>
                <li><a class="dropdown-item" href="{{ url('/contact') }}">Contact Us</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link"href="{{ url('/blog') }}" >Blog</a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="{{ url('/contact') }}" >Contact Us</a>
            </li>
          </ul>
            <button class="btn sign" type="submit"><a href="{{url('/login')}}">Sign in</a></button>
            <button class="btn reg" type="submit"><a href="{{url('/register')}}">Get Started!</a></button>
        </div>
      </div>
    </nav>
   <!-- menu part end here  -->
    <!-- Main Blog Content -->
<main class="container my-5 animate-fade-in-up">
  <article class="startup-card" style="padding-top: 100px;">
    <!-- Post Header -->
    <header class="mb-4 text-center">
      <h1 class="section-title">{{ $blog->title }}</h1>   
      <p class="text-muted">
        <time datetime="{{ $blog->posted_at->toDateString() }}">
          {{ $blog->posted_at->format('F j, Y') }}
        </time>
       
      </p>
    </header>

    <!-- Featured Image -->
   <div class="mb-4 d-flex align-items-center justify-content-center">
    <img src="{{ asset('storage/' . $blog->image) }}"
         alt="{{ $blog->title }}"
         class="img-fluid rounded-lg shadow">
</div>


    <!-- Post Body -->
    <div class="description fs-5 lh-lg text-center">
      {!! $blog->long_description !!}
    </div>

    <!-- Post Footer -->
    <footer class="mt-5 d-flex justify-content-between align-items-center border-top pt-3">
      <a href="{{ url('/blog') }}" class="btn btn-outline-primary">
        ← Back to Blog
      </a>
      <div class="text-muted small">
        Written by <strong></strong>
        Admin
      </div>
    </footer>
  </article>
</main>






 <section id="footer">
  <div class="container reveal">
    <div class="row gy-4 pb-3">
      <!-- Brand / intro -->
      <div class="col-12 col-lg-6">
        <img src="{{asset('frontend/image/logo-50.png')}}" alt="StartEval logo" width="50" height="50">
        <h2 class="footerhead">StartEval</h2>
        <p class="footerlight">
          Discover profitable SaaS and local eCommerce businesses seeking smart investors like you.
        </p>
        <div class="footer-social">
          <i class="fa-brands fa-facebook"></i>
          <i class="fa-brands fa-youtube"></i>
          <i class="fa-brands fa-twitter"></i>
          <i class="fa-brands fa-instagram"></i>
          <i class="fa-brands fa-linkedin"></i>
        </div>
      </div>

      <!-- Company links -->
      <div class="col-6 col-md-4 col-lg-2 footerpart">
        <h3>Company</h3>
        <a href="{{url('/')}}">Home</a>
        <a href="#features">Features</a>
        <a href="#">Pricing</a>
        <a href="#">Solutions</a>
        <a href="#aboutus">About us</a>
      </div>

      <!-- Resources links -->
      <div class="col-6 col-md-4 col-lg-2 footerpart">
        <h3>Resources</h3>
        <a href="#">FAQ</a>
        <a href="#">Blog</a>
        <a href="#">Help Center</a>
        <a href="#">Privacy Policy</a>
        <a href="#">Career</a>
      </div>

      <!-- Contact info -->
      <div class="col-12 col-md-4 col-lg-2 footerpart3">
        <h3>Contact</h3>
        <h4>Email</h4>
        <a href="mailto:rahaaktherdev@gmail.com">rahaaktherdev@gmail.com</a>
        <h4>Phone</h4>
        <a href="tel:+8801710938903">+880 1710938903</a>
        <h4>Office Address</h4>
        <a href="#">63/2 road Lalbag, Dhaka</a>
      </div>
    </div>

    <!-- Bottom line -->
    <div class="row mt-4 pt-3 border-top border-secondary-subtle">
      <div class="col-12 text-center">
        <p class="reserved mb-0">
          <i class="fa-solid fa-copyright"></i>
          All rights reserved to StartEval
        </p>
      </div>
    </div>
  </div>
</section>
   <script src="{{ asset('frontend/js/script.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-3.7.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
</body>
</html>