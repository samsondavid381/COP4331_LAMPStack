
function add_contact(){
    let firstName = document.getElementById('firstname').value;
    let lastName = document.getElementById('lastname').value;
    let phone = document.getElementById('phoneNumber').value;
    let email = document.getElementById('email').value;
    let userData = {
            FirstName: firstName,
            LastName: lastName,
            PrimaryPhone: phone,
            PrimaryEmail: email
        };
    let userId = getCookie('userId');
    let apiUrl = 'http://api.mabadmlo.xyz/v1/contacts/' + userId;

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