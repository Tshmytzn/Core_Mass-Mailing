<script>
document.getElementById('uploadButton').addEventListener('click', function () {
    const fileInput = document.getElementById('fileInput');
    const file = fileInput.files[0];

    if (!file) {
        alert('Please select a file first!');
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

        // Extract specific columns (case-insensitive and handle missing columns)
        const extractedData = jsonData.map(row => {
            // Normalize keys to lowercase
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
                linkedin: normalizedRow['linkedin'] || '',  
            };
        });

        // Log extractedData for testing
        console.log(extractedData);

        // Send to Laravel using AJAX
        // $.ajax({
        //     url: '/your-laravel-route',
        //     type: 'POST',
        //     data: {
        //         _token: '{{ csrf_token() }}', // Include CSRF token
        //         data: extractedData,
        //     },
        //     success: function (response) {
        //         console.log('Data successfully sent:', response);
        //         alert('Data imported successfully!');
        //     },
        //     error: function (xhr) {
        //         console.error('Error sending data:', xhr.responseText);
        //         alert('Failed to import data. Please try again.');
        //     },
        // });
    };

    reader.readAsArrayBuffer(file);
});

</script>