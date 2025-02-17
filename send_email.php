// script.js
document.addEventListener('DOMContentLoaded', function() {
    const previewButton = document.getElementById('preview-button');
    const sendButton = document.getElementById('send-button');
    const form = document.getElementById('email-form');
    const previewContainer = document.getElementById('preview');
    
    // Handle preview button click
    previewButton.addEventListener('click', function(e) {
        e.preventDefault();
        const formData = new FormData(form);
        const template = formData.get('template');
        const name = formData.get('customer_name');
        const email = formData.get('customer_email');
        
        // Generate the email preview
        previewContainer.innerHTML = generatePreview(template, name, email);
    });

    // Handle form submission (send email)
    sendButton.addEventListener('click', function(e) {
        e.preventDefault();
        const formData = new FormData(form);
        
        // Send email via AJAX
        fetch('send_email.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Email sent successfully!');
            } else {
                alert('Error sending email.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred.');
        });
    });
});

// Function to generate email preview
function generatePreview(template, name, email) {
    // Replace placeholders in the template with actual values
    let preview = template;
    preview = preview.replace('{customer_name}', name);
    preview = preview.replace('{customer_email}', email);

    return preview;
}
