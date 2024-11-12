<script>
     $(document).ready(function() {
            // Initialize Summernote
            $('#summernote').summernote({
                height: 300,  // Set the height of the editor
                focus: true ,   // Focus on the editor when initialized
                toolbar: [
                    ['style', ['bold', 'italic', 'underline']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']], // Remove image and video
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
        });
        function SubmitEmail(){
            const form = document.getElementById('submitEmailForm');
            const formData = new FormData(form);
            formData.append('_token', '{{ csrf_token() }}');
            document.getElementById('loadingPage').style.display='flex';
            $.ajax({
                url: `{{route('sendEmail')}}`, // Replace with your server endpoint
                type: 'POST',
                data: formData,
                processData: false, // Required for FormData
                contentType: false, // Required for FormData
                success: function(response) {
                    document.getElementById('loadingPage').style.display='none';
                    alertify.success(response.message);
                     $('#submitEmailForm').find('input, textarea').not('#mailfrom').val('');
                     $('#summernote').summernote('code', '');
                },
                error: function(xhr, status, error) {
                    console.error('Form submission failed:', error);
                }
            });
        }
</script>