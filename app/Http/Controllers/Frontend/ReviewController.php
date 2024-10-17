<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required',
            'name' => 'required|max:255',
            'rate' => 'required|in:1,2,3,4,5',
            'comment' => 'nullable|min:10|max:255',
        ]);

        $transaction = Transaction::where('code', $data['code'])->first();

        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaction not found');
        }

        if ($transaction->reviews->count() > 0) {
            return redirect()->back()->with('error', 'Transaction already reviewed');
        }

        try {
            Review::create([
                'transaction_id' => $transaction->id,
                'name' => $data['name'],
                'rate' => $data['rate'],
                'comment' => $data['comment'],
            ]);

            return redirect()->back()->with('success', 'Terima kasih telah memberikan ulasan.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
