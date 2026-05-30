<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

    public function search(Request $request)
    {
        $contacts = $this->getSearchQuery($request)
            ->paginate(7)
            ->appends($request->query());

        $categories = Category::orderBy('id')->get();

        return view('admin.index', compact('contacts', 'categories'));
    }

    public function reset()
    {
        return redirect('/admin');
    }

    public function delete(Request $request)
    {
        $contact = Contact::find($request->input('id'));

        if ($contact) {
            $contact->delete();
        }

        return redirect('/admin');
    }

    public function export(Request $request): StreamedResponse
    {
        $contacts = $this->getSearchQuery($request)->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ];

        return response()->streamDownload(function () use ($contacts) {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($handle, [
                'お名前',
                '性別',
                'メールアドレス',
                '電話番号',
                '住所',
                '建物名',
                'お問い合わせの種類',
                'お問い合わせ内容',
                '作成日',
            ]);

            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->last_name.' '.$contact->first_name,
                    $contact->gender_label,
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building ?? '',
                    $contact->category->content ?? '',
                    $contact->detail,
                    $contact->created_at->format('Y-m-d'),
                ]);
            }

            fclose($handle);
        }, 'contacts.csv', $headers);
    }

    private function getSearchQuery(Request $request)
    {
        $query = Contact::with('category')->orderByDesc('created_at');

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $keywordNoSpace = str_replace(' ', '', $keyword);

            $query->where(function ($q) use ($keyword, $keywordNoSpace) {
                $q->where('first_name', 'like', "%{$keyword}%")
                    ->orWhere('last_name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%")
                    ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$keywordNoSpace}%"])
                    ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$keyword}%"]);
            });
        }

        if ($request->filled('gender') && $request->input('gender') !== 'all') {
            $query->where('gender', $request->input('gender'));
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        return $query;
    }
}
