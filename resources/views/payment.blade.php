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
        <h2 class="text-center mb-4">Student Tuition Payment System</h2>

        <form method="POST" action="/scan" class="mb-4">
            @csrf
            <div class="mb-3">
                <label for="barcode" class="form-label">Scan or Enter Student Barcode</label>
                <input type="text" class="form-control" name="barcode" id="barcode" placeholder="Enter Student ID">
            </div>
            <button type="submit" class="btn btn-primary">Scan</button>
        </form>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <div class="row">
            <!-- Student Info Card -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header bg-white border-bottom-0 rounded-top-4">
                        <h5 class="mb-0 fw-semibold text-primary">Student Information</h5>
                    </div>
                    <div class="card-body bg-light-subtle rounded-bottom-4">
                        <div class="row mb-2">
                            <div class="col-4 text-muted">Student ID</div>
                            <div class="col-8 fw-medium">{{ $student->student_number ?? '' }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 text-muted">Name</div>
                            <div class="col-8 fw-medium">{{ $student->name ?? '' }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 text-muted">Course</div>
                            <div class="col-8 fw-medium">{{ $student->program->name ?? '' }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 text-muted">Total Tuition</div>
                            <div class="col-8 fw-medium">₱{{ isset($student) ? number_format($student->program->fee, 2) : '' }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 text-muted">Remaining Balance</div>
                            <div class="col-8 fw-medium 
                                {{ isset($student) && ($student->program->fee - $student->payments->sum('amount')) > 0 ? 'text-danger' : 'text-success' }}">
                                ₱{{ isset($student) ? number_format($student->program->fee - $student->payments->sum('amount'), 2) : '' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 text-muted">Address</div>
                            <div class="col-8 fw-medium">{{ $student->address ?? '' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Barcode Scanner Card -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header bg-white border-bottom-0 rounded-top-4">
                        <h5 class="mb-0 fw-semibold text-primary">Live Barcode Scanner</h5>
                    </div>
                    <div class="card-body bg-light-subtle rounded-bottom-4 text-center">
                        <div id="scanner-container" style="width: 100%; height: 300px; border-radius: 12px; overflow: hidden;"></div>
                    </div>
                    <div class="card-footer bg-white text-center">
                        <button id="start-scanning" class="btn btn-success">Start Scanning</button>
                        <button id="stop-scanning" class="btn btn-danger" style="display: none;">Stop Scanning</button>
                    </div>
                </div>
            </div>
        </div>
        
        @if(session('error'))
            <div class="alert alert-danger mt-4">
                {{ session('error') }}
            </div>
        @endif

    </div>

    <!-- Scanner Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
    <script>
        let isScanning = false;

        document.addEventListener("DOMContentLoaded", function () {
            const startButton = document.getElementById("start-scanning");
            const stopButton = document.getElementById("stop-scanning");
            let scanner;

            function startScanning() {
                Quagga.init({
                    inputStream: {
                        name: "Live",
                        type: "LiveStream",
                        target: document.querySelector('#scanner-container'),
                        constraints: {
                            facingMode: "environment",
                            frameRate: { ideal: 30, max: 60 }
                        },
                    },
                    decoder: {
                        readers: ["code_128_reader"] // Use only the format you're using
                    },
                    locator: {
                        patchSize: "large",
                        halfSample: false
                    },
                    willReadFrequently: true,
                    detectionConfidence: 0.3,
                    locate: false,
                    numOfWorkers: navigator.hardwareConcurrency || 4,
                    frequency: 60
                    }, function (err) {
                    if (err) {
                        console.error("Quagga init error:", err);
                        return;
                    }
                    Quagga.start();
                    isScanning = true;
                    startButton.style.display = 'none';
                    stopButton.style.display = 'inline-block';
                });

                Quagga.onDetected(function (result) {
                    const code = result.codeResult.code;
                    console.log("Scanned code:", code);
                    document.getElementById("barcode").value = code;// Stop scanning after a successful scan
                    alert(code);
                    stopScanning(); 
                });
                Quagga.onProcessed(function (result) {
                    const drawingCtx = Quagga.canvas.ctx.overlay,
                        drawingCanvas = Quagga.canvas.dom.overlay;

                    if (result) {
                        if (result.boxes) {
                            drawingCtx.clearRect(0, 0, drawingCanvas.width, drawingCanvas.height);
                            result.boxes.filter(box => box !== result.box)
                                .forEach(box => {
                                    Quagga.ImageDebug.drawPath(box, { x: 0, y: 1 }, drawingCtx, {
                                        color: "green",
                                        lineWidth: 2
                                    });
                                });
                        }

                        if (result.box) {
                            Quagga.ImageDebug.drawPath(result.box, { x: 0, y: 1 }, drawingCtx, {
                                color: "#00F",
                                lineWidth: 2
                            });
                        }

                        if (result.codeResult && result.codeResult.code) {
                            Quagga.ImageDebug.drawPath(result.line, { x: 'x', y: 'y' }, drawingCtx, {
                                color: 'red',
                                lineWidth: 3
                            });
                        }
                    }
                });

            }

            function stopScanning() {
                if (isScanning) {
                    Quagga.stop();
                    isScanning = false;
                    startButton.style.display = 'inline-block';
                    stopButton.style.display = 'none';
                }
            }

            startButton.addEventListener('click', startScanning);
            stopButton.addEventListener('click', stopScanning);
        });
    </script>
</body>
</html>
@endsection
