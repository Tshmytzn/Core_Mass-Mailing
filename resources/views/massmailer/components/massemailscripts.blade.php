<script>
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