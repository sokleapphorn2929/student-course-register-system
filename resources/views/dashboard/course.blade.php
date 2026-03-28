<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student-Course Register System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    @include("dashboard.layout.header")
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Course Management</h2>
                <p class="text-muted">Manage student enrollments and course data</p>
            </div>
            <button type="submit" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                <i class="bi bi-plus-circle me-2"></i> Add New Course
            </button>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm bg-primary text-white">
                    <div class="card-body">
                        <h6>Total Students</h6>
                        <h3 class="fw-bold">1,240</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm bg-success text-white">
                    <div class="card-body">
                        <h6>Total Courses</h6>
                        <h3 class="fw-bold">{{ $courses->count() }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm bg-warning text-dark">
                    <div class="card-body">
                        <h6>Pending Invoices</h6>
                        <h3 class="fw-bold">12</h3>
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
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold text-secondary">Recent Course</h5>
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
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($courses as $index => $course)
                        <tr>
                            <td class="text-danger fw-bold">{{ $index+1 }}</td>
                            <td>{{ $course->course_title }}</td>
                            @if ($course->course_description)
                            <td style="max-width: 200px;" class="text-truncate" title="{{ $course->course_description }}">
                                {{ $course->course_description }}
                            </td>
                            @else
                            <td>None</td>
                            @endif
                            <td class="fw-bold text-primary">{{ $course->course_price }}$</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#updateCourseModal{{ $course->_id }}"><i class="bi bi-pencil"></i></button>

                                <div class="modal fade" id="updateCourseModal{{ $course->_id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog text-start">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update Course</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('course.update', $course->_id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Course Title</label>
                                                        <input type="text" class="form-control" placeholder="Enter title" name="course_title" id="course_title" value="{{ $course->course_title }}" required>
                                                        <div class="invalid-feedback" id="course_title_error"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Course Description</label>
                                                        <textarea class="form-control" placeholder="Enter description" name="course_description" id="course_description" rows="3">{{ $course->course_description }}</textarea>
                                                        <div class="invalid-feedback" id="course_description_error"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Course Price</label>
                                                        <input type="number" step="0.01" class="form-control" placeholder="Enter price" name="course_price" id="course_price" value="{{ $course->course_price }}" required>
                                                        <div class="invalid-feedback" id="course_price_error"></div>
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
                                    data-bs-target="#deleteModal{{ $course->_id }}">
                                    <i class="bi bi-trash"></i>
                                </button>

                                <!-- Modal (inside the loop, unique per row) -->
                                <div class="modal fade" id="deleteModal{{ $course->_id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirm Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete <strong>{{ $course->name }}</strong>? This action cannot be undone.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('course.delete', $course->_id) }}" method="POST">
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

    <div class="modal fade" id="addCourseModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="courseForm" action="{{ route('course') }}" method="POST"> {{-- ✅ moved outside modal-body --}}
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Course Title</label>
                            <input type="text" class="form-control" placeholder="Enter title" name="course_title" id="course_title">
                            <div class="invalid-feedback" id="course_title_error"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Course Description</label>
                            <textarea class="form-control" placeholder="Enter description" name="course_description" id="course_description" rows="3"></textarea>
                            <div class="invalid-feedback" id="course_description_error"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Course Price</label>
                            <input type="number" step="0.01" class="form-control" placeholder="Enter price" name="course_price" id="course_price">
                            <div class="invalid-feedback" id="course_price_error"></div>
                        </div>
                    </div> {{-- ✅ modal-body closes here --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveCourseBtn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@include("dashboard.layout.footer")