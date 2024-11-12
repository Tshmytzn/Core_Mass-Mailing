<script>
    function UpdateUserData(){
            const form = document.getElementById('UserDataForm');
            const formData = new FormData(form);
          
            document.getElementById('loadingPage').style.display='flex';
            $.ajax({
                url: `{{route('UpdateAccount')}}`, // Replace with your server endpoint
                type: 'POST',
                data: formData,
                processData: false, // Required for FormData
                contentType: false, // Required for FormData
                success: function(response) {
                    getUserData();
                    document.getElementById('loadingPage').style.display='none';
                    alertify.success(response.message);
                },
                error: function(xhr, status, error) {
                    console.error('Form submission failed:', error);
                }
            });
        }

    function UpdateUserImage(){
            const form = document.getElementById('UpdateUserImageFrom');
            const formData = new FormData(form);
          
            document.getElementById('loadingPage').style.display='flex';
            $.ajax({
                url: `{{route('UpdateAccountProfile')}}`, // Replace with your server endpoint
                type: 'POST',
                data: formData,
                processData: false, // Required for FormData
                contentType: false, // Required for FormData
                success: function(response) {
                    getUserData();
                    document.getElementById('loadingPage').style.display='none';
                    alertify.success(response.message);
                    $('#exampleModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.error('Form submission failed:', error);
                }
            });
        }
    function getUserData() {

        $.ajax({
            url: '{{ route('GetAccount') }}', // Replace with your endpoint route
            type: 'GET', // HTTP method (GET)
            success: function(response) {
                document.getElementById('fullname').value=response.acc_fullname;
                document.getElementById('username').value=response.acc_username;
                document.getElementById('email').value=response.acc_email;
                document.getElementById('company_id').value=response.acc_company_id;
                var imageElement = document.getElementById('myImage');
                imageElement.src = response.acc_pic === "default_pic.jpg"
                ? `{{ asset('acc_profile_picture/default_pic.jpg') }}`
                : `{{ asset('acc_profile_picture/updated/') }}/` + response.acc_pic;
            },
            error: function(xhr, status, error) {
                document.getElementById('loadingPage').style.display = 'none';
                console.error('Request failed:', error); // Log error for debugging
                alertify.error('Failed to fetch data');
            }
        });
    }

    $('#logButton').click(function() {
            var content = $('#summernote').summernote('code');
            
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('content', content);

            document.getElementById('loadingPage').style.display='flex';
            $.ajax({
                url: `{{route('AddSignature')}}`, // Replace with your server endpoint
                type: 'POST',
                data: formData,
                processData: false, // Required for FormData
                contentType: false, // Required for FormData
                success: function(response) {
                    document.getElementById('loadingPage').style.display='none';
                    alertify.success(response.message);
                    getSignature();
                },
                error: function(xhr, status, error) {
                    console.error('Form submission failed:', error);
                }
            });

    });

    function getSignature(){

        $.ajax({
            url: '{{ route('GetSignature') }}', // Replace with your endpoint route
            type: 'GET', // HTTP method (GET)
            success: function(response) {
                console.log(response)
                console.log(response.signature.sig_body)
                $('#summernote').summernote('code', response.signature.sig_body);
            },
            error: function(xhr, status, error) {
                document.getElementById('loadingPage').style.display = 'none';
                console.error('Request failed:', error); // Log error for debugging
                alertify.error('Failed to fetch data');
            }
        });

    }

    $(document).ready(function() {    
        getUserData();
        $('#summernote').summernote({
            height: 300, // Set the height (in pixels) which will influence the number of rows visible
            minHeight: null, // Optionally specify the minimum height
            maxHeight: null, // Optionally specify the maximum height
            width: '100%', // Set the width to 100% (you can also set specific pixel values like '500px')
        });
        getSignature();
    });
</script>