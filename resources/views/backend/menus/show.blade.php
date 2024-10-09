@extends('backend.layouts.base')

@section('title', $menu->name)

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
            <li class="breadcrumb-item"><a href="#">Data Master</a></li>
            <li class="breadcrumb-item"><a href="{{ route('panel.menus.index') }}">Menus</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Menu</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Detail Menu</h1>
            <p class="mb-0">Detail menu di Yummy Restaurant</p>
        </div>
        <div>
            <a href="{{ route('panel.menus.index') }}"
                class="btn btn-outline-gray-600 d-inline-flex align-items-center">
                Back
            </a>
        </div>
    </div>
</div>

@if (session('error'))    
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row">
    <div class="col-md-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-100">
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card border-0 shadow h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table w-100 table-striped">
                        <tr class="align-middle">
                            <th width="200">Name</th>
                            <td>: {{ $menu->name }}</td>
                        </tr>
                        <tr class="align-middle">
                            <th width="200">Category</th>
                            <td>: {{ $menu->category->title }}</td>
                        </tr>
                        <tr class="align-middle">
                            <th width="200">Price</th>
                            <td>: {{ number_format($menu->price, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="align-middle">
                            <th width="200">Status</th>
                            <td>: 
                                @if ($menu->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr class="align-middle">
                            <th width="200">Created at</th>
                            <td>: {{ $menu->created_at }}</td>
                        </tr>
                        <tr class="align-middle">
                            <th width="200">Updated at</th>
                            <td>: {{ $menu->updated_at }}</td>
                        </tr>
                        <tr class="align-middle">
                            <th width="200">Description</th>
                            <td>: {{ $menu->description }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection