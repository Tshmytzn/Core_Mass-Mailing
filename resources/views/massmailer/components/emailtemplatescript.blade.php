<script>
function validateForm(formId) {
    const form = document.getElementById(formId);
    let isValid = true; // Flag to check if form is valid

    // Loop through all form elements to validate
    form.querySelectorAll('input, textarea').forEach(function (element) {
        // Check if the element is required and empty
        if (element.value.trim() === '') {
            isValid = false;
            // Add red border to empty field
            element.style.borderColor = 'red';
        } else {
            // Remove the red border if the field is not empty
            element.style.borderColor = '';
        }
    });

    // Return the validity of the form
    return isValid;
}

function SavaTemplate(formId) {

    if (!validateForm(formId)) {
            Swal.fire({
            icon: "error",
            text: "Please fill in all required fields.",
            });
        return;
    }

    const form = document.getElementById(formId);
    const formData = new FormData(form);

    // Add the CSRF token
    formData.append('_token', '{{ csrf_token() }}');
    
    // Show loading indicator
    document.getElementById('loadingPage').style.display = 'flex';

    // AJAX request
    $.ajax({
        url: `{{route('AddTemplate')}}`, // Replace with your server endpoint
        type: 'POST',
        data: formData,
        processData: false, // Required for FormData
        contentType: false, // Required for FormData
        success: function (response) {
            document.getElementById('loadingPage').style.display = 'none';

        },
        error: function (xhr, status, error) {
            document.getElementById('loadingPage').style.display = 'none';
            console.error('Form submission failed:', error);
        }
    });
}


$(document).ready(function() {
    $('#soft-summernote').summernote();
    $('#it-summernote').summernote();
    $('#business-summernote').summernote();
    $('#mvp-summernote').summernote();
});  
</script>