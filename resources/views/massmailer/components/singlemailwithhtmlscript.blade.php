<script>
    function GetDataHistory(){

            $.ajax({
            url: '{{ route('GetSingleMailBrochure') }}', // Replace with your endpoint route
            type: 'GET', // HTTP method (GET)
            success: function(response) {
                    const dataBody = document.getElementById('historyData');
                    dataBody.innerHTML = ``;
                    response.data.forEach(element => {
                        // Extract and format the date
                        const dateObj = new Date(element.smh_date);
                        const formattedDate = dateObj.toISOString().split('T')[0]; // Format date as YYYY-MM-DD

                        // Create the main container div with Bootstrap classes
                        const container = document.createElement('div');
                        container.className = 'container m-1';

                        // Create the card div
                        const card = document.createElement('div');
                        card.className = 'card';

                        // Create the card body div
                        const cardBody = document.createElement('div');
                        cardBody.className = 'card-body';

                        // Create the title row for title and date
                        const titleRow = document.createElement('div');
                        titleRow.className = 'd-flex justify-content-between align-items-center';

                        // Create the title element, using element's title data
                        const title = document.createElement('h5');
                        title.className = 'card-title mb-0';
                        title.innerText = element.smh_mailto || ''; // Use dynamic title from smh_mailto or empty string if not available

                        // Append title to titleRow
                        titleRow.appendChild(title);

                        // Create the horizontal line
                        const hr = document.createElement('hr');
                        hr.className = 'my-2';

                        // Create the content paragraph, using element's content data
                        const content = document.createElement('p');
                        content.className = 'card-text text-muted';
                        content.innerText = element.smh_content || ''; // Use dynamic content from smh_content or empty string if not available

                        // Create the date element, using the formatted date
                        const dateElement = document.createElement('small');
                        dateElement.className = 'text-muted d-block mt-2'; // Add margin-top to separate from content
                        dateElement.innerText = formattedDate || ''; // Use formatted date or empty string

                        // Assemble the card
                        cardBody.appendChild(titleRow);
                        cardBody.appendChild(hr);
                        cardBody.appendChild(content);
                        cardBody.appendChild(dateElement); // Move date below content
                        card.appendChild(cardBody);
                        container.appendChild(card);

                        // Append the container to the dataBody
                        dataBody.appendChild(container);
                    });


                },
            error: function(xhr, status, error) {
                document.getElementById('loadingPage').style.display = 'none';
                console.error('Request failed:', error); // Log error for debugging
                alertify.error('Failed to fetch data');
            }
        });

        }
     
        function SubmitEmail(){
            const form = document.getElementById('submitEmailForm');
            const formData = new FormData(form);
            formData.append('_token', '{{ csrf_token() }}');
            document.getElementById('loadingPage').style.display='flex';
            $.ajax({
                url: `{{route('sendEmailWithHTMl')}}`, // Replace with your server endpoint
                type: 'POST',
                data: formData,
                processData: false, // Required for FormData
                contentType: false, // Required for FormData
                success: function(response) {
                    document.getElementById('loadingPage').style.display='none';
                    alertify.success(response.message);
                     GetDataHistory();
                     $('#submitEmailForm').find('input').not('#mailfrom').each(function() {
                        if ($(this).is(':radio')) {
                            $(this).prop('checked', false); // Reset radio button
                        } else {
                            $(this).val(''); // Reset other inputs
                        }
                    }); 
                },
                error: function(xhr, status, error) {
                    console.error('Form submission failed:', error);
                }
            });
        }

        $(document).ready(function() {
           GetDataHistory();
        });
</script>