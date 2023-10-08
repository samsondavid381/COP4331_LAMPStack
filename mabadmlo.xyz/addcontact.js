
    document.getElementById('contact-form').addEventListener('submit', function (e) {
        const firstName = document.getElementById('firstname').value;
        const lastName = document.getElementById('lastname').value;
        const phone = document.getElementById('phone').value;
        const email = document.getElementById('email').value;
        const userData = {
            FirstName: firstName,
            LastName: lastName,
            PrimaryPhone: phone,
            PrimaryEmail: email
        };
        const userId = '<?php echo $userID;?>';
        const apiUrl = `http://api.mabadmlo.xyz/v1/contacts/${userId}`;

        fetch(apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(userData)
        })
        .then(response => response.json())
        .then(data => {
            console.log('Contact added successfully:', data);
        })
        .catch(error => {
            // Handle errors here (e.g., show an error message)
            console.error('Error adding contact:', error);
        });
    });

