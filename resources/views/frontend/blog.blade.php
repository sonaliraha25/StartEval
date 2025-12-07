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
<body>

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


  <!-- Hero Section -->
  <div class="hero">
    <h1 class="display-4">Welcome to Our Investor Blog</h1>
    <p class="lead">Business news, funding updates, and insights for investors</p>
    <a href="{{ url('/contact') }}" class="btn btn-light btn-lg mt-3">Contact Us</a>
  </div>
   <div class="container text-center my-5">
    <div class="row g-4">
        <h2 class="heading">Our Impact So Far</h2>
        <p class="light">Proudly showcasing our growth and achievements in the investor community</p>
      <div class="col-md-4">
        <div class="counter" id="counter1">0</div>
        <p>Investors Joined</p>
      </div>
      <div class="col-md-4">
        <div class="counter" id="counter2">0</div>
        <p>Projects Funded</p>
      </div>
      <div class="col-md-4">
        <div class="counter" id="counter3">0</div>
        <p>USD Raised</p>
      </div>
    </div>
  </div>
  <!-- Blog / News Section -->
 <section id="news">
<div class="container reveal">
     <div class="row">
        @foreach($blogs as $blog)
            <div class="col col-lg-4">
    <div class="card">
        <img src="{{ asset('storage/' . $blog->image) }}" height="225px" width="100%" class="articlepic">

        <div class="card-body">
            <h2 class="articleheading">{{ $blog->title }}</h2>
            <p>
                {{ Str::limit($blog->short_description, 100) }}
                <span id="dots">...</span>
            </p>
            <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-primary">Read more</a>
            <p class="small mt-2">{{ $blog->created_at->diffForHumans() }}</p>
        </div>
    </div>
</div>
        @endforeach
    </div>
  
  </div>
</div>
</section>

    </div>
  </div>

  <!-- Modals for full content -->
  <div class="modal fade" id="modal1" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Startup Secures $5M</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p>The fintech startup XYZ has successfully secured $5 million in its latest funding round led by top venture capital firms. This funding will be used to expand operations into new markets, invest in product development, and hire key personnel. Investors are optimistic about the company's potential to disrupt traditional financial services with its innovative platform.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Testimonials -->
  <div class="container my-5 reveal">
    <h2 class="text-center mb-4 heading">What Our Investors Say</h2>
    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner text-center">
        <div class="carousel-item active">
          <p class="lead">"An incredible opportunity that I’m proud to support!"</p>
          <small>- Investor A</small>
        </div>
        <div class="carousel-item">
          <p class="lead">"Transparent, professional, and impactful."</p>
          <small>- Investor B</small>
        </div>
        <div class="carousel-item">
          <p class="lead">"Their vision convinced me to be part of the journey."</p>
          <small>- Investor C</small>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  </div>


  <!-- Footer -->
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

  <!-- Bootstrap JS -->
<script src="{{ asset('frontend/js/script.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-3.7.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
  <script>
    // Counter animation
    function animateCounter(id, end, duration) {
      let start = 0;
      const stepTime = Math.abs(Math.floor(duration / end));
      const obj = document.getElementById(id);
      const timer = setInterval(() => {
        start++;
        obj.innerText = start;
        if (start === end) clearInterval(timer);
      }, stepTime);
    }
    window.onload = function() {
      animateCounter("counter1", 120, 1500);
      animateCounter("counter2", 45, 1500);
      animateCounter("counter3", 1000000, 2000);
    }
  </script>
</body>
</html>
