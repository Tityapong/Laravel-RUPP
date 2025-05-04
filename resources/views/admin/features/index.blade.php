
@extends('layouts.app')

@section('content')
<style>
    .modern-card {
        margin-top: 100px;
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
    .table-modern thead {
        background-color: #f8f9fa;
        color: #333;
    }
    .table-modern tbody tr:hover {
        background-color: #f1f3f5;
    }
    .btn-modern {
        border-radius: 25px;
        padding: 8px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .btn-modern-success {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
    }
    .btn-modern-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }
    .btn-modern-warning {
        background-color: #ffca2c;
        border-color: #ffca2c;
        color: #333;
    }
    .btn-modern-warning:hover {
        background-color: #e0b72d;
        border-color: #e0b72d;
    }
    .btn-modern-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }
    .btn-modern-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }
    .modal-header-modern {
        background: linear-gradient(90deg, #007bff, #00c4ff);
        color: white;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }
    .modal-content-modern {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
    }
    .modal-content-modern .form-label {
        font-weight: 500;
        color: #555;
    }
    .modal-content-modern .form-control {
        border-radius: 10px;
        border: 1px solid #ced4da;
        padding: 10px;
    }
    .modal-content-modern .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    }
</style>

<div class="container mt-5">
<div class="card modern-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 fw-bold text-dark">Features</h1>
        <a href="#" class="btn btn-modern btn-modern-success" data-bs-toggle="modal" data-bs-target="#createFeatureModal">Create New Feature</a>
    </div>
    <table class="table table-modern">
        <thead>
            <tr>
                <th>Title</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($features as $feature)
            <tr>
                <td>{{ $feature->title }}</td>
                <td><img src="{{ asset('images/' . $feature->image) }}" alt="Feature Image" style="width: 50px; height:50px; object-fit: cover; border-radius: 5px;"></td>
                <td>
                    <a href="#" class="btn btn-modern btn-modern-warning me-2" data-bs-toggle="modal" data-bs-target="#editFeatureModal{{ $feature->id }}">Edit</a>
                    <a href="#" class="btn btn-modern btn-modern-danger" data-bs-toggle="modal" data-bs-target="#deleteFeatureModal{{ $feature->id }}">Delete</a>
                </td>
            </tr>

            <!-- Edit Feature Modal -->
            <div class="modal fade" id="editFeatureModal{{ $feature->id }}" tabindex="-1" aria-labelledby="editFeatureModalLabel{{ $feature->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('features.update', $feature->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-content modal-content-modern">
                            <div class="modal-header modal-header-modern">
                                <h5 class="modal-title" id="editFeatureModalLabel{{ $feature->id }}">Edit Feature</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <div class="mb-3">
                                    <label for="editTitle{{ $feature->id }}" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="editTitle{{ $feature->id }}" name="title" value="{{ $feature->title }}" required>
                                    @error('title')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="editImage{{ $feature->id }}" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="editImage{{ $feature->id }}" name="image">
                                    <img src="{{ asset('images/' . $feature->image) }}" alt="Current Image" class="mt-2 img-fluid" style="max-height: 150px; object-fit: cover;">
                                    @error('image')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-modern btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-modern btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Feature Modal -->
            <div class="modal fade" id="deleteFeatureModal{{ $feature->id }}" tabindex="-1" aria-labelledby="deleteFeatureModalLabel{{ $feature->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('features.destroy', $feature->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content modal-content-modern">
                            <div class="modal-header modal-header-modern">
                                <h5 class="modal-title" id="deleteFeatureModalLabel{{ $feature->id }}">Confirm Delete</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <p>Are you sure you want to delete "{{ $feature->title }}"?</p>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-modern btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-modern btn-danger">Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
</div>

<!-- Create Feature Modal -->
<div class="modal fade" id="createFeatureModal" tabindex="-1" aria-labelledby="createFeatureModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('features.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content modal-content-modern">
                <div class="modal-header modal-header-modern">
                    <h5 class="modal-title" id="createFeatureModalLabel">Create Feature</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                        @error('title')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                        @error('image')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-modern btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-modern btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection