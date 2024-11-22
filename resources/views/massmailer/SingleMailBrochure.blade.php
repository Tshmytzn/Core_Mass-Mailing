<!doctype html>
<html lang="en">
@include('massmailer.components.head')
<body>
  <script src="{{asset('./dist/js/demo-theme.min.js?1692870487')}}"></script>
  <div class="page">
    @include('massmailer.components.loadingpage')
    @include('massmailer.components.nav', ['active' => 'singlebrochure'])
    
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
          <div class="row row-deck row-cards">

            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <!-- Sidebar (col-2) or empty space on the left (optional) -->
                    <div class="col-12 col-md-3 border p-3 overflow-auto" id="historyData" style="height: 700px; overflow-y: auto;">
                        <!-- You can put content here if needed for a sidebar -->
                    </div>
                    @php
                      $data = App\Models\AccountModel::where('acc_id',session('acc_id'))->first();
                    @endphp
                    <!-- Main form content (col-10) -->
                    <div class="col-12 col-md-9 border p-4">
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

                        <div class="row d-flex justify-content-center align-items-center">
                          <div class="col-4">
                              <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="1">
                              <label class="form-check-label" for="flexRadioDefault1">
                                Building Software App
                              </label>
                              <img src="{{asset('brochure_img/building.jpeg')}}" class="rounded mx-auto d-block" alt="...">
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="" value="2">
                              <label class="form-check-label" for="flexRadioDefault1">
                                Outsourcing Services
                              </label>
                              <img src="{{asset('brochure_img/outsourcing.jpeg')}}" class="rounded mx-auto d-block" alt="...">
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="3">
                              <label class="form-check-label" for="flexRadioDefault1">
                                Remote IT Support
                              </label>
                              <img src="{{asset('brochure_img/remote.jpeg')}}" class="rounded mx-auto d-block" alt="...">
                            </div>
                          </div>
                        </div>
                        
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
      @include('massmailer.components.footer')
    </div>
  </div>
  @include('massmailer.components.script')
  @include('massmailer.components.singlemailwithhtmlscript')
</body>

</html>