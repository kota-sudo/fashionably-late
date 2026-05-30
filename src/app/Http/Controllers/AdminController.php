<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;

class AdminController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('category')
            ->orderByDesc('created_at')
            ->paginate(7);

        $categories = Category::orderBy('id')->get();

        return view('admin.index', compact('contacts', 'categories'));
    }
}
