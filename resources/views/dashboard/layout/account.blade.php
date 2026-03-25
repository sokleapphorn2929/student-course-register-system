<div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                
                <!-- Main Profile Card -->
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4 p-md-5 text-center text-md-start">
                        
                        <!-- Profile Picture Section - Centered -->
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                <!-- Profile Picture -->
                                <img src="https://ui-avatars.com/api/?background=0D6EFD&color=fff&size=120&bold=true&name=User" 
                                     alt="Profile Picture" 
                                     class="rounded-circle border border-3 border-white shadow-sm"
                                     style="width: 120px; height: 120px; object-fit: cover;">
                                
                                <!-- Edit Profile Picture Button (Upload) -->
                                <label for="profilePictureUpload" class="position-absolute bottom-0 end-0 bg-primary rounded-circle p-2 border border-white shadow-sm d-flex align-items-center justify-content-center" style="cursor: pointer; width: 32px; height: 32px;">
                                    <i class="bi bi-camera-fill text-white" style="font-size: 0.9rem;"></i>
                                    <span class="visually-hidden">Edit profile picture</span>
                                </label>
                                <input type="file" id="profilePictureUpload" class="d-none" accept="image/*">
                            </div>
                            <p class="text-muted small mt-2 mb-0">Click the camera icon to upload a new photo</p>
                        </div>
                        
                        <hr class="my-4">
                        
                        <!-- User Information Section -->
                        <h5 class="fw-semibold mb-3">
                            <i class="bi bi-person-circle me-2 text-primary"></i>Personal Information
                        </h5>
                        
                        <div class="row g-3">
                            <!-- Username Field -->
                            <div class="col-12">
                                <div class="border rounded-3 p-3 bg-white">
                                    <label class="text-secondary small text-uppercase fw-semibold mb-1 d-block">
                                        <i class="bi bi-person me-1"></i> Username
                                    </label>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-medium">johndoe_123</span>
                                        <button class="btn btn-sm btn-outline-secondary" disabled>
                                            <i class="bi bi-pencil"></i> Edit
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Gender Field -->
                            <div class="col-12">
                                <div class="border rounded-3 p-3 bg-white">
                                    <label class="text-secondary small text-uppercase fw-semibold mb-1 d-block">
                                        <i class="bi bi-gender-ambiguous me-1"></i> Gender
                                    </label>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-medium">Male</span>
                                        <button class="btn btn-sm btn-outline-secondary" disabled>
                                            <i class="bi bi-pencil"></i> Edit
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Date of Birth Field -->
                            <div class="col-12">
                                <div class="border rounded-3 p-3 bg-white">
                                    <label class="text-secondary small text-uppercase fw-semibold mb-1 d-block">
                                        <i class="bi bi-calendar3 me-1"></i> Date of Birth
                                    </label>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-medium">March 15, 1995</span>
                                        <button class="btn btn-sm btn-outline-secondary" disabled>
                                            <i class="bi bi-pencil"></i> Edit
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Email Field -->
                            <div class="col-12">
                                <div class="border rounded-3 p-3 bg-white">
                                    <label class="text-secondary small text-uppercase fw-semibold mb-1 d-block">
                                        <i class="bi bi-envelope me-1"></i> Email Address
                                    </label>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-medium">johndoe@example.com</span>
                                        <button class="btn btn-sm btn-outline-secondary" disabled>
                                            <i class="bi bi-pencil"></i> Edit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr class="my-4">
                        
                        <!-- Delete Account Section -->
                        <div class="mt-3">
                            <h5 class="fw-semibold mb-3 text-danger">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>Danger Zone
                            </h5>
                            <div class="border border-danger rounded-3 p-3 bg-white">
                                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3">
                                    <div>
                                        <span class="fw-semibold d-block">Delete Account</span>
                                        <small class="text-secondary">Permanently delete your account and all associated data. This action cannot be undone.</small>
                                    </div>
                                    <button class="btn btn-danger" disabled>
                                        <i class="bi bi-trash3 me-1"></i> Delete Account
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Account Status Info -->
                        <div class="mt-4 pt-2 text-center">
                            <div class="d-flex justify-content-center gap-4">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-shield-check text-success"></i>
                                    <span class="small text-secondary">Account Active</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-calendar-check text-primary"></i>
                                    <span class="small text-secondary">Member since 2024</span>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <!-- Help Text -->
                <div class="text-center mt-4">
                    <p class="text-muted small mb-0">
                        <i class="bi bi-info-circle"></i> Profile picture can be uploaded by clicking the camera icon
                    </p>
                </div>
                
            </div>
        </div>
    </div>