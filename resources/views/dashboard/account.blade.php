<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SCRS - Account</title>
    <link rel="icon" type="image/png" href="https://i.postimg.cc/sXXb7q2w/scrs.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

@include("dashboard.layout.header")

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
                                        {{-- src="{{ asset("storage/" . Auth::user()->profile_pic) }}" 
                                        alt="{{ Auth::user()->username }}" 
                                        class="rounded-circle border border-3 border-white shadow-sm"
                                        style="width: 120px; height: 120px; object-fit: cover;" --}}

                                        src="{{ Auth::user()->profile_pic }}" 
                                        alt="{{ Auth::user()->username }}" 
                                        class="rounded-circle border border-3 border-white shadow-sm"
                                        style="width: 120px; height: 120px; object-fit: cover;"
                                    >
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
                        <div id="toastAlert"></div>
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
                                        <span id="txtUsername" class="fw-medium">{{ Auth::user()->username }}</span>
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
                                                            <input id="inpUsername" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="visible-addon">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button onclick="SaveUsername()" id="btnUsername" type="button" class="btn btn-primary">Update</button>
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
                                        <i class="bi bi-person-badge me-1"></i> Role
                                    </label>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span id="txtRole" class="fw-medium">{{ Auth::user()->role }}</span>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#rolemodal">
                                            <i class="bi bi-pencil"></i> Edit
                                        </button>

                                        <div class="modal fade" id="rolemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Role</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <select id="rolechoose" class="form-select" aria-label="Default select example">
                                                            <option selected>Select Role</option>
                                                            <option id="vAdmin" value="Admin">Admin</option>
                                                            <option id="vStudent" value="Student">Student</option>
                                                            <option id="vTeacher" value="Teacher">Teacher</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button onclick="SaveRole()" id="btnRole" type="button" class="btn btn-primary">Update</button>
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
                                        <span id="txtGender" class="fw-medium text-danger">No data</span>
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
                                                        <select id="genderchoose" class="form-select" aria-label="Default select example">
                                                            <option selected>Select Gender</option>
                                                            <option id="vMale" value="Male">Male</option>
                                                            <option id="vFemale" value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button onclick="SaveGender()" id="btnGender" type="button" class="btn btn-primary">Update</button>
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
                                        <span id="txtDob" class="fw-medium">{{ Auth::user()->dob }}</span>
                                        @else
                                        <span id="txtDob" class="fw-medium text-danger">No data</span>
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
                                                            <label for="dobInput" class="form-label">Enter Date:</label>
                                                            <input class="form-control" type="date" id="dobInput">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button onclick="SaveDob()" type="button" class="btn btn-primary">Update</button>
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
                                <button type="button" class="btn btn-danger" onclick="location.href='{{ url('/account') }}'">Discard</button>
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
                                <button class="btn btn-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                    <i class="bi bi-trash3 me-1"></i> Delete Account
                                </button>

                                <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirm Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete your account? This action cannot be undone.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('account.delete.self') }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
let pendingChanges = {};
let selectedFile = null;

// ADD THIS BACK - photo preview listener
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

function SaveUsername() {
    let username = document.getElementById("inpUsername").value;
    if (!username || username.trim() === "") { alert("Please enter a username"); return; }
    pendingChanges.username = username;
    document.getElementById("txtUsername").innerHTML = username + ' <span class="badge bg-warning text-dark ms-1" style="font-size:0.6rem;">unsaved</span>';
    bootstrap.Modal.getInstance(document.getElementById('usernamemodal')).hide();
    showStatus('Username staged. Click "Save changes" to apply.', 'info');
}

function SaveGender() {
    let gender = document.getElementById("genderchoose").value;
    if (!gender || gender === "Select Gender") { alert("Please select a gender"); return; }
    pendingChanges.gender = gender;
    document.getElementById("txtGender").innerHTML = gender + ' <span class="badge bg-warning text-dark ms-1" style="font-size:0.6rem;">unsaved</span>';
    bootstrap.Modal.getInstance(document.getElementById('gendermodal')).hide();
    showStatus('Gender staged. Click "Save changes" to apply.', 'info');
}

function SaveRole() {
    let role = document.getElementById("rolechoose").value;
    if (!role || role === "Select Role") { alert("Please select a role"); return; }
    pendingChanges.role = role;
    document.getElementById("txtRole").innerHTML = role + ' <span class="badge bg-warning text-dark ms-1" style="font-size:0.6rem;">unsaved</span>';
    bootstrap.Modal.getInstance(document.getElementById('rolemodal')).hide();
    showStatus('Role staged. Click "Save changes" to apply.', 'info');
}

function SaveDob() {
    let dob = document.getElementById("dobInput").value;
    if (!dob) { alert("Please select a date of birth"); return; }
    pendingChanges.dob = dob;
    document.getElementById("txtDob").innerHTML = dob + ' <span class="badge bg-warning text-dark ms-1" style="font-size:0.6rem;">unsaved</span>';
    bootstrap.Modal.getInstance(document.getElementById('dobmodal')).hide();
    showStatus('Date of birth staged. Click "Save changes" to apply.', 'info');
}

document.getElementById('profileForm').addEventListener('submit', function(e) {
    e.preventDefault();

    if (!selectedFile && Object.keys(pendingChanges).length === 0) {
        showStatus('No changes to save.', 'info');
        return;
    }

    const saveBtn = document.getElementById('saveChangesBtn');
    saveBtn.disabled = true;
    saveBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Saving...';

    const requests = [];

    if (selectedFile) {
        const formData = new FormData();
        formData.append('profile_picture', selectedFile);
        requests.push(
            fetch('{{ route("update-picture.submit") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: formData
            }).then(r => r.json())
        );
    }

    const fieldRoutes = {
        username: '/update-username',
        gender:   '/update-gender',
        role:     '/update-role',
        dob:      '/update-dob'
    };

    for (const [field, value] of Object.entries(pendingChanges)) {
        requests.push(
            fetch(fieldRoutes[field], {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ [field]: value })
            }).then(r => r.json())
        );
    }

    Promise.all(requests)
        .then(results => {
            const allSuccess = results.every(r => r.success);
            if (allSuccess) {
                pendingChanges = {};
                selectedFile = null;
                showStatus('All changes saved successfully!', 'success');
                setTimeout(() => location.reload(), 2000);
            } else {
                showStatus('Some changes failed to save.', 'danger');
            }
        })
        .catch(() => showStatus('An error occurred while saving.', 'danger'))
        .finally(() => {
            saveBtn.disabled = false;
            saveBtn.innerHTML = 'Save changes';
        });
});

// ADD THIS BACK - showStatus function was missing
function showStatus(message, type) {
    const alertClass = type === 'danger' ? 'alert-danger' : 
                       type === 'success' ? 'alert-success' : 'alert-info';

    const toast = document.getElementById('toastAlert');
    toast.innerHTML = `
        <div class="alert ${alertClass} alert-dismissible fade show mt-2" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;

    setTimeout(() => {
        toast.innerHTML = '';
    }, 3000);
}
</script>
@include("dashboard.layout.footer")