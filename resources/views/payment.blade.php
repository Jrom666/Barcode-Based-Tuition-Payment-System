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
    </div>
</body>
</html>

@endsection