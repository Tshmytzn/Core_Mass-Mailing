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
    // if (!validateForm(formId)) {
    //         Swal.fire({
    //         icon: "error",
    //         text: "Please fill in all required fields.",
    //         });
    //     return;
    // }

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
            Swal.fire({
            text: "Email Template Successfully Added!",
            icon: "success"
            });
            GetTemplate();
        },
        error: function (xhr, status, error) {
            document.getElementById('loadingPage').style.display = 'none';
            console.error('Form submission failed:', error);
        }
    });
}


function SavaFullowupTemplate(formId) {
    // if (!validateForm(formId)) {
    //         Swal.fire({
    //         icon: "error",
    //         text: "Please fill in all required fields.",
    //         });
    //     return;
    // }

    const form = document.getElementById(formId);
    const formData = new FormData(form);

    // Add the CSRF token
    formData.append('_token', '{{ csrf_token() }}');
    
    // Show loading indicator
    document.getElementById('loadingPage').style.display = 'flex';

    // AJAX request
    $.ajax({
        url: `{{route('AddFollowupTemplate')}}`, // Replace with your server endpoint
        type: 'POST',
        data: formData,
        processData: false, // Required for FormData
        contentType: false, // Required for FormData
        success: function (response) {
            document.getElementById('loadingPage').style.display = 'none';
            Swal.fire({
            text: "Email Template Successfully Added!",
            icon: "success"
            });
            GetFollowupTemplate();
        },
        error: function (xhr, status, error) {
            document.getElementById('loadingPage').style.display = 'none';
            console.error('Form submission failed:', error);
        }
    });
}

function GetTemplate() {
    $.ajax({
        url: '{{ route('GetTemplate') }}', // Replace with your endpoint route
        type: 'GET', // HTTP method (GET)
        success: function(response) {
            const data = response.data;
            
            if (!data || data.length === 0) {
                alertify.warning('No templates found.');
                return;
            }
            
            // Map temp_type to corresponding elements
            const templateMap = {
                'Software Development': {
                    subject: 'soft-template-subject',
                    editor: '#soft-summernote',
                },
                'IT Managed Services': {
                    subject: 'it-template-subject',
                    editor: '#it-summernote',
                },
                'BPO': {
                    subject: 'business-template-subject',
                    editor: '#business-summernote',
                },
                'Startup MVP': {
                    subject: 'mvp-template-subject',
                    editor: '#mvp-summernote',
                }
            };

            // Loop through templates and set values dynamically
            data.forEach(element => {
                const template = templateMap[element.temp_type];
                if (template) {
                    document.getElementById(template.subject).value = element.temp_subject;
                    $(template.editor).summernote('code', element.temp_body);
                } else {
                    console.warn(`Unknown template type: ${element.temp_type}`);
                }
            });
        },
        error: function(xhr, status, error) {
            document.getElementById('loadingPage').style.display = 'none';
            console.error('Request failed:', error); // Log error for debugging
            alertify.error('Failed to fetch data');
        }
    });
}

function GetFollowupTemplate() {
    $.ajax({
        url: '{{ route('GetFollowupTemplate') }}', // Replace with your endpoint route
        type: 'GET', // HTTP method (GET)
        success: function(response) {
            const data = response.data;
            
            if (!data || data.length === 0) {
                alertify.warning('No templates found.');
                return;
            }
            
            // Map temp_type to corresponding elements
            const templateMap = {
                'Software Development': {
                    subject: 'softdev-template-subject',
                    editor: '#softdev-summernote',
                },
                'IT Managed Services': {
                    subject: 'managed-template-subject',
                    editor: '#managed-summernote',
                },
                'BPO': {
                    subject: 'bpo-template-subject',
                    editor: '#bpo-summernote',
                },
                'Startup MVP': {
                    subject: 'smvp-template-subject',
                    editor: '#smvp-summernote',
                }
            };

            // Loop through templates and set values dynamically
            data.forEach(element => {
                const template = templateMap[element.temp_type];
                if (template) {
                    document.getElementById(template.subject).value = element.temp_subject;
                    $(template.editor).summernote('code', element.temp_body);
                } else {
                    console.warn(`Unknown template type: ${element.temp_type}`);
                }
            });
        },
        error: function(xhr, status, error) {
            document.getElementById('loadingPage').style.display = 'none';
            console.error('Request failed:', error); // Log error for debugging
            alertify.error('Failed to fetch data');
        }
    });
}

$(document).ready(function() {
    // Initialize Summernote editors
    $('#soft-summernote').summernote();
    $('#it-summernote').summernote();
    $('#business-summernote').summernote();
    $('#mvp-summernote').summernote();
    $('#softdev-summernote').summernote();
    $('#managed-summernote').summernote();
    $('#bpo-summernote').summernote();
    $('#smvp-summernote').summernote();
    
    // Fetch templates on load
    GetTemplate();
    GetFollowupTemplate()
});

</script>