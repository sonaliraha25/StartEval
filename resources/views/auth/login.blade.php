<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
     <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <title>Sign In</title>
    <style>
        .loginlabel{
            margin-top: 10px;
            margin-bottom: 5px;
        }
        .form-control{
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .signup{
            padding-top: 8px;
            padding-bottom: 8px;
            margin-top: 15px;
        }
        .already{
            margin-top: 15px;
        }
      /* Fake reCAPTCHA container */
.fake-recaptcha {
    max-width: 340px;
    border: 1px solid #d3d3d3;
    border-radius: 3px;
    background: #f9f9f9;
    padding: 18px 14px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 1px 1px rgba(0,0,0,0.2);
    font-family: "Manrope", sans-serif;
}

/* Left side: checkbox + text */
.fake-recaptcha-inner {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    user-select: none;
    color: #555;
    font-size: 14px;
    font-weight: 500;
    position: relative;
    padding-left: 0;
}

/* Hide real checkbox */
.fake-recaptcha-inner input[type="checkbox"] {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Custom box */
.fake-recaptcha-checkbox {
    width: 22px;
    height: 22px;
    border-radius: 2px;
    border: 2px solid #c1c1c1;
    background: #fff;
    box-sizing: border-box;
    position: relative;
    transition: all 0.15s ease-in-out;
}

/* Hover effect */
.fake-recaptcha-inner:hover .fake-recaptcha-checkbox {
    border-color: #3c7eea;
}

/* Tick icon */
.fake-recaptcha-checkbox::after {
    content: "";
    position: absolute;
    display: none;
    left: 6px;
    top: 2px;
    width: 6px;
    height: 12px;
    border: solid #fff;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

/* Checked state */
.fake-recaptcha-inner input:checked ~ .fake-recaptcha-checkbox {
    background: #3c7eea;
    border-color: #3c7eea;
    box-shadow: 0 0 3px rgba(60, 126, 234, 0.7);
}

.fake-recaptcha-inner input:checked ~ .fake-recaptcha-checkbox::after {
    display: block;
}

/* Text */
.fake-recaptcha-text {
    font-size: 14px;
    color: #444;
}

/* Right side “brand” area */
.fake-recaptcha-brand {
    display: flex;
    align-items: center;
    gap: 6px;
    color: #777;
}

.fake-recaptcha-brand i {
    font-size: 26px;
    color: #3c7eea;
}

.fake-recaptcha-brand-text {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    line-height: 1.1;
}

.fake-recaptcha-brand-text span {
    font-size: 11px;
}

.fake-recaptcha-brand-text small {
    font-size: 9px;
    color: #999;
}


    </style>
</head>
<body>
<div class="login-container">
  <!-- Left -->
  <div class="login-left">
    <img src="{{asset('frontend/image/logino.png')}}" alt="StartEval Logo" height="30px" width="120px" >
    <h2 class="loginheading">Welcome to StartEval</h2>
  <form method="POST" action="{{ route('login') }}">
  @csrf
    <label class="loginlabel">Email</label>
  <input type="email" class="form-control mb-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">
      @error('email')
      <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
      </span>
     @enderror
  <label class="loginlabel">Password</label>
  <input type="password" class="form-control mb-3 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
     @error('password')
     <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
     </span>
     @enderror
      @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
 <div class="fake-recaptcha my-2">
    <label class="fake-recaptcha-inner mb-0">
        <input type="checkbox"
               id="human_check"
               name="human_check"
               value="1"
               {{ old('human_check') ? 'checked' : '' }}>
        <span class="fake-recaptcha-checkbox"></span>
        <span class="fake-recaptcha-text">I'm not a robot</span>
    </label>

    <div class="fake-recaptcha-brand">
        <i class="fa-solid fa-shield-halved"></i>
        <div class="fake-recaptcha-brand-text">
            <span>Security Check</span>
            <small>Privacy · Terms</small>
        </div>
    </div>
</div>

@error('human_check')
    <div class="text-danger" style="font-size: 13px; margin-top: 4px;">
        {{ $message }}
    </div>
@enderror
                              
  <button class="btn btn-primary w-100 signup"type="submit" >Login</button>
</form>
<p class="already">Don't have any account? <u><a href="{{url('/register')}}">Register</a></u></p>
  </div>

  <!-- Right -->
  <div class="login-right">
    <!-- Placeholder for charts/graphs -->
   <div class="chart-container">
  <!-- Main chart image -->
  <img src="{{asset('frontend/image/graphlogin.png')}}" class="main-chart" alt="Main Chart">

  <!-- Overlay cards -->
  <div class="overlay-card card-top-left">
    <img src="{{asset('frontend/image/shopify.png')}}" class="img-fluid rounded" alt="Shopify App">
  </div>
  <div class="overlay-card card-top-right">
    <img src="{{asset('frontend/image/rightup.png')}}" class="img-fluid rounded" alt="Revenue">
  </div>
  <div class="overlay-card card-bottom-left">
    <img src="{{asset('frontend/image/total.png')}}" class="img-fluid rounded" alt="Line Chart">
  </div>
  <div class="overlay-card card-bottom-right">
    <img src="{{asset('frontend/image/leftbottom.png')}}" class="img-fluid rounded" alt="Listings">
  </div>
</div>
</div>
<script>
document.querySelector("form").addEventListener("submit", function(e) {
    let checkbox = document.getElementById("human_check");

    if (!checkbox.checked) {
        e.preventDefault(); // stop form submission
        alert("Please confirm you are not a robot before logging in.");
    }
});
</script>
 <script src="{{ asset('frontend/js/script.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-3.7.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
</body>
</html>
 