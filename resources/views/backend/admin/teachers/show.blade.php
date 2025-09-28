@extends('backend.admin.layouts.app')


@section('title', 'Teacher Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Teacher Details</h3>
                    <div class="card-tools">
                        <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-primary btn-sm">Edit Teacher</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="text-center mb-3">
                                @if($teacher->profile_picture)
                                    <img src="{{ Storage::url($teacher->profile_picture) }}" alt="Profile Picture" class="img-fluid rounded-circle" style="max-width: 200px;">
                                @else
                                    <div class="bg-secondary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 200px; height: 200px;">
                                        <span class="text-white display-4">{{ substr($teacher->first_name, 0, 1) }}{{ substr($teacher->last_name, 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>

                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center">Status</span>
                                    <span class="info-box-number text-center text-{{ $teacher->is_active ? 'success' : 'danger' }}">
                                        {{ $teacher->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <p class="form-control-plaintext">{{ $teacher->first_name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <p class="form-control-plaintext">{{ $teacher->last_name ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <p class="form-control-plaintext">{{ $teacher->email }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <p class="form-control-plaintext">{{ $teacher->phone ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <p class="form-control-plaintext">{{ $teacher->gender ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <p class="form-control-plaintext">{{ $teacher->date_of_birth ? $teacher->date_of_birth->format('d M Y') : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Joining Date</label>
                                        <p class="form-control-plaintext">{{ $teacher->joining_date ? $teacher->joining_date->format('d M Y') : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Qualification</label>
                                        <p class="form-control-plaintext">{{ $teacher->qualification ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Specialization</label>
                                        <p class="form-control-plaintext">{{ $teacher->specialization ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <p class="form-control-plaintext">{{ $teacher->address ?? 'N/A' }}</p>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>City</label>
                                        <p class="form-control-plaintext">{{ $teacher->city ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>State</label>
                                        <p class="form-control-plaintext">{{ $teacher->state ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>ZIP Code</label>
                                        <p class="form-control-plaintext">{{ $teacher->zip ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h4>Assigned Subjects</h4>
                            @if($teacher->subjects->count() > 0)
                                <ul class="list-group">
                                    @foreach($teacher->subjects as $subject)
                                        <li class="list-group-item">{{ $subject->name }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted">No subjects assigned.</p>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <h4>Assigned Class Sections</h4>
                            @if($teacher->classSections->count() > 0)
                                <ul class="list-group">
                                    @foreach($teacher->classSections as $classSection)
                                        <li class="list-group-item">
                                            {{ $classSection->class->name }} - {{ $classSection->section->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted">No class sections assigned.</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
