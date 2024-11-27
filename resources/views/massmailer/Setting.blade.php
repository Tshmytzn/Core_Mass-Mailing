<!doctype html>
<html lang="en">
@include('massmailer.components.head')
<body>
  <script src="{{asset('./dist/js/demo-theme.min.js?1692870487')}}"></script>
  <div class="page">
   @include('massmailer.components.loadingpage')
    @include('massmailer.components.nav', ['active' => 'settings'])
    
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
                Setting
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
                <form action="" method="post" id="UserDataForm">
                    @csrf
                  <div class="row">
                    <div class="col-3 border">
                        <img src="" class="rounded float-start" alt="..." id="myImage">
                        <button type="button" class="btn btn-primary col-12" data-bs-toggle="modal" data-bs-target="#exampleModal">Update</button>
                    </div>
                    <div class="col-9 border p-4">
                            
                            <div class="row">
                            <!-- Username Field -->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp">
                                </div>
                            </div>

                            <!-- Full Name Field -->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Email Name</label>
                                    <input type="text" class="form-control" id="fullname" name="fullname" aria-describedby="emailHelp">
                                </div>
                            </div>

                            <!-- Email Field -->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                                </div>
                            </div>

                            <!-- Company ID Field -->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="company_id" class="form-label">Company ID</label>
                                    <input type="text" class="form-control" id="company_id" name="company_id" aria-describedby="companyIdHelp">
                                </div>
                            </div>

                            <!-- Password Field -->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary mb-1" onclick="UpdateUserData()">Update</button>
                        </div>

                        
                    </div>
                  </div>
                </form>
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="card">
                <div class="card-body">

                  <div id="summernote"></div>
                  <button type="buttom" id="logButton" class="btn btn-primary mt-3">Update</button>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="UpdateUserImageFrom" enctype="multipart/form-data">
                    @csrf
                    <label for="" class="form-label">User Image</label>
                    <input type="file" name="userimage" class="form-control" id="userimage" accept="image/*">
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="UpdateUserImage()">Save changes</button>
            </div>
            </div>
        </div>
        </div>

      @include('massmailer.components.footer')
    </div>
  </div>
  @include('massmailer.components.script')
  @include('massmailer.components.settingscript')
</body>

</html>