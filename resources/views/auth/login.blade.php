<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4 p-md-5">
                        
                        <h2 class="card-title text-center mb-4 fw-semibold">Login to account</h2>
                        <p class="text-center text-muted mb-4">Please fill in the details below</p>
                        
                        <!-- Error Message -->
                        @error("email")
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror

                        <form action="{{ route('login') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            
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
                            </div>
                            
                            <hr class="my-4">
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg rounded-3">
                                    <i class="bi bi-send"></i> Login
                                </button>
                            </div>
                            
                            <p class="text-center text-muted mt-4 mb-0 small">
                                By login, you agree to our <a href="#" class="text-decoration-none">Terms</a>.
                            </p>
                        </form>
                        
                        
                        
                    </div>
                </div> 
                
                <div class="text-center mt-4">
                    <span class="text-secondary">Don't have an account yet? </span>
                    <a href="{{ route("register") }}" class="text-primary fw-medium text-decoration-none">Register</a>
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
    </script>
</body>
</html>