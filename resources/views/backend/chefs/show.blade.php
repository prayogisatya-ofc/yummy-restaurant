@extends('backend.layouts.base')

@section('title', $chef->name)

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
            <li class="breadcrumb-item"><a href="{{ route('panel.chefs.index') }}">Chefs</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Chef</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Detail Chef</h1>
            <p class="mb-0">Detail chef di Yummy Restaurant</p>
        </div>
        <div>
            <a href="{{ route('panel.chefs.index') }}"
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
                <img src="{{ asset('storage/' . $chef->photo) }}" alt="{{ $chef->name }}" class="w-100">
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
                            <td>: {{ $chef->name }}</td>
                        </tr>
                        <tr class="align-middle">
                            <th width="200">Position</th>
                            <td>: {{ $chef->position }}</td>
                        </tr>
                        <tr class="align-middle">
                            <th width="200">Instagram Link</th>
                            <td>: {{ $chef->insta_link }}</td>
                        </tr>
                        <tr class="align-middle">
                            <th width="200">Linkedin Link</th>
                            <td>: {{ $chef->linked_link }}</td>
                        </tr>
                        <tr class="align-middle">
                            <th width="200">Created at</th>
                            <td>: {{ $chef->created_at }}</td>
                        </tr>
                        <tr class="align-middle">
                            <th width="200">Updated at</th>
                            <td>: {{ $chef->updated_at }}</td>
                        </tr>
                        <tr class="align-middle">
                            <th width="200">Description</th>
                            <td class="text-wrap">: {{ $chef->description }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection