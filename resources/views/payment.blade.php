@extends('layouts.app')

@section('title','Payment')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Scan Tuition Barcode</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center">Student Tuition Payment System</h2>
        <form method="POST" action="/scan" class="mt-4">
            @csrf
            <div class="mb-3">
                <label for="barcode" class="form-label">Scan or Enter Student Barcode</label>
                <input type="text" class="form-control" name="barcode" id="barcode" placeholder="Enter Student ID">
            </div>
            <button type="submit" class="btn btn-primary">Scan</button>
        </form>
        @if(isset($student))
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Student Information</h5>
                    <p><strong>Name:</strong> {{ $student->name }}</p>
                    <p><strong>Student ID:</strong> {{ $student->student_number }}</p>
                    <p><strong>Total Tuition:</strong> ₱{{ number_format($student->program->fee, 2) }}</p>
                    <p><strong>Remaining Balance:</strong> ₱{{ number_format($student->program->fee - $student->payments->sum('amount'), 2) }}</p>
                    <p><strong>Course:</strong> {{ $student->program->name }}</p>
                    <p><strong>Address:</strong> {{ $student->address }}</p>
                </div>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger mt-4">
                {{ session('error') }}
            </div>
        @endif

    </div>
</body>
</html>
@endsection