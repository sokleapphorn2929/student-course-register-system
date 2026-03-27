
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><i class="bi bi-mortarboard-fill me-2"></i>SCR System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="{{ route("dashboard") }}">Students</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Courses</a></li>
                <li class="nav-item me-3"><a class="nav-link" href="#">Enrollment</a></li>

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{-- <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px; font-size: 0.8rem;">
                                {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                            </div>
                            <span class="fw-bold text-light">{{ strtoupper(Auth::user()->username) }}</span> --}}

                            @if(Auth::user()->profile_pic)
                                <img 
                                    src="{{ asset('storage/' . Auth::user()->profile_pic) }}" 
                                    alt="{{ Auth::user()->username }}"
                                    class="rounded-circle me-2 object-fit-cover"
                                    style="width: 30px; height: 30px;"
                                >
                            @else
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" 
                                    style="width: 30px; height: 30px; font-size: 0.8rem;">
                                    {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                                </div>
                            @endif

                            <span class="fw-bold text-light">{{ strtoupper(Auth::user()->username) }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="profileDropdown">
                            <li><h6 class="dropdown-header">User Settings</h6></li>
                            <li><a class="dropdown-item" href="{{ route("account") }}"><i class="bi bi-person me-2"></i> My Profile</a></li>
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