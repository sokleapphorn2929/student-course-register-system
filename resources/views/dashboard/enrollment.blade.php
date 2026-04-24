<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SCRS - Enrollment</title>
    <link rel="icon" type="image/png" href="https://i.postimg.cc/sXXb7q2w/scrs.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    @include("dashboard.layout.header")
    
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Enrollment Management</h2>
                <p class="text-muted">Manage student enrollments and course data</p>
            </div>
            @if (Auth::user()->role === "Admin")    
                <button class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                    <i class="bi bi-plus-circle me-2"></i>Add Enrollment
                </button>
            @endif
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
                <h5 class="mb-0 fw-bold text-secondary">Recent Enrollment</h5>
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
                            <th>ENROLL_ID</th>
                            <th>Student Name</th>
                            <th>Course Title</th>
                            <th>Status</th>
                            <th>Enrolled_At</th>
                            <th>Payment Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="searchTableBody">
                        @forelse ($enrollments as $index => $enrollment)
                        <tr>
                            <td class="text-danger fw-bold">{{ $index+1 }}</td>
                            <td>{{ $enrollment->student->std_name }}</td>
                            <td>{{ $enrollment->course->course_title }}</td>
                            <td>
                                @php
                                    $statusColor = [
                                        'active'    => 'success',
                                        'pending'   => 'warning',
                                        'completed' => 'primary',
                                        'dropped'   => 'danger',
                                    ][$enrollment->status] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $statusColor }}">{{ ucfirst($enrollment->status) }}</span>
                            </td>
                            <td>{{ $enrollment->enrolled_at }}</td>
                            <td>
                                @php
                                    $statusColor = [
                                        'paid'    => 'success',
                                        'unpaid'   => 'danger',
                                        'refunded' => 'warning',
                                    ][$enrollment->payment_status] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $statusColor }}">{{ ucfirst($enrollment->payment_status) }}</span>
                            </td>
                            <td class="text-center">
                                @if (Auth::user()->role !== "Student")
                                
                                    <button type="button" class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#updateCourseModal{{ $enrollment->_id }}"><i class="bi bi-pencil"></i></button>

                                    <div class="modal fade" id="updateCourseModal{{ $enrollment->_id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog text-start">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Teacher</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('enrollment.update', $enrollment->_id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Student Name</label>
                                                            <input type="text" class="form-control mb-1" 
                                                                id="studentSearch_{{ $enrollment->_id }}" 
                                                                placeholder="Search student...">
                                                            <select name="std_id" class="form-select" 
                                                                id="studentSelect_{{ $enrollment->_id }}" required>
                                                                <option value="" disabled>Choose...</option>
                                                                @foreach($students as $student)
                                                                    <option value="{{ $student->_id }}" 
                                                                        {{ old('std_id', $enrollment->std_id) == $student->_id ? 'selected' : '' }}>
                                                                        {{ $student->std_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Select Course</label>
                                                            <select class="form-select @error('course_id') is-invalid @enderror" name="course_id" required>
                                                                <option value="" disabled>Choose...</option>
                                                                @foreach($courses as $course)
                                                                    <option value="{{ $course->_id }}" {{ old('course_id') == $course->_id ? 'selected' : '' }}>
                                                                        {{ $course->course_title }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('course_id')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Status</label>
                                                            <select class="form-select" name="status" required>
                                                                <option value="" disabled>Choose...</option>
                                                                @foreach($statuses as $status)
                                                                    <option value="{{ $status->_id }}"
                                                                        {{ old('status', $enrollment->status) == $status->_id ? 'selected' : '' }}>
                                                                        {{ $status->status_title }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Enrolled At</label>
                                                            <input name="enrolled_at" type="date" class="form-control" value="{{ $enrollment->enrolled_at }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Payment Status</label>
                                                            <select class="form-select" name="payment_status" required>
                                                                <option value="" disabled>Choose...</option>
                                                                @foreach(['paid' => 'Paid', 'unpaid' => 'Unpaid', 'refunded' => 'Refunded'] as $val => $label)
                                                                    <option value="{{ $val }}"
                                                                        {{ old('payment_status', $enrollment->payment_status) == $val ? 'selected' : '' }}>
                                                                        ● {{ $label }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
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
                                    @if (Auth::user()->role === "Admin")    
                                        <button class="btn btn-sm btn-outline-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $enrollment->_id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    @endif

                                    <!-- Modal (inside the loop, unique per row) -->
                                    <div class="modal fade" id="deleteModal{{ $enrollment->_id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete <strong>{{ $enrollment->std_name }}</strong>? This action cannot be undone.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('enrollment.delete', $enrollment->_id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-muted small">View only</span>
                                @endif
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

    <form action="{{ route('enrollment.submit') }}" method="post">
        @csrf
        <div class="modal fade" id="addStudentModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Enrollment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Student Name</label>
                            <input type="text" class="form-control mb-1" 
                                id="studentSearch_add" 
                                placeholder="Search student...">
                            <select name="std_id" class="form-select" 
                                id="studentSelect_add" required>
                                <option value="" disabled selected>Choose...</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->_id }}">{{ $student->std_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Select Course</label>
                            <select class="form-select @error('course_id') is-invalid @enderror" name="course_id" required>
                                <option value="" disabled selected>Choose...</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->_id }}" {{ old('course_id') == $course->_id ? 'selected' : '' }}>
                                        {{ $course->course_title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" required>
                                <option value="" disabled selected>Choose...</option>
                                <option value="pending" class="text-warning">● Pending</option>
                                <option value="active" class="text-success">● Active</option>
                                <option value="completed" class="text-primary">● Completed</option>
                                <option value="dropped" class="text-danger">● Dropped</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Enrolled At</label>
                            <input name="enrolled_at" type="date" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Payment Status</label>
                            <select class="form-select" name="payment_status" required>
                                <option value="" disabled selected>Choose...</option>
                                <option value="paid" class="text-success">● Paid</option>
                                <option value="unpaid" class="text-danger">● Unpaid</option>
                                <option value="refunded" class="text-primary">● Refunded</option>
                            </select>
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

    {{-- <script>
        document.addEventListener('input', function (e) {
            if (!e.target.matches('[id^="studentSearch_"]')) return;
            const search = e.target.value.toLowerCase();
            const suffix = e.target.id.replace('studentSearch_', '');
            const select = document.getElementById('studentSelect_' + suffix);
            if (!select) return;
            select.querySelectorAll('option').forEach(option => {
                option.style.display = option.text.toLowerCase().includes(search) ? '' : 'none';
            });
        });
    </script> --}}
@include("dashboard.layout.footer")