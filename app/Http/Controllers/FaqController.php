<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
class FaqController extends Controller
{


public function index(Request $request)
{
    $query = Faq::query();

    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('question', 'like', "%$search%")
              ->orWhere('answer', 'like', "%$search%");
    }

    $faqs = $query->paginate(10);
    return view('faq.index', compact('faqs'));
}
}
