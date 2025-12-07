<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="{{asset('backend/css/style.css')}}"/>
  <link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}"/>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <title>Edit Profile Startups</title>
</head>
<body>

  <!-- Form start -->
  <div class="container py-5">
    <div class="form-card mx-auto p-4 p-md-5">
      <h2 class="fw-bold mb-3 text-center text-gradient">Edit Your Entrepreneur Profile</h2>
      <p class="text-center text-muted mb-4">Help investors get to know your business</p>
      <div class="d-flex justify-content-start mb-3">
    <a href="{{ route('backend.startup_dashboard') }}" class="" style="width: auto;">
        <i class="bi bi-arrow-left-circle me-1"></i> Back to Dashboard
    </a>
</div>
       @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
     <form id="startupForm" method="POST" action="{{ route('startup.profile.update') }}" enctype="multipart/form-data">
      @csrf
      @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

        <div class="mb-3">
          <label class="form-label">Business Name</label>
          <input type="text" name="business_name" class="form-control" placeholder="Your Business Name" required value="{{ old('business_name', $profile->business_name) }}">
        </div>

        <div class="mb-3">
          <label class="form-label">Business Tagline</label>
          <input type="text" name="business_tagline" class="form-control" placeholder="e.g. Empowering ecommerce growth"value="{{ old('business_tagline', $profile->business_tagline) }}">
        </div>

        <div class="mb-3">
          <label class="form-label">Industry</label>
          <select name="industry" class="form-select" required >
            <option value="{{ old('industry', $profile->industry) }}">Select Industry</option>
            <option>Technology</option>
            <option>Healthcare</option>
            <option>Finance</option>
            <option>Education</option>
            <option>Retail</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Business Website</label>
          <input type="url" name="website" class="form-control" placeholder="https://yourbusiness.com" value="{{ old('website', $profile->website) }}">
        </div>

        <div class="mb-3">
          <label class="form-label">Business Description</label>
          <textarea name="description" class="form-control" rows="4" placeholder="Tell us about your business..." required >{{ old('description', $profile->description) }}</textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Owner Name</label>
          <input type="text" name="owner_name" class="form-control" placeholder="Name of the business holder" value="{{ old('owner_name', $profile->owner_name) }}">
        </div>

        <div class="mb-3">
          <label class="form-label">Upload Business Logo</label>
          <input type="file" name="logo" class="form-control">
           @if($profile->logo)
                <img src="{{ asset('storage/' . $profile->logo) }}" width="80" class="mt-2">
            @endif
        </div>
       

  <div class="mb-3">
          <label class="form-label">Upload Tax Payment Receipt(pdf/docs/jpg)</label>
        <input type="file" name="tax_receipt" class="form-control">
          @if($profile->tax_receipt)
                <a href="{{ asset('storage/' . $profile->tax_receipt) }}" target="_blank" class="d-block mt-2">View Uploaded Receipt</a>
            @endif
        </div>
        <div class="text-center">
          <button type="submit" class=" btn-gradients mt-2 ">Update Profile</button>
        </div>
      </form>
    </div>
  </div>
  <!-- Form end -->

  <!-- JS -->
  <script src="{{asset('backend/js/jquery-3.7.1.min.js')}}"></script>


</body>
</html>
