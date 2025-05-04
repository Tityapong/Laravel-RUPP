
@extends('layouts.app')

@section('content')
<!-- ***** Features Section Start ***** -->
<section id="features" class="features section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="section-title">FEATURES</h2>
                <p class="section-description">Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div>
        </div>
        
        <div class="row mt-5">
        @foreach ($features as $feature)
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="feature-box p-3 border rounded h-100">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('images/' . $feature->image) }}" alt="Feature Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px; margin-right: 15px;">
                    <h5 class="mb-0">{{ $feature->title }}</h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
    </div>
</div>
    </div>
</section>
<!-- ***** Features Section End ***** -->

<!-- Add your existing Services and About Us sections here -->
@endsection

<!-- Add this to your CSS file -->
<style>
.features {
    padding: 80px 0;
    background-color: #fff;
}

.section-title {
    margin-bottom: 15px;
    font-weight: 700;
    position: relative;
    display: inline-block;
}

.section-title:after {
    content: '';
    display: block;
    width: 60px;
    height: 4px;
    background-color: #4CAF50;
    margin: 15px auto 0;
}

.feature-box {
    transition: all 0.3s ease;
    background: #fff;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
}

.feature-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
}

.feature-icon {
    font-size: 24px;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: rgba(0, 0, 0, 0.03);
}

.text-purple {
    color: #9c27b0;
}

.text-warning {
    color: #ffca2c;
}

.text-primary {
    color: #007bff;
}

.text-danger {
    color: #dc3545;
}
</style>