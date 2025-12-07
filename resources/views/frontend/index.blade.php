<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
     <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <title>StartEval</title>
</head>
<body class=" m-0 border-0">
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

  <!-- Banner part start here  -->
   <section id="banner_part">
   <div class="bannerpartt w-auto ">
    <div class="container">
    <div class="row">
      <div class="col col-6 m-auto onlinepart">
         <p><span>&bull;StartEval</span>Fuel the future of business by backing it today.</p>
      </div>
    </div>
    <div class="row">
      <div class="col col-lg-7 m-auto heading">
         <h1>Invest in Real Businesses with Real Returns</h1>
      </div>
    </div>
     <div class="row">
      <div class="col col-lg-5 m-auto dis ">
         <p>Discover profitable SaaS and local eCommerce businesses seeking smart investors like you.</p>
          <button class="btn reg2" type="submit"><a href="{{url('/register')}}">Get Started!</a></button> <button class="btn itwork" type="submit"><a href="#features">How it works</a></button>
      </div>
    </div>
    <img src="{{ asset('frontend/image/bv.png') }}" class="bv">
     <img src="{{ asset('frontend/image/download.png') }}" class="bv2">
  </div>
   </div>
   </section>
   <!-- Banner part end here  -->
    <!-- About us part start here  -->
<section id="aboutus">
  <div class="container reveal">
    <div class="row">
      <div class="col col-lg-2 m-auto">
         <p class="about"><span>&bull;StartEval</span>About Us</p>
      </div>
    </div>
    <div class="row">
      <div class="col col-lg-9 m-auto">
        <p class="at">At StartEval, we are redefining how investors discover and support promising digital businesses. Our platform connects forward-thinking investors with curated SaaS and local eCommerce ventures—making business investment simple, transparent, and accessible.</p>
      </div>
    </div>
    <div class="row">
      <div class="col col-lg-9 m-auto">
        <p class="atlight">Founded with the mission to democratize private investing, StartEval empowers individuals to back real businesses with real growth potential. Whether you're a first-time investor or an experienced operator, our tools and insights help you invest with confidence and clarity.</p>
      </div>
    </div>
  </div>
</section>
     <!-- Aboutus part end here  -->
<!-- features part start here  -->
<section id="features">
  <div class="container reveal">
    <div class="features">
      <div class="row">
      <div class="col col-lg-3 m-auto">
         <p class=" investors"><span>&bull;StartEval</span>Built for modern investors</p>
      </div>
      <h2>What You Get with StartEval</h2>
      </div>
      <div class="row">
         <div class="col col-lg-4 m-auto">
           <p>StartEval is packed with features designed to simplify investing in real businesses. From detailed business profiles and financial transparency to direct founder messaging and built-in legal tools.</p>
         </div>
      </div>
      <div class="row">
        <div class="col col-lg-5 m-auto detail">
           <a href="#featureimg">Detail Features</a>
          </div>
      </div>
    </div>
      <section id="featureimg">
        <div class="row">
        <div class="col col-lg-7">
           <div class="firstbox">
            <img src="{{ asset('frontend/image/Total Revenue2.jpg') }}" width="300px" height="300px" class="img1">
            <img src="{{ asset('frontend/image/Sales Overview.jpg') }}"  height="300px" class="img2">
           </div>
            <div class="firstboxunderline">
             <h4>Real-Time Sales & Revenue Monitoring</h4>
            <p>Track real-time sales and revenue with clean, visual graphs. <i class="fa-solid fa-arrow-right"></i></p>
           </div>
        </div>
        <div class="col col-lg-5">
           <div class="secondbox">
            <img src="{{ asset('frontend/image/group.png') }}"  height="300px" class="img3" width="400px">
           </div>
           <div class="secondboxline">
             <h3 class="listing">Listings, Revenue & Engagement</h3>
            <p>See up-to-date stats on views, revenue, and listing  <i class="fa-solid fa-arrow-right"></i></p>
           </div>
        </div>
      </div>
      <!-- second part of feature part  -->
      <!-- <div class="row secondpart">
             <div class="col col-lg-6">
           <div class="secondbox w-auto">
            <img src="image/shopify.jpg"  height="300px" class="img5" width="100%">
           </div>
           <div class="secondboxline">
             <h3 class="listing">Verified & Legitimate Businesses</h3>
            <p>Chose from only vetted, trustworthy businesses  <i class="fa-solid fa-arrow-right"></i></p>
           </div>
        </div>
          <div class="col col-lg-6">
           <div class="firstbox">
            <img src="image/connect.png" width="100%"  class="img4">
           
           </div>
            <div class="firstboxunderline">
             <h4>Integrations with Third-Party Apps</h4>
            <p>Seamlessly connect with Slack, Google Drive, Notion, and more.<i class="fa-solid fa-arrow-right"></i></p>
           </div>
        </div>
          </div> -->
      </div>
      </section>
    </div>
</section>
 <!-- features part end here  -->
