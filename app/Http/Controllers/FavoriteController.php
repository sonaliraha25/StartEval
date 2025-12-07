<?php

namespace App\Http\Controllers;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function toggle($productId)
    {
        $userId = auth()->id();

        $favorite = Favorite::where('user_id', $userId)
                            ->where('product_id', $productId)
                            ->first();

        if ($favorite) {
            $favorite->delete(); // remove if exists
            return response()->json(['status' => 'removed']);
        } else {
            Favorite::create([
                'user_id' => $userId,
                'product_id' => $productId
            ]);
            return response()->json(['status' => 'added']);
        }
    }

    public function myFavorites()
    {
        $favorites = Favorite::with('product')
                             ->where('user_id', auth()->id())
                             ->get();

        return view('backend.favorite', compact('favorites'));
    }
}
