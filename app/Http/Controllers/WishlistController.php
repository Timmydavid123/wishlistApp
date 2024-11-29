<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class WishlistController extends Controller
{
    // Show the form for submitting wishlists
    public function showForm()
    {
        return view('wishlist.form');
    }

    // Handle form submission
    public function submitWishlist(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:wishlists,name',
            'wishlist' => 'required|string|max:500',
        ]);

        Wishlist::create([
            'name' => $request->name,
            'wishlist' => $request->wishlist,
        ]);

        return redirect()->route('wishlist.pick')->with('success', 'Wishlist submitted successfully!');
    }

    // Display the secret box
    public function pickSecretBox()
    {
        $users = Wishlist::all();
        return view('wishlist.pick', compact('users'));
    }

    // Handle picking a name and deleting it
    public function pickName($id)
    {
        $user = Wishlist::findOrFail($id);

        // Return the user details as JSON and delete from the database
        $response = [
            'name' => $user->name,
            'wishlist' => $user->wishlist,
        ];
        $user->delete();

        return response()->json($response);
    }
}
