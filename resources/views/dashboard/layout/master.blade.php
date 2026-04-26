
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Registration Management</h2>
                <p class="text-muted">Manage student enrollments and course data</p>
            </div>
            {{-- <button class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                <i class="bi bi-plus-circle me-2"></i> Register New Student
            </button> --}}
            @if(Auth::user()->role !== 'Student')
                <button class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                    <i class="bi bi-plus-circle me-2"></i> Register New Student
                </button>
            @endif
        </div>

        @include("dashboard.layout.total_section")
        {{-- <input type="text" id="studentTableSearch" class="form-control mb-2" placeholder="Search student..."> --}}
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
        </div> --}}

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold text-secondary">Recent Student</h5>
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
                            <th>STU_ID</th>
                            <th>Full Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Date of Birth</th>
                            <th>Course</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="searchTableBody">
                        @forelse ($students as $index => $student)
                        <tr>
                            <td class="text-danger fw-bold">{{ $index+1 }}</td>
                            <td>{{ $student->std_name }}</td>
                            @if ($student->std_phone)
                            <td style="max-width: 100px;" class="text-truncate" title="{{ $student->std_phone }}"
                                role="button"
                                data-bs-toggle="modal"
                                data-bs-target="#descModal{{ $student->_id }}">
                                {{ $student->std_phone }}
                            </td>

                            <div class="modal fade" id="descModal{{ $student->_id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ $student->std_name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{ $student->std_phone }}
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
                            <td>{{ $student->std_address }}</td>
                            <td>{{ $student->std_dob }}</td>

                            @if($student->course && $student->course->course_title)
                                <td>{{ $student->course->course_title }}</td>
                            @else
                                <td><span class="text-danger">N/A</span></td>
                            @endif

                            <td class="text-center">
                                {{-- <button type="button" class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#updateCourseModal{{ $student->_id }}"><i class="bi bi-pencil"></i></button> --}}
                                @if(Auth::user()->role !== 'Student')
                                {{-- Edit Button --}}
                                    <button type="button" class="btn btn-sm btn-outline-primary me-1" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#updateCourseModal{{ $student->_id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <div class="modal fade" id="updateCourseModal{{ $student->_id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog text-start">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Student</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('student.update', $student->_id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Full Name</label>
                                                            <input name="std_name" type="text" class="form-control" placeholder="Enter student name" value="{{ $student->std_name }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Phone</label>
                                                            <input name="std_phone" type="text" class="form-control" placeholder="Enter phone number" value="{{ $student->std_phone }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Address</label>
                                                            <input name="std_address" type="text" class="form-control" placeholder="Enter address" value="{{ $student->std_address }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Date of Birth</label>
                                                            <input name="std_dob" type="date" class="form-control" value="{{ $student->std_dob }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Select Course</label>
                                                            <select class="form-select @error('course_id') is-invalid @enderror" name="course_id" required>
                                                                @if ($courses->count() > 0)    
                                                                    <option value="" disabled {{ old('course_id') ? '' : 'selected' }}>Choose...</option>
                                                                    @foreach($courses as $course)
                                                                        <option value="{{ $course->_id }}" {{ old('course_id') == $course->_id ? 'selected' : '' }}>
                                                                            {{ $course->course_title }}
                                                                        </option>
                                                                    @endforeach
                                                                @else
                                                                    <option value="" disabled selected>No courses available - Please add courses first</option>
                                                                @endif
                                                            </select>
                                                            @error('course_id')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
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
                                        data-bs-target="#deleteModal{{ $student->_id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                    <!-- Modal (inside the loop, unique per row) -->
                                    <div class="modal fade" id="deleteModal{{ $student->_id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete <strong>{{ $student->std_name }}</strong>? This action cannot be undone.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('student.delete', $student->_id) }}" method="POST">
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

    <form action="{{ route('student.submit') }}" method="post">
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
                            <input name="std_name" type="text" class="form-control" placeholder="Enter student name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input name="std_phone" type="text" class="form-control" placeholder="Enter phone number">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input name="std_address" type="text" class="form-control" placeholder="Enter address">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input name="std_dob" type="date" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Select Course</label>
                            <select class="form-select @error('course_id') is-invalid @enderror" name="course_id">
                                <option value="" selected disabled>Choose...</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->course_title }}</option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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