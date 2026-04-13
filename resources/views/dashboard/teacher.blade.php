<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SCRS - Teacher</title>
    <link rel="icon" type="image/png" href="https://i.postimg.cc/sXXb7q2w/scrs.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    @include("dashboard.layout.header")
    
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Teacher Management</h2>
                <p class="text-muted">Manage student enrollments and course data</p>
            </div>
            <button class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                <i class="bi bi-plus-circle me-2"></i> Register New Teacher
            </button>
        </div>

        @include("dashboard.layout.total_section")
        {{-- <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm bg-primary text-white">
                    <div class="card-body">
                        <h6>Total Students</h6>
                        <h3 class="fw-bold">{{ $students->count() ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm bg-success text-white">
                    <div class="card-body">
                        <h6>Total Courses</h6>
                        <h3 class="fw-bold">{{ $courses->count() ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm bg-warning text-dark">
                    <div class="card-body">
                        <h6>Total Teachers</h6>
                        <h3 class="fw-bold">{{ $teachers->count() ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm bg-info text-white">
                    <div class="card-body">
                        <h6>New Requests</h6>
                        <h3 class="fw-bold">85</h3>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold text-secondary">Recent Teacher</h5>
            </div>
            <div class="table-responsive">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>TCH_ID</th>
                            <th>Full Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Date of Birth</th>
                            <th>Hired Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="searchTableBody">
                        @forelse ($teachers as $index => $teacher)
                        <tr>
                            <td class="text-danger fw-bold">{{ $index+1 }}</td>
                            <td>{{ $teacher->teacher_name }}</td>
                            @if ($teacher->teacher_phone)
                            <td style="max-width: 100px;" class="text-truncate" title="{{ $teacher->teacher_phone }}"
                                role="button"
                                data-bs-toggle="modal"
                                data-bs-target="#descModal{{ $teacher->_id }}">
                                {{ $teacher->teacher_phone }}
                            </td>

                            <div class="modal fade" id="descModal{{ $teacher->_id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ $teacher->teacher_name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{ $teacher->teacher_phone }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <td>None</td>
                        @endif
                            <td>{{ $teacher->teacher_address }}</td>
                            <td>{{ $teacher->teacher_dob }}</td>
                            <td>{{ $teacher->hired_date }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#updateCourseModal{{ $teacher->_id }}"><i class="bi bi-pencil"></i></button>

                                <div class="modal fade" id="updateCourseModal{{ $teacher->_id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog text-start">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update Teacher</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('teacher.update', $teacher->_id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Full Name</label>
                                                        <input name="teacher_name" type="text" class="form-control" placeholder="Enter student name" value="{{ $teacher->teacher_name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Phone</label>
                                                        <input name="teacher_phone" type="text" class="form-control" placeholder="Enter phone number" value="{{ $teacher->teacher_phone }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Address</label>
                                                        <input name="teacher_address" type="text" class="form-control" placeholder="Enter address" value="{{ $teacher->teacher_address }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Date of Birth</label>
                                                        <input name="teacher_dob" type="date" class="form-control" value="{{ $teacher->teacher_dob }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Hired Date</label>
                                                        <input name="hired_date" type="date" class="form-control" value="{{ $teacher->hired_date }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" id="saveCourseBtn">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Trigger -->
                                <button class="btn btn-sm btn-outline-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $teacher->_id }}">
                                    <i class="bi bi-trash"></i>
                                </button>

                                <!-- Modal (inside the loop, unique per row) -->
                                <div class="modal fade" id="deleteModal{{ $teacher->_id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirm Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete <strong>{{ $teacher->std_name }}</strong>? This action cannot be undone.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('teacher.delete', $teacher->_id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No students found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <form action="{{ route('teacher.submit') }}" method="post">
        @csrf
        <div class="modal fade" id="addStudentModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Registration</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input name="teacher_name" type="text" class="form-control" placeholder="Enter teacher name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input name="teacher_phone" type="text" class="form-control" placeholder="Enter phone number">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input name="teacher_address" type="text" class="form-control" placeholder="Enter address">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input name="teacher_dob" type="date" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hired Date</label>
                            <input name="hired_date" type="date" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@include("dashboard.layout.footer")