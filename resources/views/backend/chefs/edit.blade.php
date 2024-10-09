@extends('backend.layouts.base')

@section('title', 'Edit Chef')

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
            <li class="breadcrumb-item active" aria-current="page">Edit Chef</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Edit Chef</h1>
            <p class="mb-0">Edit chef di Yummy Restaurant</p>
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

<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <form action="{{ route('panel.chefs.update', $chef->uuid) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $chef->name }}" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Position</label>
                    <select name="position" class="form-select @error('position') is-invalid @enderror">
                        <option value="" hidden>Select Position ---</option>
                        <option {{ $chef->position == 'Master Chef' ? 'selected' : '' }} value="Master Chef">Master Chef</option>
                        <option {{ $chef->position == 'Patissier' ? 'selected' : '' }} value="Patissier">Patissier</option>
                        <option {{ $chef->position == 'Cook' ? 'selected' : '' }} value="Cook">Cook</option>
                    </select>
                    @error('position')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Instagram Link</label>
                    <input type="text" class="form-control @error('insta_link') is-invalid @enderror" name="insta_link" value="{{ $chef->insta_link }}">
                    @error('insta_link')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Linkedin Link</label>
                    <input type="text" class="form-control @error('linked_link') is-invalid @enderror" name="linked_link" value="{{ $chef->linked_link }}">
                    @error('linked_link')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5">{{ $chef->description }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Photo</label><br>
                <img src="{{ asset('storage/' . $chef->photo) }}" alt="{{ $chef->name }}" height="100" class="rounded mb-3">
                <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" accept="image/*">
                @error('photo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection