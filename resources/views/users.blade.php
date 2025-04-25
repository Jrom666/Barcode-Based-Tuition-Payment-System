@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">All Users</h2>

    <!-- Add User Button -->
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addUserModal">
        + Add User
    </button>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="/register" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addUserModalLabel">User Information</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Full Name -->
                        <label for="fullname">Full name:</label>
                        <input type="text" name="name" id="fullname" class="form-control mb-3" placeholder="John Doe" required>

                        <!-- Username -->
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" class="form-control mb-3" placeholder="Username" required>

                        <!-- Password -->
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" class="form-control mb-3" placeholder="Password" required>

                        <!-- Email -->
                        <label for="email">Email Address:</label>
                        <input type="email" name="email" id="email" class="form-control mb-3" placeholder="Email" required>

                        <!-- User Type -->
                        <label for="usertype">User Type:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="usertype_id" id="cashier" value="2" checked>
                            <label class="form-check-label" for="cashier">Cashier</label>
                        </div>
                        <div class="form-check form-check-inline mb-3">
                            <input class="form-check-input" type="radio" name="usertype_id" id="admin" value="1">
                            <label class="form-check-label" for="admin">Admin</label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- User Table -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Registered At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->usertype->name ?? 'N/A' }}</td>
                    <td>{{ optional($user->created_at)->format('M d, Y') }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm btn-primary">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                            <form action="/delete/{{$user->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash3"></i> Delete
                                </button> 
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No users found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
