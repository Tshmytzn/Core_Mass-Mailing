<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test mail</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class=" mt-4 justify-content-center align-items-center">
        <div class="row">
            <div class="col-2 border"></div>
            <div class="col-10 border p-4">
                <form action="{{route('sendEmail')}}" method="POST" id="submitEmailForm">
                    @csrf
                    <label for="exampleFormControlInput1" class="form-label">FROM</label>
                    <input type="email" name="mailfrom" id="" class="form-control">
                    <label for="exampleFormControlInput1" class="form-label">TO</label>
                    <input type="email" name="mailto" id="" class="form-control">
                    <label for="exampleFormControlInput1" class="form-label">SUBJECT</label>
                    <input type="text" name="subject" id="" class="form-control">
                    <label for="exampleFormControlInput1" class="form-label">Body</label>
                    <!-- Summernote textarea -->
                    <textarea name="body" id="summernote" cols="30" rows="10"></textarea>
                    <button type="submit" class="btn btn-primary mt-2" onclick="SubmitEmail()">Submit</button>
                </form>
            </div>
        </div>
        </div>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Summernote
            $('#summernote').summernote({
                height: 300,  // Set the height of the editor
                focus: true    // Focus on the editor when initialized
            });
        });
        function SubmitEmail(){
            const form = document.getElementById('submitEmailForm');
            const formData = new FormData(form);
            for (let [key, value] of formData.entries()) {
                console.log(key + ": " + value);
            }
        }
    </script>
</body>
</html>
