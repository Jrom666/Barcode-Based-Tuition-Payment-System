@extends('layouts.app')

@section('title','Students')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">🎓 Student Management</h2>
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
            <i class="bi bi-plus-lg me-1"></i>Add Student
        </button>
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('students.search') }}" method="GET">
                <div class="input-group">
                    <input type="text" 
                           name="search" 
                           class="form-control" 
                           placeholder="Search by name, student number, phone or program..."
                           value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-search"></i> Search
                    </button>
                    @if(request('search'))
                        <a href="{{ route('students.search') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x"></i> Clear
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Add Student Modal (unchanged) -->
    <div class="modal fade" id="addStudentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="/addStudent" method="POST">
                @csrf
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="student_number" class="form-label">Student Number</label>
                                <input type="number" name="student_number" id="student_number" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Family Name, First Name, Middle Name" required>
                            </div>

                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="number" name="phone" id="phone" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" name="address" id="address" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label d-block">Program</label>
                                @forelse ($programs as $index => $program)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="program_id" id="program_{{ $program->id }}" value="{{ $program->id }}" {{ $index === 0 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="program_{{ $program->id }}">{{ $program->name }}</label>
                                </div>
                                @empty
                                <p>No programs available.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Student Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Student No.</th>
                            <th>Name</th>
                            <th>Program</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Registered At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                        <tr>
                            <td>{{ $student->student_number }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->program->name }}</td>
                            <td>{{ $student->phone }}</td>
                            <td>{{ $student->address }}</td>
                            <td>{{ optional($student->created_at)->format('M d, Y') }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                    <!-- View Button -->
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewStudentModal{{ $student->id }}">
                                        <i class="bi bi-search"></i> View
                                    </button>
        
                                    <!-- View Modal -->
                                    <div class="modal fade" id="viewStudentModal{{ $student->id }}" tabindex="-1" aria-labelledby="viewStudentModalLabel{{ $student->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="viewStudentModalLabel{{ $student->id }}">Student Details - {{ $student->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-4">
                                                        <h4 class="{{ ($student->program->fee - $student->payments->sum('amount')) > 0 ? 'text-danger' : 'text-success' }}">
                                                            Balance: ₱{{ number_format($student->program->fee - $student->payments->sum('amount'), 2) }}
                                                        </h4>
                                                        <p class="mb-0">Total Tuition: ₱{{ number_format($student->program->fee, 2) }}</p>
                                                        <p>Total Paid: ₱{{ number_format($student->payments->sum('amount'), 2) }}</p>
                                                    </div>
                                                    
                                                    <h5 class="mb-3">Payment History</h5>
                                                    <table class="table table-hover table-bordered align-middle">
                                                        <thead class="table-primary">
                                                            <tr>
                                                                <th>Term</th>
                                                                <th>Reference No.</th>
                                                                <th>Amount</th>
                                                                <th>Status</th>
                                                                <th>Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($student->payments as $payment)
                                                            <tr>
                                                                <td>{{ $payment->term }}</td>
                                                                <td>{{ $payment->reference_number }}</td>
                                                                <td>₱{{ number_format($payment->amount, 2) }}</td>
                                                                <td>
                                                                    <span class="badge bg-{{ $payment->status == 'Paid' ? 'success' : ($payment->status == 'Partial' ? 'warning' : 'danger') }}">
                                                                        {{ $payment->status }}
                                                                    </span>
                                                                </td>
                                                                <td>{{ $payment->created_at->format('M d, Y') }}</td>
                                                            </tr>
                                                            @empty
                                                            <tr>
                                                                <td colspan="5" class="text-center py-4 text-muted">No payment records found</td>
                                                            </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="/payment?student_id={{ $student->id }}" class="btn btn-primary">
                                                        <i class="bi bi-credit-card me-1"></i> Make Payment
                                                    </a>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        
                                    @if (Auth::check() && Auth::user()->usertype->id == 1)
                                        <!-- Edit Button -->
                                        <button class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </button>
        
                                        <!-- Delete Form -->
                                        <form action="/delete/student/{{ $student->id }}" method="POST" onsubmit="return confirm('Are you sure?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash3"></i> Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No students found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection