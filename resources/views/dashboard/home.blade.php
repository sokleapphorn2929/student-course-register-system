{{-- <form method="post" action="{{ route("logout") }}">
    @csrf
    @auth
    <p>Welcome, {{ Auth::user()->username }}!</p>
    <button type="submit">Logout</button>
    @endauth
    @guest
    <a href="/login">Login</a>
    <a href="/register">Register</a>
    @endguest
<form/> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student-Course Register System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><i class="bi bi-mortarboard-fill me-2"></i>SCR System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="#">Students</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Courses</a></li>
                <li class="nav-item me-3"><a class="nav-link" href="#">Enrollment</a></li>

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px; font-size: 0.8rem;">
                                {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                            </div>
                            <span class="fw-bold text-light">{{ strtoupper(Auth::user()->username) }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="profileDropdown">
                            <li><h6 class="dropdown-header">User Settings</h6></li>
                            <li><a class="dropdown-item" href=""><i class="bi bi-person me-2"></i> My Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger d-flex align-items-center">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Registration Management</h2>
                <p class="text-muted">Manage student enrollments and course data</p>
            </div>
            <button class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                <i class="bi bi-plus-circle me-2"></i> Register New Student
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
                        <h6>Active Courses</h6>
                        <h3 class="fw-bold">48</h3>
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
                <h5 class="mb-0 fw-bold text-secondary">Recent Registrations</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Student ID</th>
                            <th>Full Name</th>
                            <th>Course</th>
                            <th>Reg. Date</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#STU-001</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">JD</div>
                                    <span>John Doe</span>
                                </div>
                            </td>
                            <td>Advanced PHP/Laravel</td>
                            <td>Oct 24, 2025</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#STU-002</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">AS</div>
                                    <span>Alice Smith</span>
                                </div>
                            </td>
                            <td>Network Simulation</td>
                            <td>Nov 12, 2025</td>
                            <td><span class="badge bg-warning text-dark">Pending</span></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white text-center py-3">
                <a href="#" class="text-decoration-none small fw-bold">View All Students</a>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Registration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" placeholder="Enter student name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Select Course</label>
                            <select class="form-select">
                                <option selected>Choose...</option>
                                <option value="1">Backend Laravel</option>
                                <option value="2">Frontend React</option>
                                <option value="3">Cisco Networking</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>