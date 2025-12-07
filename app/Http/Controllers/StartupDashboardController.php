<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StartupReport;
use App\Models\StartupProfile;

class StartupDashboardController extends Controller
{
    public function index()
{
    $profile = Auth::user()->startupProfile;
    $products = Product::where('user_id', Auth::id())
                       ->where('status', 'Live')
                       ->latest()
                       ->get();
    $revenue = collect($profile->revenue_data ?? []);
    $sales = collect($profile->sales_data ?? []);

    $revenueLabels = $revenue->pluck('date')->map(function ($date) {
        return \Carbon\Carbon::parse($date)->format('M Y');
    });

    $revenueValues = $revenue->pluck('amount');
    $salesLabels = $sales->pluck('date')->map(function ($date) {
        return \Carbon\Carbon::parse($date)->format('M Y');
    });
    $salesValues = $sales->pluck('amount');

    // ✅ Total Revenue Calculation
    $totalRevenue = $revenueValues->sum();
    $profile = StartupProfile::where('user_id', Auth::id())->first();

    $reports = $profile 
        ? StartupReport::where('startup_profile_id', $profile->id)->latest()->get() 
        : collect();

        if ($profile) {
    StartupReport::where('startup_profile_id', $profile->id)
        ->where('is_read', false)
        ->update(['is_read' => true]);
}
    return view('backend.startup_dashboard', compact(
       'products', 'revenueLabels', 'revenueValues',
        'salesLabels', 'salesValues',
        'totalRevenue','profile','reports'
    ));
}
public function edit()
{
    $profile = StartupProfile::where('user_id', Auth::id())->first();

    return view('backend.startupedit', compact('profile'));
}
public function update(Request $request)
{
    $profile = StartupProfile::where('user_id', Auth::id())->firstOrFail();

    $request->validate([
        'business_name' => 'required|string|max:255',
        'industry' => 'required|string|max:255',
        'description' => 'required|string',
        'website' => 'nullable|url',
        'owner_name' => 'nullable|string|max:255',
        'business_tagline' => 'nullable|string|max:255',
        'logo' => 'nullable|image|max:2048',
        'tax_receipt' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
    ]);

    $logoPath = $profile->logo;
    if ($request->hasFile('logo')) {
        $logoPath = $request->file('logo')->store('logos', 'public');
    }

    $taxPath = $profile->tax_receipt;
    if ($request->hasFile('tax_receipt')) {
        $taxPath = $request->file('tax_receipt')->store('tax_receipts', 'public');
    }

    // detect missing fields again
    $missingFields = [];
    if (!$request->filled('business_name')) $missingFields[] = 'business_name';
    if (!$request->filled('industry')) $missingFields[] = 'industry';
    if (!$request->filled('description')) $missingFields[] = 'description';
    if (!$request->filled('owner_name')) $missingFields[] = 'owner_name';
    if (!$request->filled('business_tagline')) $missingFields[] = 'business_tagline';
    if (!$request->filled('website')) $missingFields[] = 'website';
    if (!$logoPath) $missingFields[] = 'logo';
    if (!$taxPath) $missingFields[] = 'tax_receipt';

    $hasMissingData = count($missingFields) > 0;

    $profile->update([
        'business_name' => $request->business_name,
        'business_tagline' => $request->business_tagline,
        'industry' => $request->industry,
        'website' => $request->website,
        'description' => $request->description,
        'owner_name' => $request->owner_name,
        'logo' => $logoPath,
        'tax_receipt' => $taxPath,
        'has_missing_data' => $hasMissingData,
        'missing_fields' => json_encode($missingFields),
    ]);

  return redirect()->route('startup.profile.edit')->with('success', 'Profile updated successfully!');

}

}
