<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Investor Profile</title>
  <link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}">
   <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="{{asset('backend/css/style.css')}}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<style>
   body {
      font-family: "Manrope", sans-serif;
    }
</style>

</head>
<body>
<div class="form-container">
  <h2 class="form-title text-center">Edit Your Investor Profile</h2>
  <p class="form-subtitle text-center">Help entrepreneurs learn about you</p>

  <form action="{{ route('investor.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label class="form-label">Full Name</label>
      <input type="text" class="form-control" name="name" placeholder="Your Name">
    </div>

    <div class="mb-3">
      <label class="form-label">Email Address</label>
      <input type="email" class="form-control" name="email" placeholder="you@example.com">
    </div>

    <div class="mb-3">
      <label class="form-label">Phone Number</label>
      <input type="text" class="form-control" name="phone" placeholder="+123456789">
    </div>

    <div class="mb-3">
      <label class="form-label">Company Name</label>
      <input type="text" class="form-control" name="company" placeholder="Investor Capital Ltd.">
    </div>

    <div class="mb-3">
      <label class="form-label">Website</label>
      <input type="url" class="form-control" name="website" placeholder="https://yourwebsite.com">
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
      <label class="form-label">Upload Your Logo or Photo</label>
      <input class="form-control" type="file" name="profile_picture">
    </div>

    <button type="submit" class="btn btn-gradient mt-4">Submit & Go to Dashboard</button>
  </form>
</div>

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
</body>
</html>
