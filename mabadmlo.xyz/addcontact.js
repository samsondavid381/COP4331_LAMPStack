
function add_contact(){
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
    const userId = getCookie('userId');
    const apiUrl = `http://api.mabadmlo.xyz/v1/contacts/${userId}`;

    fetch(apiUrl, {
    method: 'POST',
    body: JSON.stringify(userData)
        })
        .then(response => response.json())
        .then(data => {
            console.log('Contact added successfully:', data);
        })
        .catch(error => {
            console.error('Error adding contact:', error);
        });
    }