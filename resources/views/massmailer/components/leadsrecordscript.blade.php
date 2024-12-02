<script>
    document.getElementById('uploadButton').addEventListener('click', function() {
        const fileInput = document.getElementById('fileInput');
        const file = fileInput.files[0];
        document.getElementById('loadingPage').style.display = 'flex';
        if (!file) {
            document.getElementById('loadingPage').style.display = 'none';
            Swal.fire({
                icon: 'warning', // Use 'warning' to indicate attention is needed
                title: 'No File Selected',
                text: 'Please select a file first!',
                confirmButtonText: 'Okay'
            });
            return;
        }

        const reader = new FileReader();

        reader.onload = function(e) {
            const data = new Uint8Array(e.target.result);
            const workbook = XLSX.read(data, {
                type: 'array'
            });

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
                document.getElementById('loadingPage').style.display = 'none';
                Swal.fire({
                    icon: 'error', // Use 'error' to indicate an issue
                    title: 'Invalid Data',
                    text: 'No valid data found. At least one of "First Name", "Last Name", or "Company" must be present in each row.',
                    confirmButtonText: 'Okay'
                });
                return;
            }

            // Chunk the data into smaller parts (e.g., 100 rows per chunk)
            const chunkSize = 100; // Adjust based on your preference
            const chunks = [];
            for (let i = 0; i < validData.length; i += chunkSize) {
                chunks.push(validData.slice(i, i + chunkSize));
            }

            // Send each chunk via AJAX
            chunks.forEach((chunk, index) => {
                $.ajax({
                    url: `{{ route('InsertLeadsData') }}`,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Include CSRF token
                        data: chunk,
                    },
                    success: function(response) {
                        document.getElementById('loadingPage').style.display = 'none';
                        Swal.fire({
                            title: "Leads Successfully Uploaded",
                            icon: "success"
                        });
                        GetLeadsData()
                    },
                    error: function(xhr) {
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
            $('#leads-table').DataTable({
                data: response.data,
                destroy: true,
                columns: [
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `<input type="checkbox" class="row-checkbox" data-id="${row.lead_id}">`;
                        }
                    }, // Checkbox column
                    { data: 'lead_company' }, // Company
                    { data: 'lead_email' }, // Email
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `${row.lead_firstname} ${row.lead_lastname}`;
                        }
                    }, // Full Name
                    { data: 'lead_type' }, // Type
                    { data: 'lead_status' }, // Status
                    {
                        data: 'action',
                        render: function(data, type, row) {
                            return `<button class="btn btn-sm btn-ghost-danger btn-md delete-btn text-center" data-id="${row.lead_id}">
                                        <svg class='m-1' xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M4 7l16 0"/>
                                            <path d="M10 11l0 6"/>
                                            <path d="M14 11l0 6"/>
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/>
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/>
                                        </svg>
                                    </button>`;
                        }
                    }, // Actions
                ],
                initComplete: function() {
                    // Add a Select All checkbox to the header
                    $('#leads-table thead tr').prepend(`
                        <th class="text-center">
                            <input type="checkbox" id="select-all">
                        </th>
                    `);

                    // Add a Select All checkbox to the footer
                    $('#leads-table thead input#select-all').on('click', function() {
                        const isChecked = $(this).prop('checked');
                        $('.row-checkbox').prop('checked', isChecked);
                    });
                }
            });

            // Add an event listener for the delete all button
            $('#delete-selected').on('click', function() {
                let selectedIds = [];
                $('.row-checkbox:checked').each(function() {
                    selectedIds.push($(this).data('id'));
                });

                if (selectedIds.length > 0) {

                    Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                    $.ajax({
                            url: '{{ route('DeleteLeads') }}', // Replace with your delete endpoint
                            type: 'POST',
                            data: {
                                ids: selectedIds,
                                _token: '{{ csrf_token() }}' // Include CSRF token if necessary
                            },
                            success: function(response) {
                                alertify.success('Selected leads deleted successfully');
                                GetLeadsData(); // Refresh the DataTable
                            },
                            error: function(xhr, status, error) {
                                alertify.error('Failed to delete selected leads');
                            }
                        });
                    });

                    // if (confirm('Are you sure you want to delete the selected leads?')) {
                        
                    // }
                } else {
                    alertify.warning('No rows selected');
                }
            });
        },
        error: function(xhr, status, error) {
            document.getElementById('loadingPage').style.display = 'none'; 
            console.error('Request failed:', error); 
            alertify.error('Failed to fetch data'); 
        }
    });
}


    function ManualinputLeadsData() {

        const form = document.getElementById('ManualinputLeadsForm');
        const formData = new FormData(form);
        const requiredFields = ['firstName', 'lastName', 'email', 'company', 'services'];

        for (let field of requiredFields) {
            const value = formData.get(field)?.trim();
            if (!value) {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill in all the required fields!',
                });
                return;
            }
        }

        $.ajax({
            url: '/ManualInsertLeadsdata',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Leads Data inserted successfully!',
                }).then(function() {

                    $('#leads-table').DataTable().ajax.reload();
                });

            },
            error: function(xhr, status, error) {

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'There was an issue inserting the lead. Please try again!',
                });
            }
        });

    }

    $(document).on('click', '.delete-btn', function() {
        var leadId = $(this).data('id');

        const formData = new FormData();
        formData.append('id', leadId);
        formData.append('_token', '{{ csrf_token() }}');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: '/DeleteLead',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if(response.success){
                            Swal.fire(
                            'Deleted!',
                            'The lead has been deleted.',
                            'success'
                        );
                        GetLeadsData();
                        }else{
                            Swal.fire(
                            'Cant Deleted',
                            response.message,
                            'error'
                        );
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Error!',
                            'There was an issue deleting the lead. Please try again.',
                            'error'
                        );
                    }
                });
            }
        });
    });


    $(document).ready(function() {
        GetLeadsData()
    });
</script>
