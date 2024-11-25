<script>
document.getElementById('uploadButton').addEventListener('click', function () {
    const fileInput = document.getElementById('fileInput');
    const file = fileInput.files[0];
    document.getElementById('loadingPage').style.display='flex';
    if (!file) {
        document.getElementById('loadingPage').style.display='none';
        Swal.fire({
            icon: 'warning', // Use 'warning' to indicate attention is needed
            title: 'No File Selected',
            text: 'Please select a file first!',
            confirmButtonText: 'Okay'
        });
        return;
    }

    const reader = new FileReader();

    reader.onload = function (e) {
        const data = new Uint8Array(e.target.result);
        const workbook = XLSX.read(data, { type: 'array' });

        // Get the first sheet
        const sheetName = workbook.SheetNames[0];
        const sheet = workbook.Sheets[sheetName];

        // Convert sheet data to JSON
        const jsonData = XLSX.utils.sheet_to_json(sheet);

        // Normalize and extract relevant columns
        const extractedData = jsonData.map(row => {
            const normalizedRow = Object.keys(row).reduce((acc, key) => {
                acc[key.toLowerCase()] = row[key];
                return acc;
            }, {});

            return {
                firstname: normalizedRow['first name'] || '',
                lastname: normalizedRow['last name'] || '',
                email: normalizedRow['email'] || '',
                number: normalizedRow['number'] || '',
                company: normalizedRow['company'] || '',
                type: normalizedRow['service offered'] || '',
            };
        });

        // Filter out rows that don't have at least one of firstname, lastname, or company
        const validData = extractedData.filter(row => row.firstname || row.lastname || row.email);

        if (validData.length === 0) {
            document.getElementById('loadingPage').style.display='none';
           Swal.fire({
                icon: 'error', // Use 'error' to indicate an issue
                title: 'Invalid Data',
                text: 'No valid data found. At least one of "First Name", "Last Name", or "Company" must be present in each row.',
                confirmButtonText: 'Okay'
            });
            return;
        }

        // Chunk the data into smaller parts (e.g., 100 rows per chunk)
        const chunkSize = 100;  // Adjust based on your preference
        const chunks = [];
        for (let i = 0; i < validData.length; i += chunkSize) {
            chunks.push(validData.slice(i, i + chunkSize));
        }

        // Send each chunk via AJAX
        chunks.forEach((chunk, index) => {
            $.ajax({
                url:  `{{route('InsertLeadsData')}}`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Include CSRF token
                    data: chunk,
                },
                success: function (response) {
                document.getElementById('loadingPage').style.display='none';
                Swal.fire({
                    title: "Data Successfully Insert",
                    icon: "success"
                });
                 GetLeadsData()
                },
                error: function (xhr) {
                    console.error('Error sending chunk:', xhr.responseText);
                    alert('Failed to import some data. Please try again.');
                },
            });
        });
    };

    reader.readAsArrayBuffer(file);
});

function GetLeadsData() {
    $.ajax({
        url: '{{ route('GetLeadsData') }}', // Replace with your endpoint route
        type: 'GET', // HTTP method (GET)
        success: function(response) {
           
            // Initialize DataTable with the fetched data
            $('#leads-table').DataTable( {
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
                    { data: 'lead_type' },    // Company
                    { data: 'lead_company' } 
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
     GetLeadsData()
     });
</script>