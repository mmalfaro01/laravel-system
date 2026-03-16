<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->latest();

        $activeCategorySlug = $request->get('category');

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($activeCategorySlug) {
            $query->whereHas('category', function ($q) use ($activeCategorySlug) {
                $q->where('slug', $activeCategorySlug);
            });
        }

        $products = $query->paginate(12)->withQueryString();

        $menuCategories = Category::whereIn('slug', ['burgers', 'snacks', 'drinks'])
            ->orderBy('name')
            ->get()
            ->keyBy('slug');

        return view('products.index', [
            'products' => $products,
            'activeCategorySlug' => $activeCategorySlug,
            'menuCategories' => $menuCategories,
        ]);
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
