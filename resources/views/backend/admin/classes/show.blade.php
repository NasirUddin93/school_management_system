@extends('backend.admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Class Details: {{ $class->name }}</h4>
                    <div class="btn-group">
                        <a href="{{ route('classes.edit', $class->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('classes.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Basic Information</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th width="40%">Class Name:</th>
                                    <td>{{ $class->name }}</td>
                                </tr>
                                <tr>
                                    <th>Order Number:</th>
                                    <td>{{ $class->order_number }}</td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td>{{ $class->description ?: 'No description' }}</td>
                                </tr>
                                {{-- <tr>
                                    <th>Created At:</th>
                                    <td>{{ $class->created_at->format('M d, Y h:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At:</th>
                                    <td>{{ $class->updated_at->format('M d, Y h:i A') }}</td>
                                </tr> --}}
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h5>Class Sections ({{ $class->classSections->count() }})</h5>
                            @if($class->classSections->count() > 0)
                                <ul class="list-group">
                                    @foreach($class->classSections as $section)
                                        <li class="list-group-item">{{ $section->name }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted">No sections assigned to this class.</p>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <h5>Fee Structures ({{ $class->feeStructures->count() }})</h5>
                            @if($class->feeStructures->count() > 0)
                                <ul class="list-group">
                                    @foreach($class->feeStructures as $fee)
                                        <li class="list-group-item">
                                            {{ $fee->fee_type }}: ${{ number_format($fee->amount, 2) }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted">No fee structures defined for this class.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
