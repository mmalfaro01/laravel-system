<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\OrderItem;

class StoreController extends Controller
{
    /**
     * List all resellers.
     */
    public function index()
    {
        $stores = Store::withCount('products')->get();

        foreach ($stores as $store) {
            $store->earnings = OrderItem::whereHas('product', function ($q) use ($store) {
                $q->where('store_id', $store->id);
            })->sum('price');
        }

        return view('admin.stores.index', compact('stores'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('admin.stores.create');
    }

    /**
     * Store new reseller.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'email' => 'required|email|unique:stores,email',
        ]);

        Store::create($request->only(['name', 'owner_name', 'email']));

        return redirect()->route('admin.stores.index')->with('success', 'Reseller added successfully!');
    }

    /**
     * Show edit form.
     */
    public function edit($id)
    {
        $store = Store::findOrFail($id);
        return view('admin.stores.edit', compact('store'));
    }

    /**
     * Update reseller.
     */
    public function update(Request $request, $id)
    {
        $store = Store::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'email' => 'required|email|unique:stores,email,' . $store->id,
        ]);

        $store->update($request->only(['name', 'owner_name', 'email']));

        return redirect()->route('admin.stores.index')->with('success', 'Reseller updated successfully!');
    }

    /**
     * Delete reseller.
     */
    public function destroy($id)
    {
        $store = Store::findOrFail($id);
        $store->delete();

        return redirect()->route('admin.stores.index')->with('success', 'Reseller deleted.');
    }
}
