<!doctype html>
<html lang="en">
@include('massmailer.components.head')
<body>
  <script src="{{asset('./dist/js/demo-theme.min.js?1692870487')}}"></script>
  <div class="page">
   @include('massmailer.components.loadingpage')
    
    <div class="page-wrapper">
      <!-- Page header -->
     
      <!-- Page body -->
      <div class="page-body">
        <div class="container-xl d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="row row-deck row-cards justify-content-center w-100">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow">
                <div class="card-body">
                    <form action="{{route('login.submit')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 text-center mb-4">
                        <img src="{{asset('./logo/core_log.png')}}" class="rounded-circle" alt="Profile Picture" style="width: 100px; height: 100px; object-fit: cover;">
                        </div>

                        <div class="col-12">
                        <!-- Username Field -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp">
                        </div>
                        </div>

                        <div class="col-12">
                        <!-- Password Field -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp">
                        </div>
                        </div>
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif


                        <!-- Submit Button -->
                        <div class="d-flex justify-content-center align-items-center text-center mt-4">
                        <button type="submit" class="btn btn-primary w-100">Login</button>
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
  @include('massmailer.components.script')
</body>

</html>