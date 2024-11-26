<script>
// Global variable for storing checked IDs
let checkedIds = [];

// Function to fetch leads data and initialize the table
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
        success: function (response) {
            // Initialize DataTable with the fetched data
            $('#leads-table').DataTable({
                data: response.data,
                destroy: true,
                columns: [
                    {
                        data: null,
                        render: function (data, type, row) {
                            const isChecked = checkedIds.includes(row.lead_id); // Check if ID is in `checkedIds`
                            return `<input type="checkbox" class="lead-checkbox" data-id="${row.lead_id}" ${isChecked ? 'checked' : ''} />`;
                        }
                    },
                    { data: 'lead_company' }, // Company Name
                    { data: 'lead_email' },   // Email
                    {
                        data: null,
                        render: function (data, type, row) {
                            return `${row.lead_firstname} ${row.lead_lastname}`;
                        }
                    },
                    { data: 'lead_type' },    // Lead Type
                ],
            });

            // Rebind checkbox events
            bindCheckboxEvents();
        },
        error: function (xhr, status, error) {
            document.getElementById('loadingPage').style.display = 'none';
            alertify.error('Failed to fetch data');
        }
    });
}

// Function to bind checkbox events
function bindCheckboxEvents() {
    // Handle 'Select All' checkbox functionality
    $('#select-all-checkbox').off('change').on('change', function () {
        const isChecked = $(this).prop('checked');
        $('#leads-table tbody .lead-checkbox').prop('checked', isChecked);
        updateCheckedIds();
    });

    // Handle individual checkbox changes
    $('#leads-table tbody').off('change', '.lead-checkbox').on('change', '.lead-checkbox', function () {
        const allChecked = $('#leads-table tbody .lead-checkbox').length === $('#leads-table tbody .lead-checkbox:checked').length;
        $('#select-all-checkbox').prop('checked', allChecked);
        updateCheckedIds();
    });

    // Update `checkedIds` when checkboxes change
    updateCheckedIds();
}

// Function to update the `checkedIds` array
function updateCheckedIds() {
    const uniqueIds = new Set();
    $('#leads-table tbody .lead-checkbox:checked').each(function () {
        uniqueIds.add($(this).data('id')); // Add to Set to prevent duplicates
    });
    checkedIds = Array.from(uniqueIds); // Convert Set back to Array
}

// Send Email Button Click
$('#send-email-btn').off('click').on('click', function () {
    if (checkedIds.length === 0) {
       Swal.fire({
        icon: "error",
        text: "Please Select at least one Lead to send Email",
        });
        return;
    }

    const service = $('#service').val();
    const sendData = {
        _token: '{{ csrf_token() }}',
        ids: checkedIds,
        service: service
    };

    document.getElementById('loadingPage').style.display = 'flex';
    $.ajax({
        url: '{{ route('BrochureMassMailing') }}', // Replace with your route for sending email
        type: 'post',
        data: sendData,
        success: function (response) {
            document.getElementById('loadingPage').style.display = 'none';
            $('#service').val('');
            alertify.success(response.message);

            // Clear state and reset UI
            checkedIds = [];
            $('#leads-table tbody .lead-checkbox').prop('checked', false);
            $('#select-all-checkbox').prop('checked', false);

            // Reload data and history
            GetLeadsData('');
            GetSentHistory();
        },
        error: function (xhr, status, error) {
            document.getElementById('loadingPage').style.display = 'none';
            alert('Failed to send emails');
        }
    });
});



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