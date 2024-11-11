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
    $(document).ready(function() {    
        getUserData();
    });
</script>