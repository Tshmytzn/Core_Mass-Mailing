<!doctype html>
<html lang="en">
@include('massmailer.components.head')

<body>
    <script src="{{ asset('./dist/js/demo-theme.min.js?1692870487') }}"></script>
    <div class="page">
        @include('massmailer.components.loadingpage')
        @include('massmailer.components.nav', ['active' => 'leads'])

        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Overview
                            </div>
                            <h2 class="page-title">
                                Leads
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">

                                <button class="btn btn-ghost-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                    data-bs-target="#insert-leads-manually">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                    Insert New Leads
                                </button>

                                <button class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                    data-bs-target="#inser-data-excel">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                    Import Leads for Campaigns
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">

                        <div class="col-sm-6 col-lg-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="table-responsive">
                                                    <table class="table table-hover card-table" id="leads-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Company</th>
                                                                <th>Email</th>
                                                                <th>Full Name</th>
                                                                <th>Service Offered</th>
                                                                <th>Email Sent</th>
                                                                <th class="w-1">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                    <button id="delete-selected" class="btn btn-danger">Delete Selected</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal modal-blur fade" id="inser-data-excel" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header mailing-header">
                            <h5 class="modal-title">Import Leads</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-12">
                                    <div class="text-danger mb-3">
                                        Excel or CSV must contain the following column names:
                                        <table class="table table-bordered table-sm mt-2">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Email</th>
                                                    <th>Company</th>
                                                    <th>Service Offered</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="fileInput" class="form-label">Upload Leads</label>
                                    <input type="file" id="fileInput" accept=".xlsx, .xls, .csv"
                                        class="form-control" />
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                id="uploadButton">Upload Leads</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal modal-blur fade" id="insert-leads-manually" tabindex="-1" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header mailing-header">
                            <h5 class="modal-title">Insert Leads</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" id="ManualinputLeadsForm" onsubmit="event.preventDefault();" >
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="acc_id" id="acc_id" value="{{session('acc_id')}}">

                                    <div class="col-12 mb-3">
                                        <label for="firstName" class="form-label required">First Name</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName"
                                            placeholder="Enter First Name" />
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="lastName" class="form-label required">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName"
                                            placeholder="Enter Last Name" />
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="email" class="form-label required">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter Email" />
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="contact" class="form-label">Contact Number <small
                                                class="text-secondary"> (Optional) </small></label>
                                        <input type="tel" class="form-control" id="contact" name="contact"
                                            placeholder="Enter Contact Number" />
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="company" class="form-label required">Company</label>
                                        <input type="text" class="form-control" id="company" name="company"
                                            placeholder="Enter Company" />
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="services" class="form-label required">Service Offered</label>
                                        <select class="form-control" id="services" name="services">
                                            <option value="">Select a Service</option>
                                            <option value="Software Development">Software Development</option>
                                            <option value="IT Managed Services">IT Managed Services</option>
                                            <option value="BPO">BPO</option>
                                            <option value="Startup MVP">Startup MVP</option>
                                            <option value="Remote Employee Management">Remote Employee Management
                                            </option>
                                            <option value="Offshore Remote Team">Offshore Remote Team
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="ManualinputLeadsData()" id="insertLeadsButton">Insert
                                Leads</button>
                        </div>
                    </div>
                </div>
            </div>

            @include('massmailer.components.footer')
        </div>
    </div>
    @include('massmailer.components.script')
    @include('massmailer.components.leadsrecordscript')
</body>

</html>
