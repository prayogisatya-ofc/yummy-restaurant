<?php

namespace App\Http\Controllers\Backend;

use App\Exports\TransactionExport;
use App\Http\Controllers\Controller;
use App\Http\Services\FileService;
use App\Mail\BookingMailPending;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    public function __construct(
        private FileService $fileService
    ){
        $this->middleware('checkRole:operator')->only('update', 'destroy');
    }
    
    public function index()
    {
        return view('backend.transactions.index', [
            'transactions' => Transaction::latest()->paginate(10),
        ]);
    }

    public function show(string $uuid)
    {
        return view('backend.transactions.show', [
            'transaction' => Transaction::where('uuid', $uuid)->firstOrFail(),
        ]);
    }

    public function update(Request $request, string $uuid)
    {
        $transaction = Transaction::where('uuid', $uuid)->firstOrFail();

        try {
            $transaction->status = $request->status;
            $transaction->save();

            Mail::to($transaction->email)
                ->cc('operator@yummyrestaurant.com')
                ->send(new BookingMailPending($transaction));

            return redirect()->back()->with('success', 'Transaction #' . $transaction->code . ' updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(string $uuid)
    {
        $transaction = Transaction::where('uuid', $uuid)->firstOrFail();
        $this->fileService->delete($transaction->file);
        $transaction->delete();

        return redirect()->back()->with('success', 'Transaction deleted successfully');
    }

    public function download(Request $request)
    {
        $data = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);

        return Excel::download(new TransactionExport($data['start_date'], $data['end_date']), 'transactions.xlsx');
    }
}
