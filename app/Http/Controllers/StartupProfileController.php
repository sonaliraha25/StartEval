<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\StartupProfile;
class StartupProfileController extends Controller
{
    public function create() {
    return view('backend.startupform'); // Your Blade file
}
public function store(Request $request)
{ 
    $request->validate([
        'business_name' => 'required|string|max:255',
        'business_tagline' => 'nullable|string|max:255',
        'industry' => 'required|string|max:255',
        'website' => 'nullable|url',
        'description' => 'required|string',
        'owner_name' => 'nullable|string|max:255',
        'logo' => 'nullable|image|max:2048',
        'tax_receipt' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',

        'revenue_month' => 'nullable|array',
        'revenue_month.*' => 'required|numeric|min:1|max:12',
        'revenue_year' => 'nullable|array',
        'revenue_year.*' => 'required|numeric',
        'revenue_amount' => 'nullable|array',
        'revenue_amount.*' => 'required|numeric',

        'sales_month' => 'nullable|array',
        'sales_month.*' => 'required|numeric|min:1|max:12',
        'sales_year' => 'nullable|array',
        'sales_year.*' => 'required|numeric',
        'sales_amount' => 'nullable|array',
        'sales_amount.*' => 'required|numeric',
    ]);

    $userId = Auth::id();
    $folderName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $request->business_name ?: 'unknown');

    // Upload logo
    $logoPath = null;
    if ($request->hasFile('logo')) {
        $ext = $request->file('logo')->getClientOriginalExtension();
        $fileName = $userId . '.' . $ext;
        $logoPath = $request->file('logo')->storeAs("startups/{$folderName}", $fileName, 'public');
    }

    // Upload tax receipt
    $taxPath = null;
    if ($request->hasFile('tax_receipt')) {
        $ext = $request->file('tax_receipt')->getClientOriginalExtension();
        $fileName = $userId . '_receipt.' . $ext;
        $taxPath = $request->file('tax_receipt')->storeAs("startups/{$folderName}", $fileName, 'public');
    }

    // Revenue data
    $revenueData = [];
    if ($request->revenue_month && $request->revenue_year && $request->revenue_amount) {
        foreach ($request->revenue_month as $i => $month) {
            $year = $request->revenue_year[$i] ?? null;
            $amount = $request->revenue_amount[$i] ?? null;
            if ($month && $year && $amount) {
                $formattedMonth = str_pad($month, 2, '0', STR_PAD_LEFT);
                $revenueData[] = ['date' => "$year-$formattedMonth", 'amount' => $amount];
            }
        }
    }

    // Sales data
    $salesData = [];
    if ($request->sales_month && $request->sales_year && $request->sales_amount) {
        foreach ($request->sales_month as $i => $month) {
            $year = $request->sales_year[$i] ?? null;
            $amount = $request->sales_amount[$i] ?? null;
            if ($month && $year && $amount) {
                $formattedMonth = str_pad($month, 2, '0', STR_PAD_LEFT);
                $salesData[] = ['date' => "$year-$formattedMonth", 'amount' => $amount];
            }
        }
    }

    // ✅ Check missing fields
    $missingFields = [];

    if (empty($request->business_name)) $missingFields[] = 'business_name';
    if (empty($request->industry)) $missingFields[] = 'industry';
    if (empty($request->description)) $missingFields[] = 'description';
    if (empty($request->owner_name)) $missingFields[] = 'owner_name';
    if (empty($request->business_tagline)) $missingFields[] = 'business_tagline';
    if (empty($request->website)) $missingFields[] = 'website';
    if (!$logoPath) $missingFields[] = 'logo';
    if (!$taxPath) $missingFields[] = 'tax_receipt';

    $hasMissingData = count($missingFields) > 0;

    // ✅ Save to DB
    StartupProfile::create([
        'user_id' => $userId,
        'business_name' => $request->business_name,
        'business_tagline' => $request->business_tagline,
        'industry' => $request->industry,
        'website' => $request->website,
        'description' => $request->description,
        'owner_name' => $request->owner_name,
        'logo' => $logoPath,
        'revenue_data' => $revenueData,
        'sales_data' => $salesData,
        'tax_receipt' => $taxPath,
        'has_missing_data' => $hasMissingData,
        'missing_fields' => json_encode($missingFields),
    ]);

    return redirect()->route('backend.startup_dashboard')->with('success', 'Startup profile created successfully!');
}
}
