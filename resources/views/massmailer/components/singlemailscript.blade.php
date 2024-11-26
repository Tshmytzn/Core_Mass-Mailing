<script>
        function GetDataHistory(){

            $.ajax({
            url: '{{ route('GetSingleMailWord') }}', // Replace with your endpoint route
            type: 'GET', // HTTP method (GET)
            success: function(response) {
                   const dataBody = document.getElementById('historyData');
                    dataBody.innerHTML = ``;

                    response.data.forEach((element, index) => {
                        // Extract and format the date
                        const dateObj = new Date(element.smh_date);
                        const formattedDate = dateObj.toISOString().split('T')[0]; // Format date as YYYY-MM-DD

                        // Create the anchor element
                        const anchor = document.createElement("a");
                        anchor.href = `#chat-${index + 1}`; // Unique anchor href
                        anchor.className = "nav-link text-start mw-100 p-3";
                        anchor.id = `chat-${index + 1}-tab`; // Unique ID
                        anchor.setAttribute("data-bs-toggle", "pill");
                        anchor.setAttribute("role", "tab");
                        anchor.setAttribute("aria-selected", "false"); // Default to false

                        // Create the row div
                        const row = document.createElement("div");
                        row.className = "row align-items-center flex-fill";

                        // Create the first column with the avatar
                        // const colAvatar = document.createElement("div");
                        // colAvatar.className = "col-auto";
                        // const avatar = document.createElement("span");
                        // avatar.className = "avatar";
                        // avatar.textContent = 'Core'; // Use dynamic avatar or default
                        // colAvatar.appendChild(avatar);

                        // Create the second column with text content
                        const colText = document.createElement("div");
                        colText.className = "col text-body";
                        const nameDiv = document.createElement("div");
                        nameDiv.textContent = element.smh_mailto || "Unknown"; // Use dynamic name or default
                        const messageDiv = document.createElement("div");
                        messageDiv.className = "text-secondary text-truncate w-100";
                        messageDiv.textContent = element.smh_subject || "No subject available"; // Use dynamic message or default
                        colText.appendChild(nameDiv);
                        colText.appendChild(messageDiv);

                        // Create the third column with the date
                        const colDate = document.createElement("div");
                        colDate.className = "col-auto";
                        const dateSpan = document.createElement("span");
                        dateSpan.textContent = formattedDate || "Unknown date"; // Use formatted date or fallback
                        colDate.appendChild(dateSpan);

                        // Append all columns to the row
                        // row.appendChild(colAvatar);
                        row.appendChild(colText);
                        row.appendChild(colDate);

                        // Append the row to the anchor
                        anchor.appendChild(row);

                        // Append the anchor to the data body
                        dataBody.appendChild(anchor);
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
                url: `{{route('sendEmail')}}`, // Replace with your server endpoint
                type: 'POST',
                data: formData,
                processData: false, // Required for FormData
                contentType: false, // Required for FormData
                success: function(response) {
                    document.getElementById('loadingPage').style.display='none';
                    alertify.success(response.message);
                     $('#submitEmailForm').find('input, textarea').not('#mailfrom').val('');
                     $('#summernote').summernote('code', '');
                     GetDataHistory();
                },
                error: function(xhr, status, error) {
                    console.error('Form submission failed:', error);
                }
            });
        }

         $(document).ready(function() {
            GetDataHistory()
            $('#summernote').summernote({
                height: 300,  // Set the height of the editor
                focus: true ,   // Focus on the editor when initialized
                toolbar: [
                    ['style', ['bold', 'italic', 'underline']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']], // Remove image and video
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
        });
</script>