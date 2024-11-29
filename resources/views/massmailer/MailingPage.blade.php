<!doctype html>
<html lang="en">
@include('massmailer.components.head')

<body>
    <script src="{{asset('./dist/js/demo-theme.min.js?1692870487')}}"></script>
    <div class="page">
        @include('massmailer.components.loadingpage')
        @include('massmailer.components.nav', ['active' => 'mailingpage'])

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
                                Single Mail
                            </h2>
                        </div>
                        <!-- Page title actions -->

                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-12 col-lg-5 col-xl-3 border-end">

                                <div class="card-body p-0 scrollable" style="max-height: 40rem">
                                    <div class="nav flex-column nav-pills" role="tablist" id="historyData">

                                        

                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-7 col-xl-9 d-flex flex-column">
                                <div class="card-body" style="height: 42rem">
                                    <div class="chat">
                                        <div class="chat-bubbles">
                                            <div class="chat-item col-12">

                                                @php
                                                $data = App\Models\AccountModel::where('acc_id',session('acc_id'))->first();
                                                @endphp

                                                <!-- Main form content (col-10) -->
                                                <div class="col-12 border p-4">
                                                    <form method="POST" id="submitEmailForm">
                                                        @csrf
                                                        <!-- FROM Field -->
                                                        <div class="mb-3 row">
                                                            <label for="mailfrom" class="col-sm-2 col-form-label">FROM</label>
                                                            <div class="col-sm-10">
                                                                <input type="email" name="mailfrom" id="mailfrom" class="form-control" value="{{$data->acc_email}}" required>
                                                            </div>
                                                        </div>

                                                        <!-- TO Field -->
                                                        <div class="mb-3 row">
                                                            <label for="mailto" class="col-sm-2 col-form-label">TO</label>
                                                            <div class="col-sm-10">
                                                                <input type="email" name="mailto" id="mailto" class="form-control" required>
                                                            </div>
                                                        </div>

                                                        <!-- SUBJECT Field -->
                                                        <div class="mb-3 row">
                                                            <label for="subject" class="col-sm-2 col-form-label">SUBJECT</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="subject" id="subject" class="form-control" required>
                                                            </div>
                                                        </div>

                                                        <!-- BODY (Summernote) -->
                                                        <div class="mb-3 row">
                                                            <label for="summernote" class="col-sm-2 col-form-label">Body</label>
                                                            <div class="col-sm-10">
                                                                <textarea name="body" id="summernote" class="form-control" cols="30" rows="10"></textarea>
                                                            </div>
                                                        </div>

                                                        <!-- Submit Button -->
                                                        <div class="row">
                                                            <div class="col-sm-10 offset-sm-2">
                                                                <button type="button" class="btn btn-primary mt-2 float-end" onclick="SubmitEmail()">Send</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal modal-blur fade" id="modal-full-width" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">View Mail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row g-3"> <!-- Add spacing between rows -->
                            <!-- Mail To -->
                            <div class="col-12">
                                <label for="mail-to" class="form-label">Mail To</label>
                                <input type="text" class="form-control" id="mail-to" readonly>
                            </div>

                            <!-- Subject -->
                            <div class="col-12">
                                <label for="mail-subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="mail-subject" readonly>
                            </div>

                            <!-- Body -->
                            <div class="col-12">
                                <label for="emailContent" class="form-label">Body</label>
                                <div id="emailContent" class="p-3 border rounded" style="background-color: #f9f9f9; min-height: 150px;">
                                    <!-- Email body content will go here -->
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
                </div>

                @include('massmailer.components.footer')
            </div>
        </div>
        @include('massmailer.components.script')
        @include('massmailer.components.singlemailscript')
</body>

</html>
