@extends('layouts.app')

@section('title','Students')

@section('content')
    <h1>Students</h1>

    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addUserModal">
        + Add User
    </button>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="/addStudent" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addUserModalLabel">User Information</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <label for="student_number">Student Number:</label>
                        <input type="number" name="student_number" id="student_number" class="form-control mb-3" placeholder="Student Number" required>
                        <!-- Full Name -->
                        <label for="fullname">Full name:</label>
                        <input type="text" name="name" id="name" class="form-control mb-3" placeholder="John Doe" required>

                        <!-- Password -->
                        <label for="phone">Phone:</label>
                        <input type="number" name="phone" id="phone" class="form-control mb-3" placeholder="Phone" required>

                        <!-- Email -->
                        <label for="email">Email Address:</label>
                        <input type="email" name="email" id="email" class="form-control mb-3" placeholder="Email" required>

                        <label for="address">Current Address:</label>
                        <input type="address" name="address" id="address" class="form-control mb-3" placeholder="Address" required>
                        <!-- User Type -->
                        <label for="usertype">Program:</label><br>
                        @forelse ($programs as $program )
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="program_id" id="program_id" value="{{$program->id}}" checked>
                            <label class="form-check-label" for="program_name">{{$program->name}}</label>
                        </div>
                        @empty
                            <p>No Program Available</p>
                        @endforelse
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Student Table -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Student No.</th>
                    <th>Name</th>
                    <th>Program</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Registered At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                <tr>
                    <td>{{ $student->student_number}}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->program->name}}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->address }}</td>
                    <td>{{ optional($student->created_at)->format('M d, Y') }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <button type="button" class="btn btn-sm btn-info flex-fill" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <i class="bi bi-search"></i> View
                            </button>
                    
                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Student Details</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Remaining Balance:</p>
                                            <table class="table table-hover table-bordered align-middle">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th>Term:</th>
                                                        <th>Permit No.</th>
                                                        <th>Status</th>
                                                        <th>Payment ID:</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Prelim</td>
                                                        <td>112</td>
                                                        <td>Paid</td>
                                                        <td>332</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <a href="/payment">
                                                <button type="button" class="btn btn-primary">Payment</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                            @if (Auth::check() && Auth::user()->usertype->id == 1)
                                <button class="btn btn-sm btn-primary flex-fill">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                    
                                <form action="" method="POST" class="flex-fill">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger w-100">
                                        <i class="bi bi-trash3"></i> Delete
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>                    
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No Student found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection