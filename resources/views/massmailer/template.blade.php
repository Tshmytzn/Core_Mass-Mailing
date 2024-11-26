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
                Template
              </h2>
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
      @include('massmailer.components.footer')
    </div>
  </div>
  @include('massmailer.components.script')
</body>

</html>