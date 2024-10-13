<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionExport implements FromCollection, WithHeadings, ShouldQueue, ShouldAutoSize, WithStyles
{
    use Exportable;

    protected $start_date, $end_date;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function collection()
    {
        return Transaction::whereDate('created_at', '>=', $this->start_date)
            ->whereDate('created_at', '<=', $this->end_date)
            ->get()->map(function ($transaction) {
            return [
                'code' => $transaction->code,
                'type' => $transaction->type,
                'name' => $transaction->name,
                'email' => $transaction->email,
                'phone' => $transaction->phone,
                'date' => date('d-m-Y', strtotime($transaction->date)),
                'time' => $transaction->time,
                'amount' => 'Rp ' . number_format($transaction->amount, 0, ',', '.'),
                'status' => $transaction->status,
                'file' => env('APP_URL') . '/storage/' . $transaction->file,
                'messages' => $transaction->messages,
                'created_at' => date('d-m-Y H:i', strtotime($transaction->created_at)),
                'updated_at' => date('d-m-Y H:i', strtotime($transaction->updated_at)),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Code',
            'Type',
            'Name',
            'Email',
            'Phone',
            'Date',
            'Time',
            'Amount',
            'Status',
            'File',
            'Messages',
            'Created At',
            'Updated At'
        ];
    }
}