<!-- find answer to your question part start here -->
 <section id="qandapart">
 <div class="container reveal">
  <div class="row">
      <div class="col col-lg-3 m-auto">
         <p class="needtoknow"><span>&bull;StartEval</span>Everything You Need to Know</p>
      </div>
      </div>
      <div class="row">
        <div class="col col-lg-4 m-auto">
            <h2 class="heading">Find Answers to Your Questions</h2>
            <p class="light">Browse common questions about TomoSaaS. Need more help? Contact our support team anytime.</p>
        </div>
      </div>
    <div class="row g-4">
      <!-- Left Column -->
      <div class="col-md-6">
        <div class="accordion" id="faqLeft">
          <div class="accordion-item">
            <h2 class="accordion-header" id="q1">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a1">
                What is StartEval?
              </button>
            </h2>
            <div id="a1" class="accordion-collapse collapse" data-bs-parent="#faqLeft">
              <div class="accordion-body">
                StartEval is an all-in-one task management and team collaboration platform designed to help individuals and organizations streamline their workflow, manage projects effectively, and boost overall productivity...
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="q2">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a2">
                Does StartEval integrate with other tools?
              </button>
            </h2>
            <div id="a2" class="accordion-collapse collapse" data-bs-parent="#faqLeft">
              <div class="accordion-body">
                Yes, StartEval integrates with popular third-party tools.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="q3">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a3">
                Security & Data Privacy
              </button>
            </h2>
            <div id="a3" class="accordion-collapse collapse" data-bs-parent="#faqLeft">
              <div class="accordion-body">
                Your data is encrypted and stored securely with regular audits.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="q4">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a4">
                Support & Assistance
              </button>
            </h2>
            <div id="a4" class="accordion-collapse collapse" data-bs-parent="#faqLeft">
              <div class="accordion-body">
                24/7 support is available via chat, email, and phone.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="q5">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a5">
                Can I cancel my subscription anytime?
              </button>
            </h2>
            <div id="a5" class="accordion-collapse collapse" data-bs-parent="#faqLeft">
              <div class="accordion-body">
                Yes, you can cancel at any time from your account settings.
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Column -->
      <div class="col-md-6">
        <div class="accordion" id="faqRight">
          <div class="accordion-item">
            <h2 class="accordion-header" id="q6">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a6">
                Can I use StartEval for personal task management?
              </button>
            </h2>
            <div id="a6" class="accordion-collapse collapse" data-bs-parent="#faqRight">
              <div class="accordion-body">
                Yes, StartEval works great for individuals managing personal goals.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="q7">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a7">
                How does StartEval help improve team productivity?
              </button>
            </h2>
            <div id="a7" class="accordion-collapse collapse" data-bs-parent="#faqRight">
              <div class="accordion-body">
                It allows team members to collaborate, delegate tasks, and monitor progress efficiently.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="q8">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a8">
                Is there a free trial for premium features?
              </button>
            </h2>
            <div id="a8" class="accordion-collapse collapse" data-bs-parent="#faqRight">
              <div class="accordion-body">
                Yes, a 14-day free trial is available with no credit card required.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="q10">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a10">
                Can I request a demo before signing up?
              </button>
            </h2>
            <div id="a10" class="accordion-collapse collapse" data-bs-parent="#faqRight">
              <div class="accordion-body">
                Absolutely! Contact us to schedule a live demo with our team.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 </section>
<!-- find answer to your question part end here -->
 <!-- latest articles part start here  -->
<section id="article">
<div class="container reveal">
   <div class="row">
      <div class="col col-lg-3 m-auto">
         <p class="needtoknow"><span>&bull;StartEval</span>Latest Articles</p>
      </div>
      </div>
      <div class="row">
        <div class="col col-lg-4 m-auto">
            <h2 class="heading">Recent News and Articles</h2>
            <p class="light">Browse recent news on business and investment.</p>
        </div>
      </div>
  <div class="row">
 @foreach($recentBlogs as $blog)
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
 <!-- latest article part end here  -->
  <!-- Newsletter part start here  -->
 <section id="newsletter">
  <div class="container reveal">
    <div class="row">
     <div class="col col-lg-3 m-auto">
         <p class="needtoknow"><span>&bull;StartEval</span>Stay Informed, Stay Inspired</p>
      </div>
      </div>
      <div class="row">
        <div class="col col-lg-5 m-auto">
            <h2 class="heading">Stay Ahead with Our Newsletter!</h2>
            <p class="light">Get the latest updates, expert tips, and exclusive insights delivered right to your inbox. Whether you're interested in digital design, fintech trends, or the world of crypto trading, our newsletter has something for everyone.</p>
        </div>
      </div>
      <div class="row">
        <div class="col col-lg-4 m-auto">
          <form class="newsf">
           <input type="email" placeholder="Email" class="in">
           <button type="submit" class="join">Join Newsletter</button>
          </form>
        </div>
      </div>
  </div>
 </section>  
   <!-- Newsletter part end here  -->
  <!-- footer part start here  -->

  <!-- footer part end here  -->
 <!-- ===== Footer ===== -->
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