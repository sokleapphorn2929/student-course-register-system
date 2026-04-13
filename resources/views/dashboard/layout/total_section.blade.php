<div class="row g-3 mb-4">
            <div class="col-6 col-md">
                <div class="card h-100 border-0 shadow-sm bg-primary text-white">
                    <div class="card-body">
                        <h6>Total Students</h6>
                        <h3 class="fw-bold">{{ $students->count() ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md">
                <div class="card h-100 border-0 shadow-sm bg-success text-white">
                    <div class="card-body">
                        <h6>Total Courses</h6>
                        <h3 class="fw-bold">{{ $courses->count() ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md">
                <div class="card h-100 border-0 shadow-sm bg-warning text-dark">
                    <div class="card-body">
                        <h6>Total Teachers</h6>
                        <h3 class="fw-bold">{{ $teachers->count() ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md">
                <div class="card h-100 border-0 shadow-sm bg-info text-white">
                    <div class="card-body">
                        <h6>Total Enrollments</h6>
                        <h3 class="fw-bold">{{ $enrollments->count() ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            {{-- enrollment --}}
            <div class="col-6 col-md">
                <div class="card h-100 border-2 shadow-sm border-success text-success">
                    <div class="card-body">
                        <h6>● Active</h6>
                        <h3 class="fw-bold">{{ $activeCount }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md">
                <div class="card h-100 border-2 shadow-sm border-warning text-warning">
                    <div class="card-body">
                        <h6>● Pending</h6>
                        <h3 class="fw-bold">{{ $pendingCount }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md">
                <div class="card h-100 border-2 shadow-sm border-primary text-primary">
                    <div class="card-body">
                        <h6>● Completed</h6>
                        <h3 class="fw-bold">{{ $completedCount }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md">
                <div class="card h-100 border-2 shadow-sm border-danger text-danger">
                    <div class="card-body">
                        <h6>● Dropped</h6>
                        <h3 class="fw-bold">{{ $droppedCount }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <input type="text" id="studentTableSearch" class="form-control mb-2" placeholder="Search...">