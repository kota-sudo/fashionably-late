<?php

namespace App\Http\Controllers;

use App\Models\Contact;

class AdminController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('category')
            ->orderByDesc('created_at')
            ->paginate(7);

        return view('admin.index', compact('contacts'));
    }
}
