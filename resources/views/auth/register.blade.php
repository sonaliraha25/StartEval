<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
     <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css') }}">
    <title>Sign Up</title>
</head>
<body>

<div class="login-container">
  <!-- Left -->
  <div class="login-left">
    <img src="{{ asset('frontend/image/logino.png')}}" alt="StartEval Logo" height="30px" width="120px" >
    <h2 class="loginheading">Welcome to StartEval</h2>
 <form method="POST" action="{{ route('register') }}">
                        @csrf
  <label class="loginlabel">Name</label>
  <input type="text" class="form-control mb-3 @error('name')is-invalid @enderror" placeholder="Full Name" required name="name" value="{{ old('name') }}"  autocomplete="name">
   @error('name')
   <span class="invalid-feedback" role="alert">
     <strong>{{ $message }}</strong>
     </span>
  @enderror
    <label class="loginlabel">Email</label>
  <input type="email" class="form-control mb-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email"placeholder="Email Address" required>
     @error('email')
      <span class="invalid-feedback" role="alert">
       <strong>{{ $message }}</strong>
         </span>
     @enderror
  <label class="loginlabel">Password</label>
  <input type="password" class="form-control mb-3 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
     @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
   <label class="loginlabel">Confirm Password</label>
  <input type="password" class="form-control mb-3" name="password_confirmation" required autocomplete="new-password">
  <label class="loginlabel">Account Type</label>
  <select class="form-select mb-3" required name="account_type">
    <option value="">Select account type</option>
     <option value="startup">Entrepreneur</option>
    <option value="investor">Investor</option>
  </select>

  <!-- Dynamic fields can go here -->

  <div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" id="terms" required>
    <label class="form-check-label" for="terms">
      I agree to the Terms & Conditions
    </label>
  </div>

  <button class="btn btn-primary w-100 signup">Register</button>
</form>
<p class="already">Already have an account?<u><a href="{{url('/login')}}">Log in</a></u></p>
  </div>

  <!-- Right -->
  <div class="login-right">
    <!-- Placeholder for charts/graphs -->
   <div class="chart-container">
  <!-- Main chart image -->
  <img src=" {{ asset('frontend/image/graphlogin.png')}}" class="main-chart" alt="Main Chart">
  <!-- Overlay cards -->
  <div class="overlay-card card-top-left">
    <img src=" {{ asset('frontend/image/shopify.png')}}" class="img-fluid rounded" alt="Shopify App">
  </div>
  <div class="overlay-card card-top-right"> 
    <img src="{{ asset('frontend/image/rightup.png')}}" class="img-fluid rounded" alt="Revenue">
  </div>
  <div class="overlay-card card-bottom-left">
    <img src="{{ asset('frontend/image/total.png')}}" class="img-fluid rounded" alt="Line Chart">
  </div>
  <div class="overlay-card card-bottom-right">
    <img src="{{ asset('frontend/image/leftbottom.png')}}" class="img-fluid rounded" alt="Listings">
  </div>
</div>
</div>
<script src="{{ asset('frontend/js/script.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-3.7.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
</body>
</html>
