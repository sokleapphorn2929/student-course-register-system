<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4 p-md-5">
                        
                        <h2 class="card-title text-center mb-4 fw-semibold">Create account</h2>
                        <p class="text-center text-muted mb-4">Please fill in the details below</p>
                        
                        <!-- Error Message -->
                        @error("email")
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror

                        <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Profile Picture Upload -->
                            <div class="mb-4 text-center">
                                <label class="form-label fw-medium d-block mb-3">
                                    <i class="bi bi-camera me-1"></i> Profile Picture
                                </label>
                                
                                <!-- Preview Image -->
                                <div class="mb-3">
                                    <img id="profilePreview" 
                                         src="https://i.pinimg.com/736x/32/9b/54/329b54d07444f009b0634f438db9a449.jpg" 
                                         alt="Profile Preview" 
                                         class="rounded-circle img-thumbnail"
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                </div>
                                
                                <!-- File Input -->
                                <div class="mb-2">
                                    <input type="file" 
                                           class="form-control" 
                                           id="profileImage" 
                                           name="profile_pic" 
                                           accept="image/*"
                                           onchange="previewImage(this)">
                                    <div class="form-text">Accepted formats: JPG, PNG, GIF. Max size: 2MB</div>
                                </div>
                                
                                <!-- Remove Image Button -->
                                <div>
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-danger" 
                                            onclick="removeImage()">
                                        <i class="bi bi-trash"></i> Remove Image
                                    </button>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="username" class="form-label fw-medium">
                                    <i class="bi bi-person-circle me-1"></i> Username
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg rounded-3" 
                                       id="username" 
                                       name="username" 
                                       placeholder="e.g., johndoe_123" 
                                       value="{{ old('username') }}"
                                       required>
                                <div class="form-text">Your unique public name.</div>
                                @error('username')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="email" class="form-label fw-medium">
                                    <i class="bi bi-envelope me-1"></i> Email address
                                </label>
                                <input type="email" 
                                       class="form-control form-control-lg rounded-3" 
                                       id="email" 
                                       name="email" 
                                       placeholder="name@example.com" 
                                       value="{{ old('email') }}"
                                       required>
                                <div class="form-text">We'll never share your email with anyone else.</div>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="role" class="form-label fw-medium">
                                    <i class="bi bi-person-badge me-1"></i> Register as
                                </label>
                                <select class="form-select form-select-lg rounded-3" id="role" name="role" required>
                                    <option value="" disabled selected">Select your role</option>
                                    <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                                    <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                                </select>
                                @error('role')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="inp-pw" class="form-label fw-medium">
                                    <i class="bi bi-lock me-1"></i> Password
                                </label>
                                <div class="input-group">
                                    <input id="inp-pw" 
                                           type="password" 
                                           class="form-control form-control-lg" 
                                           name="password"
                                           placeholder="••••••••" 
                                           aria-describedby="btn-pw" 
                                           required>
                                    <button onclick="ShowHide()" class="btn btn-outline-secondary" type="button" id="btn-pw">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </div>
                                <div class="form-text">At least 8 characters recommended.</div>
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <hr class="my-4">
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg rounded-3">
                                    <i class="bi bi-person-plus-fill me-2"></i> Register
                                </button>
                            </div>
                            
                            <p class="text-center text-muted mt-4 mb-0 small">
                                By registering you agree to our <a href="#" class="text-decoration-none">Terms</a>.
                            </p>
                        </form>
                        
                        
                        
                    </div>
                </div> 
                
                <div class="text-center mt-4">
                    <span class="text-secondary">Already have an account? </span>
                    <a href="{{ route("login") }}" class="text-primary fw-medium text-decoration-none">Login</a>
                </div>
                
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const pw_inp = document.getElementById("inp-pw");
        const pw_btn = document.getElementById("btn-pw");

        function ShowHide() {
            if (pw_inp.type === "password") {
                pw_inp.type = "text";
                pw_btn.innerHTML = "<i class='bi bi-eye-slash-fill'></i>"
            }
            else {
                pw_inp.type = "password";
                pw_btn.innerHTML = "<i class='bi bi-eye-fill'></i>"
            }
        }
        
        function previewImage(input) {
            const preview = document.getElementById('profilePreview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = 'https://i.pinimg.com/736x/32/9b/54/329b54d07444f009b0634f438db9a449.jpg';
            }
        }
        
        function removeImage() {
            const fileInput = document.getElementById('profileImage');
            const preview = document.getElementById('profilePreview');
            
            fileInput.value = '';
            preview.src = 'https://i.pinimg.com/736x/32/9b/54/329b54d07444f009b0634f438db9a449.jpg';
        }
    </script>
</body>
</html>