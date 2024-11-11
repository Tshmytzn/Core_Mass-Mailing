<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Core Mass mailer</title>
</head>

<body>
  <div class="container py-4">

    <div class="row m-5">

      <div class="col-3">
        <div class="mb-3">
          <h4>Mailbox</h4>

          <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center shadow-sm rounded-3 mb-2">
              <a href="#" class="text-decoration-none text-dark d-flex align-items-center">
                <span class="badge bg-primary me-3 rounded-pill">📧</span>
                <span class="fw-semibold">Single Email</span>
              </a>
              <span class="badge bg-secondary rounded-pill">New</span>
            </li>

            <li class="list-group-item d-flex justify-content-between align-items-center shadow-sm rounded-3 mb-2">
              <a href="#" class="text-decoration-none text-dark d-flex align-items-center">
                <span class="badge bg-info me-3 rounded-pill">📩</span>
                <span class="fw-semibold">Mass Email</span>
              </a>
              <span class="badge bg-warning rounded-pill">Trending</span>
            </li>

            <li class="list-group-item d-flex justify-content-between align-items-center shadow-sm rounded-3 mb-2">
              <a href="#" class="text-decoration-none text-dark d-flex align-items-center">
                <span class="badge bg-success me-3 rounded-pill">📢</span>
                <span class="fw-semibold">Email Marketing</span>
              </a>
              <span class="badge bg-danger rounded-pill">Hot</span>
            </li>
          </ul>



        </div>

      </div>


      <div class="col-9 mt-4">
        <!-- Email recipient -->
        <form>
          <!-- To email -->
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="recipientemail" placeholder="name@example.com">
            <label for="recipientemail">To:</label>
          </div>

          <!-- From email -->
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="senderemail" placeholder="you@example.com">
            <label for="senderemail">From:</label>
          </div>

          <!-- Subject -->
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="subject" placeholder="Subject of the email">
            <label for="subject">Subject:</label>
          </div>

          <!-- Message -->
          <div class="form-floating mb-4">
            <textarea class="form-control" placeholder="Type your message here" id="floatingTextarea2"
              style="height: 150px;"></textarea>
          </div>


        </form>


        <div class="mb-3">
          <button type="button" class="btn btn-outline-primary btn-md">Send Email</button>
        </div>
      </div>


    </div>
  </div>
  <script>
    $(document).ready(function () {
      $('#floatingTextarea2').summernote({
        placeholder: 'Type your message here',
        height: 150,  
        tabsize: 2     
      });
    });
  </script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</body>

</html>