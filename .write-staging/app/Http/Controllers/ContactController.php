<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('id')->get();
        $tel = $request->input('tel');
        $tel1 = $request->input('tel1');
        $tel2 = $request->input('tel2');
        $tel3 = $request->input('tel3');

        if (!$tel1 && !$tel2 && !$tel3 && $tel) {
            if (preg_match('/^(\d{2,4})(\d{2,4})(\d{4})$/', $tel, $matches)) {
                $tel1 = $matches[1];
                $tel2 = $matches[2];
                $tel3 = $matches[3];
            }
        }

        return view('contacts.index', compact('categories', 'tel1', 'tel2', 'tel3'));
    }

    public function confirm(ContactRequest $request)
    {
        $validated = $request->validated();
        $tel = $request->tel1.$request->tel2.$request->tel3;
        $category = Category::find($request->category_id);

        return view('contacts.confirm', [
            'input' => array_merge($validated, [
                'tel' => $tel,
                'tel1' => $request->tel1,
                'tel2' => $request->tel2,
                'tel3' => $request->tel3,
            ]),
            'category' => $category,
        ]);
    }

    public function store(ContactRequest $request)
    {
        $validated = $request->validated();

        Contact::create([
            'category_id' => $validated['category_id'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'gender' => $validated['gender'],
            'email' => $validated['email'],
            'tel' => $request->tel1.$request->tel2.$request->tel3,
            'address' => $validated['address'],
            'building' => $validated['building'] ?? null,
            'detail' => $validated['detail'],
        ]);

        return redirect('/thanks');
    }

    public function thanks()
    {
        return view('contacts.thanks');
    }
}
