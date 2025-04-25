@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container-fluid">
    <div class="row g-4">
        <!-- Hero Section -->
        <div class="p-5 mb-4 hero-banner text-white rounded-3 shadow d-flex align-items-center">
            <div class="container text-center blurred-box p-4 rounded">
                <h1 class="display-4 fw-bold">Welcome to the Student Tuition Payment System</h1>
                <p class="lead">Secure. Simple. Seamless payments for students.</p>
                <a href="{{ route('payment') }}" class="btn btn-light btn-lg mt-3">
                    <i class="bi bi-credit-card"></i> Make a Payment
                </a>
            </div>
        </div>
        
        <style>
            .hero-banner {
                background-image: url('{{ asset('images/payment-bg.jpg') }}'); /* Replace with your image */
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                height: 400px;
                position: relative;
            }

            .blurred-box {
                background: rgba(0, 0, 0, 0.4); /* Semi-transparent black */
                backdrop-filter: blur(6px); /* Blur effect */
                -webkit-backdrop-filter: blur(6px);
                color: white;
            }
        </style>

        <!-- Features Section -->
        <div class="col-12">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="card border-0 shadow h-100">
                        <div class="card-body">
                            <i class="bi bi-cash-coin display-4 text-success mb-3"></i>
                            <h5 class="card-title">Fast Payments</h5>
                            <p class="card-text">Quick and secure payment process for students and staff alike.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow h-100">
                        <div class="card-body">
                            <i class="bi bi-bar-chart-line display-4 text-info mb-3"></i>
                            <h5 class="card-title">Detailed Reports</h5>
                            <p class="card-text">Generate real-time reports of transactions and outstanding balances.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow h-100">
                        <div class="card-body">
                            <i class="bi bi-lock-fill display-4 text-danger mb-3"></i>
                            <h5 class="card-title">Secure Platform</h5>
                            <p class="card-text">Built with security in mind to protect student and payment data.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="col-12 mt-5">
            <div class="text-center">
                <h2 class="mb-4">Start Managing Your Payments Today</h2>
                <a href="{{ route('students') }}" class="btn btn-success btn-lg me-2">Manage Students <i class="bi bi-people"></i></a>
                <a href="{{ route('statistics') }}" class="btn btn-outline-primary btn-lg">View Reports <i class="bi bi-file-earmark-text"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection