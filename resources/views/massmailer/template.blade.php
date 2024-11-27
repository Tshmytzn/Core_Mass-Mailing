<!doctype html>
<html lang="en">
@include('massmailer.components.head')
<body>
  <script src="{{asset('./dist/js/demo-theme.min.js?1692870487')}}"></script>
  <div class="page">
   @include('massmailer.components.loadingpage')

   @include('massmailer.components.nav', ['active' => 'template'])
    
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
                Email Template
              </h2>
            </div>

          </div>
        </div>
      </div>
      <!-- Page body -->
      <div class="page-body">
        <div class="container-xl">
          <div class="card">
            <div class="card-body">
              <div class="accordion" id="accordion-example">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="heading-1">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="false">
                      Software Development 
                    </button>
                  </h2>
                  <div id="collapse-1" class="accordion-collapse collapse " data-bs-parent="#accordion-example">
                    <div class="accordion-body pt-0">

                      <form action="" id="soft-form" method="post">
                      <div class="mb-3 row">
                        <div class="col-sm-12">
                          <input type="text" name="type" value="Software Development">
                          <label for="template-subject" class="form-label">Template Subject</label>
                          <input type="text" name="subject" id="template-subject" class="form-control"> 

                          <label for="soft-summernote" class="form-label mt-3">Template Body</label>
                          <textarea name="body" id="soft-summernote" class="form-control" cols="30" rows="10"></textarea>

                          <button type="button" class="mt-3 btn btn-primary w-100" onclick="SavaTemplate('soft-form')">Update</button>
                        </div>
                      </div>
                      </form>

                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="heading-2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="false">
                      IT Managed Services
                    </button>
                  </h2>
                  <div id="collapse-2" class="accordion-collapse collapse" data-bs-parent="#accordion-example">
                    <div class="accordion-body pt-0">
                      
                      <div class="mb-3 row">
                        <div class="col-sm-12">
                          <input type="text" name="type" value="IT Manage Services">
                          <label for="template-subject" class="form-label">Template Subject</label>
                          <input type="text" id="template-subject" class="form-control"> 

                          <label for="it-summernote" class="form-label mt-3">Template Body</label>
                          <textarea name="body" id="it-summernote" class="form-control" cols="30" rows="10"></textarea>

                          <button type="button" class="mt-3 btn btn-primary w-100">Update</button>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="heading-3">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-3" aria-expanded="false">
                      Business Process Outsourcing
                    </button>
                  </h2>
                  <div id="collapse-3" class="accordion-collapse collapse" data-bs-parent="#accordion-example">
                    <div class="accordion-body pt-0">
                      
                      <div class="mb-3 row">
                        <div class="col-sm-12">
                          <input type="text" name="type" value="BPO">
                          <label for="template-subject" class="form-label">Template Subject</label>
                          <input type="text" id="template-subject" class="form-control" placeholder="Enter template subject">

                          <label for="business-summernote" class="form-label mt-3">Template Body</label>
                          <textarea name="body" id="business-summernote" class="form-control" cols="30" rows="10" placeholder="Enter template body"></textarea>

                          <button type="button" class="btn btn-primary mt-3 w-100">Update</button>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="heading-4">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-4" aria-expanded="false">
                      Startup MVP
                    </button>
                  </h2>
                  <div id="collapse-4" class="accordion-collapse collapse" data-bs-parent="#accordion-example">
                    <div class="accordion-body pt-0">
                      
                      <div class="mb-3 row">
                        <div class="col-sm-12">
                          <input type="text" name="type" value="Startup MVP">
                          <label for="template-subject" class="form-label">Template Subject</label>
                          <input type="text" id="template-subject" class="form-control" placeholder="Enter template subject">

                          <label for="mvp-summernote" class="form-label mt-3">Template Body</label>
                          <textarea name="body" id="mvp-summernote" class="form-control" cols="30" rows="10" placeholder="Enter template body"></textarea>

                          <button type="button" class="btn btn-primary mt-3 w-100">Update</button>
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
      @include('massmailer.components.footer')
    </div>
  </div>
  @include('massmailer.components.script')
  @include('massmailer.components.emailtemplatescript')
</body>

</html>