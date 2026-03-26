<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5 text-center text-md-start">
                    
                    <div class="text-center mb-4">
                        <div class="position-relative d-inline-block">
                            <div id="profilePictureContainer">
                                @if (Auth::user()->profile_pic)
                                    <img id="currentProfilePic" 
                                        src="{{ asset("storage/" . Auth::user()->profile_pic) }}" 
                                        alt="{{ Auth::user()->username }}" 
                                        class="rounded-circle border border-3 border-white shadow-sm"
                                        style="width: 120px; height: 120px; object-fit: cover;">
                                @else
                                    <div id="currentProfilePic" class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" 
                                        style="width: 120px; height: 120px; font-size: 5rem;">
                                        {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            
                            <label for="profilePictureUpload" class="position-absolute bottom-0 end-0 bg-secondary rounded-circle p-2 border border-white shadow-sm d-flex align-items-center justify-content-center" style="cursor: pointer; width: 32px; height: 32px;">
                                <i class="bi bi-camera-fill text-white" style="font-size: 0.9rem;"></i>
                                <span class="visually-hidden">Edit profile picture</span>
                            </label>
                            <input type="file" id="profilePictureUpload" class="d-none" accept="image/*">
                        </div>
                        <h2>{{ Auth::user()->username }}</h2>
                        <p class="text-muted small mt-2 mb-0">Click the camera icon to upload a new photo</p>
                    </div>

                    <div id="uploadStatus" class="text-center mt-2" style="display: none;"></div>
                    
                    <hr class="my-4">
                    
                    <form id="profileForm" action="{{ route('update-picture.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h5 class="fw-semibold mb-3">
                            <i class="bi bi-person-circle me-2 text-primary"></i>Personal Information
                        </h5>
                        
                        <div class="row g-3">
                            <input type="file" name="profile_picture" id="hiddenFileInput" class="d-none">
                            
                            <div class="col-12">
                                <div class="border rounded-3 p-3 bg-white">
                                    <label class="text-secondary small text-uppercase fw-semibold mb-1 d-block">
                                        <i class="bi bi-person me-1"></i> Username
                                    </label>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-medium">{{ Auth::user()->username }}</span>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#usernamemodal">
                                            <i class="bi bi-pencil"></i> Edit
                                        </button>

                                        <div class="modal fade" id="usernamemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Username</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="input-group">
                                                            <span class="input-group-text" id="visible-addon">@</span>
                                                            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="visible-addon">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="border rounded-3 p-3 bg-white">
                                    <label class="text-secondary small text-uppercase fw-semibold mb-1 d-block">
                                        <i class="bi bi-gender-ambiguous me-1"></i> Gender
                                    </label>
                                    <div class="d-flex justify-content-between align-items-center">
                                        @if (Auth::user()->gender)                                            
                                        <span class="fw-medium">{{ Auth::user()->gender }}</span>
                                        @else
                                        <span class="fw-medium text-danger">No data</span>
                                        @endif
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#gendermodal">
                                            <i class="bi bi-pencil"></i> Edit
                                        </button>

                                        <div class="modal fade" id="gendermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Gender</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <select class="form-select" aria-label="Default select example">
                                                            <option selected>Select Gender</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="border rounded-3 p-3 bg-white">
                                    <label class="text-secondary small text-uppercase fw-semibold mb-1 d-block">
                                        <i class="bi bi-calendar3 me-1"></i> Date of Birth
                                    </label>
                                    <div class="d-flex justify-content-between align-items-center">
                                        @if (Auth::user()->dob)
                                        <span class="fw-medium">{{ Auth::user()->dob }}</span>
                                        @else
                                        <span class="fw-medium text-danger">No data</span>
                                        @endif
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#dobmodal">
                                            <i class="bi bi-pencil"></i> Edit
                                        </button>

                                        <div class="modal fade" id="dobmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Date of Birth</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="example-date-input" class="form-label">Enter Date:</label>
                                                            <input class="form-control" type="date" id="example-date-input">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="border rounded-3 p-3 bg-white">
                                    <label class="text-secondary small text-uppercase fw-semibold mb-1 d-block">
                                        <i class="bi bi-envelope me-1"></i> Email Address
                                    </label>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-medium">{{ Auth::user()->email }}</span>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#emailmodal" disabled>
                                            <i class="bi bi-pencil"></i> Edit
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center gap-3">
                                <button type="button" class="btn btn-danger" onclick="location.href='{{ url('/') }}'">Discard</button>
                                <button type="submit" class="btn btn-primary" id="saveChangesBtn">Save changes</button>
                            </div>
                        </div>
                    </form>
                    
                    <hr class="my-4">
                    
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
            
            <div class="text-center mt-4">
                <p class="text-muted small mb-0">
                    <i class="bi bi-info-circle"></i> Profile picture can be uploaded by clicking the camera icon
                </p>
            </div>
            
        </div>
    </div>
</div>

<script>
let selectedFile = null;

document.getElementById('profilePictureUpload').addEventListener('change', function(event) {
    const file = event.target.files[0];
    
    if (file) {
        if (!file.type.startsWith('image/')) {
            showStatus('Please select a valid image file', 'danger');
            this.value = '';
            return;
        }
        
        if (file.size > 2 * 1024 * 1024) {
            showStatus('File size must be less than 2MB', 'danger');
            this.value = '';
            return;
        }
        
        selectedFile = file;
        
        const reader = new FileReader();
        const container = document.getElementById('profilePictureContainer');
        
        reader.onload = function(e) {
            container.innerHTML = `
                <img src="${e.target.result}" 
                    alt="Preview" 
                    class="rounded-circle border border-3 border-white shadow-sm"
                    style="width: 120px; height: 120px; object-fit: cover;">
            `;
            showStatus('New photo selected. Click "Save changes" to apply.', 'info');
        }
        
        reader.readAsDataURL(file);
    }
});

document.getElementById('profileForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    if (!selectedFile) {
        showStatus('Please select a photo first', 'danger');
        return;
    }
    
    showStatus('Saving...', 'info');
    const saveBtn = document.getElementById('saveChangesBtn');
    saveBtn.disabled = true;
    saveBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...';
    
    const formData = new FormData();
    formData.append('profile_picture', selectedFile);
    
    fetch('{{ route("update-picture.submit") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showStatus('Profile picture updated successfully!', 'success');
            // Reload after 2 seconds to show updated picture
            setTimeout(() => {
                location.reload();
            }, 2000);
        } else {
            showStatus(data.message || 'Failed to update profile picture.', 'danger');
            // Reset the file input and reload
            document.getElementById('profilePictureUpload').value = '';
            selectedFile = null;
            saveBtn.disabled = false;
            saveBtn.innerHTML = 'Save changes';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showStatus('An error occurred while uploading.', 'danger');
        saveBtn.disabled = false;
        saveBtn.innerHTML = 'Save changes';
    });
});

function showStatus(message, type) {
    let statusDiv = document.getElementById('uploadStatus');
    if (!statusDiv) {
        statusDiv = document.createElement('div');
        statusDiv.id = 'uploadStatus';
        statusDiv.className = 'text-center mt-2';
        const profileSection = document.querySelector('.text-center.mb-4');
        profileSection.parentNode.insertBefore(statusDiv, profileSection.nextSibling);
    }
    
    statusDiv.style.display = 'block';
    const alertClass = type === 'danger' ? 'alert-danger' : 
                    (type === 'success' ? 'alert-success' : 'alert-info');
    statusDiv.innerHTML = `<div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                            ${message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>`;
    
    setTimeout(() => {
        if (statusDiv) {
            statusDiv.style.display = 'none';
        }
    }, 3000);
}
</script>