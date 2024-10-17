<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $statistics = Transaction::all();

        return view('backend.dashboard.index', [
            'transactions' => Transaction::latest()->paginate(5),
            'total_transaction' => $statistics->count(),
            'transaction_pending' => $statistics->where('status', 'pending')->count(),
            'transaction_success' => $statistics->where('status', 'success')->count(),
            'transaction_failed' => $statistics->where('status', 'failed')->count(),
        ]);
    }
}
