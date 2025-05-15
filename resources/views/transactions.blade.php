@extends('layouts.app')

@section('title', 'Transactions')

@section('content')
<div class="container-fluid py-4">
    <!-- Header with Search and Filters -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold text-primary mb-0">
                <i class="bi bi-credit-card-2-back-fill me-2"></i>Transaction Records
            </h2>
            <p class="text-muted mb-0">View and manage all payment transactions</p>
        </div>
        
        <div class="d-flex flex-column flex-md-row gap-2 w-100 w-md-auto">
            <!-- Search Input -->
            <div class="flex-grow-1">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" 
                           class="form-control border-start-0" 
                           placeholder="Search transactions...">
                    <button class="btn btn-outline-secondary" type="button">
                        Filter
                    </button>
                </div>
            </div>
            
            <!-- Export Button -->
            <button class="btn btn-primary d-flex align-items-center">
                <i class="bi bi-download me-2"></i> Export
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Transactions</h6>
                            <h3 class="mb-0">{{ $transactions->total() }}</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="bi bi-receipt text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Amount</h6>
                            <h3 class="mb-0">₱{{ number_format($totalAmount, 2) }}</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded">
                            <i class="bi bi-cash-coin text-success fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Paid</h6>
                            <h3 class="mb-0">{{ $paidCount }}</h3>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded">
                            <i class="bi bi-check-circle text-info fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Pending</h6>
                            <h3 class="mb-0">{{ $pendingCount }}</h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded">
                            <i class="bi bi-clock text-warning fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Reference #</th>
                            <th>Student</th>
                            <th>Amount</th>
                            <th>Term</th>
                            <th>Status</th>
                            <th>Cashier</th>
                            <th>Method</th>
                            <th class="pe-4">Date</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                        <tr>
                            <td class="ps-4 fw-semibold">{{ $transaction->reference_number }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                            <i class="bi bi-person-fill"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">{{ $transaction->student->name }}</h6>
                                        <small class="text-muted">{{ $transaction->student->student_number }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="fw-semibold">₱{{ number_format($transaction->amount, 2) }}</td>
                            <td>
                                <span class="badge bg-light text-dark border">{{ $transaction->term }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ 
                                    $transaction->status == 'Paid' ? 'success' : 
                                    ($transaction->status == 'Pending' ? 'warning' : 
                                    'danger') 
                                }}">
                                    {{ $transaction->status }}
                                </span>
                            </td>
                            <td>{{ $transaction->cashier->name }}</td>
                            <td>
                                <span class="badge bg-light text-dark border text-capitalize">
                                    {{ $transaction->payment_method }}
                                </span>
                            </td>
                            <td>{{ optional($transaction->created_at)->format('M d, Y') }}</td>
                            <td class="text-end pe-4">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="bi bi-eye me-2"></i> View Details
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="bi bi-receipt me-2"></i> Print Receipt
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item text-danger" href="#">
                                                <i class="bi bi-trash me-2"></i> Void Transaction
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <div class="py-4">
                                    <i class="bi bi-receipt text-muted" style="font-size: 3rem;"></i>
                                    <h5 class="mt-3">No transactions found</h5>
                                    <p class="text-muted">There are no transactions to display at this time</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($transactions->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of {{ $transactions->total() }} entries
                    </div>
                    {{ $transactions->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        color: #6c757d;
    }
    
    .table td {
        vertical-align: middle;
    }
    
    .badge.bg-light {
        color: #495057 !important;
        border: 1px solid #dee2e6;
    }
    
    .dropdown-toggle::after {
        display: none;
    }
</style>
@endsection