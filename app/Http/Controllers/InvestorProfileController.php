<?php

namespace App\Http\Controllers;
use App\Models\InvestorProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
class InvestorProfileController extends Controller
{
    public function create() {
    return view('backend.investorform'); 
     }  

 public function store(Request $request)
{
    // Debug: Check incoming data
    // dd($request->all());

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'nullable|string|max:20',
        'company' => 'nullable|string|max:255',
        'website' => 'nullable|url',
        'investment_sectors' => 'nullable|array',
        'bio' => 'nullable|string',
        'funding_range' => 'nullable|string|max:255',
        'profile_picture' => 'nullable|image|max:2048',
    ]);

    $userId = Auth::id();
    $companyFolder = $request->company ? str_replace(' ', '_', $request->company) : 'unknown';

    $profilePicturePath = null;

    if ($request->hasFile('profile_picture')) {
        $ext = $request->file('profile_picture')->getClientOriginalExtension();
        $fileName = $userId . '.' . $ext;

        $profilePicturePath = $request->file('profile_picture')->storeAs(
            "investors/{$companyFolder}",
            $fileName,
            'public'
        );
    }

    InvestorProfile::create([
        'user_id' => $userId,
        'full_name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'company' => $request->company,
        'website' => $request->website,
        'investment_sectors' => $request->investment_sectors, // automatically cast to JSON
        'bio' => $request->bio,
        'funding_range' => $request->funding_range,
        'profile_picture' => $profilePicturePath,
    ]);

    return redirect()->route('backend.investor_dashboard')->with('success', 'Profile saved!');
}
public function view(){
    $investor = Auth::user()->investorProfile;
      $activeStartups = \App\Models\StartupProfile::count(); // total startups
    $totalValue = \App\Models\Product::sum('revenue'); // sum of valuations
    $investorsCount = \App\Models\InvestorProfile::count(); // total investors
        // Products matching investor's investment sectors
        $matchedProducts = Product::whereIn('product_type', $investor->investment_sectors)->get();

        // Recent products (all, latest first)
        $recentProducts = Product::orderBy('created_at', 'desc')->take(10)->get();

        return view('backend.investor_dashboard', compact('matchedProducts', 'recentProducts','activeStartups',
        'totalValue',
        'investorsCount'));
}
public function edit()
{
    $profile = InvestorProfile::where('user_id', Auth::id())->first();

    return view('backend.investoredit', compact('profile'));
}
public function update(Request $request)
{
    $profile = InvestorProfile::where('user_id', Auth::id())->firstOrFail();
     $userId = Auth::id();
    $request->validate([
      'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'nullable|string|max:20',
        'company' => 'nullable|string|max:255',
        'website' => 'nullable|url',
        'investment_sectors' => 'nullable|array',
        'bio' => 'nullable|string',
        'funding_range' => 'nullable|string|max:255',
        'profile_picture' => 'nullable|image|max:2048',
    ]);
      $profilePicturePath = $profile->profile_picture;
    if ($request->hasFile('profile_picture')) {
       $profilePicturePath = $request->file('profile_picture')->store('profile_picture', 'public');
    }
    $profile->update([
          'user_id' => $userId,
        'full_name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'company' => $request->company,
        'website' => $request->website,
        'investment_sectors' => $request->investment_sectors, // automatically cast to JSON
        'bio' => $request->bio,
        'funding_range' => $request->funding_range,
        'profile_picture' => $profilePicturePath,
    ]);

  return redirect()->route('investor.profile.edit')->with('success', 'Profile updated successfully!');

}

}