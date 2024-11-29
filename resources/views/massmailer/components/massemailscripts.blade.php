<script>
// Global variable for storing checked IDs
let checkedIds = [];

// Function to fetch leads data and initialize the table
function GetLeadsData(type) {
    const formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('type', type);

    $.ajax({
        url: '{{ route('GetLeadsDataWordByService') }}', // Replace with your endpoint route
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


function GetLeadsDataFollowUp(type) {
    const formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('type', $('#service2').val());
    formData.append('send_count', $('#sent-count').val());

    $.ajax({
        url: '{{ route('GetLeadsDataWordByServiceFollowUp') }}', // Replace with your endpoint route
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
function sendmassmailing(button) {
    if (checkedIds.length === 0) {
        Swal.fire({
            icon: "error",
            text: "Please Select at least one Lead to send Email",
        });
        return;
    }

    // Define service variable outside the if condition
    let service;
    if (button == '1') {
        service = $('#service').val();
    } else {
        service = $('#service2').val();
    }

    const sendData = {
        _token: '{{ csrf_token() }}',
        ids: checkedIds,
        service: service
    };

    // Show loading
    $('#loadingPage').css('display', 'flex');

    $.ajax({
        url: '{{ route('sendMassEmail') }}', // Replace with your route for sending email
        type: 'post',
        data: sendData,
        success: function (response) {
            $('#loadingPage').css('display', 'none');
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
            $('#loadingPage').css('display', 'none');
            // Display detailed error message
            alert('Failed to send emails: ' + xhr.responseText);
        }
    });
}

function showfirst() {
    $('#service').val('');
    document.getElementById('second-mail').style.display = 'block'; // Correct display value
    document.getElementById('third-mail').style.display = 'none';

    checkedIds = [];
    $('#leads-table tbody .lead-checkbox').prop('checked', false);
    $('#select-all-checkbox').prop('checked', false);

    GetLeadsData('');
}

function showsecond() {
    $('#service').val('');
    document.getElementById('second-mail').style.display = 'none'; // Correct display value
    document.getElementById('third-mail').style.display = 'block';

    checkedIds = [];
    $('#leads-table tbody .lead-checkbox').prop('checked', false);
    $('#select-all-checkbox').prop('checked', false);

    // Reload data and history
    GetLeadsData('');
}


 function GetSentHistory(){
    $.ajax({
        url: '{{ route('WordMassMailingHistory') }}', // Replace with your endpoint route
        type: 'GET', // HTTP method (GET)
        success: function(response) {
            console.log(response)
            $('#sent-table').DataTable( {
                data: response.data,
                destroy: true, // Ensure the table is destroyed before reinitializing
                columns: [
                    { data: 'lead_company' }, // First Name
                    { data: 'lead_email' },  // Last Name
                    { data: null,
                        render: function (data, type, row) {
                            return `${row.lead_firstname} ${row.lead_lastname}`;
                        }
                    }, // Full name
                    { data: 'lead_type' }, // Lead Type
                    { data: 'lead_send_date' }, // Lead Send Date
                    { data: 'lead_status' }, // Lead Status
                ],
                order: [[4, 'asc']], // Sort by lead_send_date (column index 4) in descending order by default
            });
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