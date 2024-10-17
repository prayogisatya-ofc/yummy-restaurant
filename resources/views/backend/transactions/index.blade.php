@extends('backend.layouts.base')

@section('title', 'Transactions')

@section('content')
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="{{ route('panel.dashboard') }}">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Transactions</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Transactions</h1>
                <p class="mb-0">Daftar transaksi di Yummy Restaurant</p>
            </div>
            <div>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modalFilter" class="btn btn-outline-gray-600 d-inline-flex align-items-center">
                    Download
                </button>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0 rounded-start">No</th>
                            <th class="border-0">Code</th>
                            <th class="border-0">Type</th>
                            <th class="border-0">Name</th>
                            <th class="border-0">Amount</th>
                            <th class="border-0">Created At</th>
                            <th class="border-0">Status</th>
                            @if (auth()->user()->role == 'operator')
                            <th class="border-0">Status Action</th>
                            @endif
                            <th class="border-0 rounded-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                            <tr class="align-middle">
                                <td><span
                                        class="text-primary fw-bold">{{ ($transactions->currentPage() - 1) * $transactions->perPage() + $loop->iteration }}</span>
                                </td>
                                <td>#{{ $transaction->code }}</td>
                                <td>{{ $transaction->type }}</td>
                                <td>{{ $transaction->name }}</td>
                                <td>Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                                <td>
                                    @if ($transaction->status === 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif ($transaction->status === 'success')
                                        <span class="badge bg-success">Success</span>
                                    @else
                                        <span class="badge bg-danger">Failed</span>
                                    @endif
                                </td>
                                @if (auth()->user()->role == 'operator')
                                <td>
                                    <form action="{{ route('panel.transactions.update', $transaction->uuid) }}"
                                        method="post" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="form-select" onchange="this.form.submit()">
                                            <option {{ $transaction->status == 'pending' ? 'selected' : '' }}
                                                value="pending">Pending</option>
                                            <option {{ $transaction->status == 'success' ? 'selected' : '' }}
                                                value="success">Success</option>
                                            <option {{ $transaction->status == 'failed' ? 'selected' : '' }}
                                                value="failed">Failed</option>
                                        </select>
                                    </form>
                                </td>
                                @endif
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('panel.transactions.show', $transaction->uuid) }}"
                                            class="btn btn-sm btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                                <path
                                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                            </svg>
                                        </a>
                                        @if (auth()->user()->role == 'operator')
                                        <button type="submit" form="delete-image-{{ $transaction->uuid }}"
                                            class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                            </svg>
                                        </button>
                                        @endif
                                    </div>
                                    @if (auth()->user()->role == 'operator')
                                    <form action="{{ route('panel.transactions.destroy', $transaction->uuid) }}" hidden
                                        method="post" id="delete-image-{{ $transaction->uuid }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No data found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalFilter" tabindex="-1" aria-labelledby="modalFilterLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h1 class="modal-title fs-5" id="modalFilterLabel">Filter</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('panel.transactions.download') }}" method="post" id="formFilter">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date">
                            @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date">
                            @error('end_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="formFilter" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </div>
    </div>
@endsection
