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
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
  <title>Edit Profile Startups</title>
</head>
<body>

  <!-- Form start -->
  <div class="container py-5">
    <div class="form-card mx-auto p-4 p-md-5">
      <h2 class="fw-bold mb-3 text-center text-gradient">Edit Your Investor Profile</h2>
      <p class="text-center text-muted mb-4">Help entrepreneurs learn about you</p>
      <div class="d-flex justify-content-start mb-3">
    <a href="{{ route('backend.investor_dashboard') }}" class="" style="width: auto;">
        <i class="bi bi-arrow-left-circle me-1"></i> Back to Dashboard
    </a>
</div>
       @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
     <form id="startupForm" method="POST" action="{{ route('investor.profile.update') }}" enctype="multipart/form-data">
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
          <label class="form-label">Full Name</label>
          <input type="text" name="name" class="form-control" placeholder="Your Name" required value="{{ old('name', $profile->full_name) }}">
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="text" name="email" class="form-control" value="{{ old('email', $profile->email) }}">
        </div>
        <div class="mb-3">
      <label class="form-label">Phone Number</label>
      <input type="text" class="form-control" name="phone" placeholder="+123456789"value="{{ old('phone', $profile->phone) }}">
    </div>
        <div class="mb-3">
          <label class="form-label">Company Name</label>
          <input type="text" name="company" class="form-control" value="{{ old('company', $profile->company) }}">
        </div>

        <div class="mb-3">
          <label class="form-label">Website</label>
          <input type="text" name="website" class="form-control" placeholder="Web Address" value="{{ old('website', $profile->website) }}">
        </div>

       <div class="mb-3">
  <label class="form-label">Investment Sectors</label>
  <select id="investmentSectors" name="investment_sectors[]" multiple>
    <option value="technology">Technology</option>
    <option value="healthcare">Healthcare</option>
    <option value="finance">Finance</option>
    <option value="education">Education</option>
    <option value="retail">Retail</option>
  </select>
</div>
         <div class="mb-3">
      <label class="form-label">Short Bio / Description</label>
      <textarea class="form-control" name="bio" rows="3" placeholder="Tell us about your background, experience, and goals"></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Investment Range (Taka)</label>
      <input type="number" class="form-control" name="funding_range" placeholder="e.g. 50000 - 200000">
    </div>
        <div class="mb-3">
          <label class="form-label">Upload Profile Picture</label>
          <input type="file" name="profile_picture" class="form-control">
           @if($profile->profile_picture)
                <img src="{{ asset('storage/' . $profile->profile_picture) }}" width="80" class="mt-2">
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
  <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script>
  const choices = new Choices('#investmentSectors', {
    removeItemButton: true,
    placeholderValue: 'Select investment sectors',
    maxItemCount: 10,
    searchResultLimit: 5,
    renderChoiceLimit: 10
  });
</script>
  <script src="{{asset('backend/js/jquery-3.7.1.min.js')}}"></script>


</body>
</html>
