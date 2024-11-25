<script>
function GetLeadsData(type) {
    const formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('type', type);

    $.ajax({
        url: '{{ route('GetLeadsDataByService') }}', // Replace with your endpoint route
        type: 'post', 
        data: formData,
        processData: false,
        contentType: false, 
        success: function(response) {
            // Initialize DataTable with the fetched data
            $('#leads-table').DataTable({
                data: response.data,
                destroy: true,
                columns: [
                    { 
                        data: null,
                        render: function(data, type, row) {
                            return `<input type="checkbox" class="lead-checkbox" data-id="${row.lead_id}" />`;
                        }
                    }, // Checkbox Column in the first column
                    { data: 'lead_company' }, // Company Name
                    { data: 'lead_email' },   // Email
                    { 
                        data: null,
                        render: function(data, type, row) {
                            return `${row.lead_firstname} ${row.lead_lastname}`; // Full name
                        }
                    }, // Full Name
                    { data: 'lead_type' },    // Lead Type
                ],
            });

            // Handle 'Select All' checkbox functionality
            $('#select-all-checkbox').on('change', function() {
                var isChecked = $(this).prop('checked');
                // Check or uncheck all checkboxes in the table body
                $('#leads-table tbody .lead-checkbox').prop('checked', isChecked);
                logCheckedCheckboxes(); // Log checked checkboxes after toggle
            });

            // Handle individual checkbox changes
            $('#leads-table tbody').on('change', '.lead-checkbox', function() {
                // Check if all individual checkboxes are checked
                var allChecked = $('#leads-table tbody .lead-checkbox').length === $('#leads-table tbody .lead-checkbox:checked').length;
                $('#select-all-checkbox').prop('checked', allChecked);
                logCheckedCheckboxes(); // Log checked checkboxes after individual toggle
            });

            // Function to log all checked checkboxes
            function logCheckedCheckboxes() {
                var checkedIds = [];
                $('#leads-table tbody .lead-checkbox:checked').each(function() {
                    checkedIds.push($(this).data('id')); // Get the ID of each checked checkbox
                });
            }

            // Send Email Button Click
            $('#send-email-btn').on('click', function() {
                var checkedIds = [];
                $('#leads-table tbody .lead-checkbox:checked').each(function() {
                    checkedIds.push($(this).data('id')); // Get the ID of each checked checkbox
                });

                if (checkedIds.length === 0) {
                    alert('Please select at least one lead.');
                    return; // Do not proceed if no checkboxes are selected
                }

                const service = $('#service').val(); // Get selected service

                // Send selected IDs to the server
                const sendData = {
                    _token: '{{ csrf_token() }}',
                    ids: checkedIds, // Array of selected lead IDs
                    service: service // Selected service type
                };
                document.getElementById('loadingPage').style.display='flex';
                $.ajax({
                    url: '{{ route('BrochureMassMailing') }}', // Replace with your route for sending email
                    type: 'post',
                    data: sendData,
                    success: function(response) {
                        document.getElementById('loadingPage').style.display='none';
                         $('#service').val(''); 
                         alertify.success(response.message);
                         GetLeadsData('')
                         GetSentHistory()
                    },
                    error: function(xhr, status, error) {
                        alert('Failed to send emails');
                        console.error('Error:', error);
                    }
                });
            });
        },
        error: function(xhr, status, error) {
            document.getElementById('loadingPage').style.display = 'none';  // Hide loading page on error
            console.error('Request failed:', error); // Log error for debugging
            alertify.error('Failed to fetch data');  // Display error message using alertify
        }
    });
}

function GetSentHistory(){
    $.ajax({
        url: '{{ route('BrochureMassMailingHistory') }}', // Replace with your endpoint route
        type: 'GET', // HTTP method (GET)
        success: function(response) {
            
            $('#sent-table').DataTable( {
                data: response.data,
                destroy:true,
                 columns: [
                    { data: 'lead_company' }, // First Name
                    { data: 'lead_email' },  // Last Name
                    { data: null,
                        render: function ( data, type, row ) {
                            return `${row.lead_firstname} ${row.lead_lastname}`;
                            }

                    },     // Email
                    { data: 'lead_type' },
                ],
            } );
        },
        error: function(xhr, status, error) {
            document.getElementById('loadingPage').style.display = 'none';  // Hide loading page on error
            console.error('Request failed:', error); // Log error for debugging
            alertify.error('Failed to fetch data');  // Display error message using alertify
        }
    });
}


$(document).ready(function() {
    GetSentHistory()
     });
</script>