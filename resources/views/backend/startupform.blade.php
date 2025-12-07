<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="{{asset('backend/css/style.css')}}"/>
  <link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}"/>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <title>Edit Profile Startups</title>
</head>
<body>

  <!-- Form start -->
  <div class="container py-5">
    <div class="form-card mx-auto p-4 p-md-5">
      <h2 class="fw-bold mb-3 text-center text-gradient">Set Up Your Entrepreneur Profile</h2>
      <p class="text-center text-muted mb-4">Help investors get to know your business</p>

     <form id="startupForm" method="POST" action="{{ route('startup.store') }}" enctype="multipart/form-data">
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
          <input type="text" name="business_name" class="form-control" placeholder="Your Business Name" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Business Tagline</label>
          <input type="text" name="business_tagline" class="form-control" placeholder="e.g. Empowering ecommerce growth">
        </div>

        <div class="mb-3">
          <label class="form-label">Industry</label>
          <select name="industry" class="form-select" required>
            <option value="">Select Industry</option>
            <option>Technology</option>
            <option>Healthcare</option>
            <option>Finance</option>
            <option>Education</option>
            <option>Retail</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Business Website</label>
          <input type="url" name="website" class="form-control" placeholder="https://yourbusiness.com">
        </div>

        <div class="mb-3">
          <label class="form-label">Business Description</label>
          <textarea name="description" class="form-control" rows="4" placeholder="Tell us about your business..." required></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Owner Name</label>
          <input type="text" name="owner_name" class="form-control" placeholder="Name of the business holder">
        </div>

        <div class="mb-3">
          <label class="form-label">Upload Business Logo</label>
          <input type="file" name="logo" class="form-control">
        </div>
        <!-- Yearly Revenue Section -->
<div class="mb-3">
  <label class="form-label">Yearly Revenue Data</label>
  
  <!-- Wrapper for dynamic fields -->
   <div id="revenueFields">
    <div class="revenueRow d-flex gap-2 align-items-center mb-2">
      <select name="revenue_month[]" class="form-select" required>
        <option value="">Month</option>
        @foreach(['January','February','March','April','May','June','July','August','September','October','November','December'] as $i => $month)
          <option value="{{ $i + 1 }}">{{ $month }}</option>
        @endforeach
      </select>

      <select name="revenue_year[]" class="form-select" required>
        <option value="">Year</option>
        @for ($y = date('Y'); $y >= 2000; $y--)
          <option value="{{ $y }}">{{ $y }}</option>
        @endfor
      </select>

      <input type="number" name="revenue_amount[]" class="form-control" placeholder="Amount Tk" required>
    </div>
  </div>

  <!-- Button to add more -->
  <button type="button" onclick="addRevenueRow()" class="buttonaddanother mt-2">+ Add Another</button>
</div>
<div class="mb-3">
  <label class="form-label">Sales Overview Data</label>

  <div id="salesFields">
    <div class="salesRow d-flex gap-2 align-items-center mb-2">
      <select name="sales_month[]" class="form-select" required>
        <option value="">Month</option>
        @foreach(['January','February','March','April','May','June','July','August','September','October','November','December'] as $i => $month)
          <option value="{{ $i + 1 }}">{{ $month }}</option>
        @endforeach
      </select>

      <select name="sales_year[]" class="form-select" required>
        <option value="">Year</option>
        @for ($y = date('Y'); $y >= 2000; $y--)
          <option value="{{ $y }}">{{ $y }}</option>
        @endfor
      </select>

      <input type="number" name="sales_amount[]" class="form-control" placeholder="Sales Amount" required>
    </div>
  </div>

  <button type="button" onclick="addSalesRow()" class="buttonaddanother mt-2">+ Add Another</button>
</div>

  <div class="mb-3">
          <label class="form-label">Upload Tax Payment Receipt(pdf/docs/jpg)</label>
        <input type="file" name="tax_receipt" class="form-control">
        </div>
        <div class="text-center">
          <button type="submit" class=" btn-gradients mt-2">Submit & Go to Dashboard</button>
        </div>
      </form>
    </div>
  </div>
  <!-- Form end -->

  <!-- JS -->
  <script src="{{asset('backend/js/jquery-3.7.1.min.js')}}"></script>
<script>
  function addRevenueRow() {
    const container = document.getElementById('revenueFields');
    const newRow = document.createElement('div');
    newRow.className = 'revenueRow d-flex gap-2 align-items-center mb-2';

    newRow.innerHTML = `
      <select name="revenue_month[]" class="form-select" required>
        <option value="">Month</option>
        <option value="1">January</option>
        <option value="2">February</option>
        <option value="3">March</option>
        <option value="4">April</option>
        <option value="5">May</option>
        <option value="6">June</option>
        <option value="7">July</option>
        <option value="8">August</option>
        <option value="9">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
      </select>

      <select name="revenue_year[]" class="form-select" required>
        <option value="">Year</option>
        ${generateYears()}
      </select>

      <input type="number" name="revenue_amount[]" class="form-control" placeholder="Amount Tk" required>
    `;

    container.appendChild(newRow);
  }

  function generateYears() {
    const currentYear = new Date().getFullYear();
    let options = "";
    for (let y = currentYear; y >= 2000; y--) {
      options += `<option value="${y}">${y}</option>`;
    }
    return options;
  }
</script>
<script>
  function addSalesRow() {
    const container = document.getElementById('salesFields');
    const newRow = document.createElement('div');
    newRow.className = 'salesRow d-flex gap-2 align-items-center mb-2';

    newRow.innerHTML = `
      <select name="sales_month[]" class="form-select" required>
        <option value="">Month</option>
        ${generateMonths()}
      </select>

      <select name="sales_year[]" class="form-select" required>
        <option value="">Year</option>
        ${generateYears()}
      </select>

      <input type="number" name="sales_amount[]" class="form-control" placeholder="Sales Amount" required>
    `;

    container.appendChild(newRow);
  }

  function generateMonths() {
    const months = ["January", "February", "March", "April", "May", "June", "July",
                    "August", "September", "October", "November", "December"];
    return months.map((m, i) => `<option value="${i + 1}">${m}</option>`).join('');
  }

  function generateYears() {
    const currentYear = new Date().getFullYear();
    let options = "";
    for (let y = currentYear; y >= 2000; y--) {
      options += `<option value="${y}">${y}</option>`;
    }
    return options;
  }
</script>

</body>
</html>
