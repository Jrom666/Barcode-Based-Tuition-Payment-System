@extends('layouts.app')

@section('title','Transactions')

@section('content')
<div>   
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">👥 Transactions</h2>
    </div>

    <!-- Student Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Reference No.</th>
                            <th>Student</th>
                            <th>Amount</th>
                            <th>Term</th>
                            <th>Status</th>
                            <th>Cashier</th>
                            <th>Payment Method</th>
                            <th>Payment Data</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->reference_number }}</td>
                            <td>{{ $transaction->student->name }}</td>
                            <td>₱{{ number_format($transaction->amount, 2)}}</td>
                            <td>{{ $transaction->term }}</td>
                            <td>{{ $transaction->status }}</td>
                            <td>{{ $transaction->cashier->name}}</td>
                            <td>{{ $transaction->payment_method }}</td>
                            <td>{{ optional($transaction->created_at)->format('M d, Y') }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                    <!-- View Button -->
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewStudentModal{{ $transaction->id }}">
                                        <i class="bi bi-search"></i> View
                                    </button>
        
                                    <!-- View Modal -->
        
                                    @if (Auth::check() && Auth::user()->usertype->id == 1)
                                        <!-- Edit Button -->
                                        <button class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </button>
        
                                        <!-- Delete Form -->
                                        <form action="" method="POST" onsubmit="return confirm('Are you sure?')" class="d-inline">
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
