<!doctype html>
<html lang="en">
@include('massmailer.components.head')
<body>
  <script src="{{asset('./dist/js/demo-theme.min.js?1692870487')}}"></script>
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

                <button class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#inser-data-excel">
                  <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 5l0 14" />
                    <path d="M5 12l14 0" />
                  </svg>
                  Insert Leads
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

            <div class="col-sm-6 col-lg-3">
              <div class="card">
                <div class="card-body">
                  
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="modal modal-blur fade" id="inser-data-excel" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Insert Leads</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div class="row">
              <label for="">Insert Lead Data</label>
             <input type="file" id="fileInput" accept=".xlsx, .xls, .csv" class="form-control" />
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="uploadButton">Insert</button>
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