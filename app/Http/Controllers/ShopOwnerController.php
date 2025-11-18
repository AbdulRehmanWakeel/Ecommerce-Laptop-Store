<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopOwner;
use App\Http\Requests\ShopOwnerRequest;
use Illuminate\Support\Facades\Hash;

class ShopOwnerController extends Controller
{
    public function index(Request $request)
    {
        $query = ShopOwner::query();

        if ($request->q) {
            $search = $request->q;
            $query->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
        }

        $shopOwners = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();

        return view('shop_owners.index', compact('shopOwners'));
    }

    public function create()
    {
        return view('shop_owners.create');
    }

    public function store(ShopOwnerRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        ShopOwner::create($data);

        return redirect()->route('shop-owners.index')->with('success', 'Shop Owner created successfully!');
    }

    public function edit(ShopOwner $shopOwner)
    {
        return view('shop_owners.edit', compact('shopOwner'));
    }

    public function update(ShopOwnerRequest $request, ShopOwner $shopOwner)
    {
        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $shopOwner->update($data);

        return redirect()->route('shop-owners.index')->with('success', 'Shop Owner updated successfully!');
    }

    public function destroy(ShopOwner $shopOwner)
    {
        $shopOwner->delete();
        return back()->with('success', 'Shop Owner deleted successfully!');
    }
}
