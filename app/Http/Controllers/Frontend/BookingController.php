<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Http\Services\FileService;
use App\Mail\BookingMailPending;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function __construct(
        private FileService $fileService,
    ){}

    public function store(BookingRequest $request)
    {
        $data = $request->validated();

        try {
            $data['file'] = $this->fileService->upload($request->file('file'), 'transactions');

            if ($request->type == 'event') {
                $data['amount'] = 100000;
            } else {
                $data['amount'] = 50000;
            }

            Mail::to($data['email'])
                ->cc('operator@yummyrestaurant.com')
                ->send(new BookingMailPending($data));

            Transaction::create($data);

            return redirect()->back()->with('success', 'Booking created successfully. Please check your email for information.');
        } catch (\Throwable $th) {
            $this->fileService->delete('transactions/' . $data['file']);
            
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
