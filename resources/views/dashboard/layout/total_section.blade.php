<div class="row g-3 mb-4">
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
        </div>