<?php

namespace App\Http\Controllers;
use App\Models\user;
use App\Models\StartupProfile;
use App\Models\InvestorProfile;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\StartupReport;
use App\Models\Contact;

class AdminController extends Controller
{
    public function index()
{
    $users = User::all();

    $totalUsers = $users->count();
    $investorCount = $users->where('account_type', 'investor')->count();
    $startupCount = $users->where('account_type', 'startup')->count();
    $adminCount = $users->where('account_type', 'admin')->count();

    $activeStartups = StartupProfile::count(); 
    $totalInvestment =Product::sum('asking_price');  // assuming you store investment amount as 'asking_price'

    // For charts
    $userGrowth = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                        ->groupBy('date')
                        ->orderBy('date')
                        ->get();

    $industryStats = StartupProfile::selectRaw('industry, COUNT(*) as count')
                        ->groupBy('industry')
                        ->get();

    return view('admin.dashboard', compact(
        'users',
        'totalUsers',
        'startupCount',
        'activeStartups',
        'totalInvestment',
        'userGrowth',
        'industryStats'
    ));
}
public function totalusers(){
     $users = User::all();
     return view('admin.totaluser', compact(
        'users'));
}
public function showEntrepreneurs() {
    $entrepreneurs = StartupProfile::all();

    // ✅ Auto-delete reports if no missing data
    foreach ($entrepreneurs as $e) {
        if (!$e->has_missing_data) {
            StartupReport::where('startup_profile_id', $e->id)->delete();
        }
    }

    return view('admin.entrepreneurs', compact('entrepreneurs'));
}
public function sendDashboardReport(Request $request)
{
    $request->validate([
        'profile_id' => 'required|exists:startup_profiles,id',
        'report_message' => 'required|string|max:1000',
    ]);

    StartupReport::create([
        'startup_profile_id' => $request->profile_id,
        'message' => $request->report_message,
        'is_read' => false,
    ]);

    return back()->with('success', 'Report sent to startup dashboard!');
}
public function showinvestors() {
    $investors = InvestorProfile::all();
    return view('admin.investors',compact('investors'));
}
public function productList()
{
    $products = Product::all();
    return view('admin.products', compact('products'));
}
public function editProduct($id)
{
    $product = Product::findOrFail($id);
    return view('admin.productreview', compact('product'));
}

public function updateProduct(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:live,draft,rejected',
        'admin_rating' => 'nullable|integer|min:0|max:5',
    ]);

    $product = Product::findOrFail($id);
    $product->status = $request->status;
    $product->admin_rating = $request->admin_rating;
    $product->save();

    return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
}
public function conindex()
{
    // Get all contact form submissions
    $contacts = Contact::orderBy('created_at', 'desc')->get();

    return view('admin.contacts', compact('contacts'));
}
}
