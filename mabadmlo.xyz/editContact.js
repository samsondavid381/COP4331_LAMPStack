
function editContact(){


    const firstName = document.getElementById('upd_firstname').value;
    const lastName = document.getElementById('upd_lastname').value;
    const phone = document.getElementById('upd_phoneNumber').value;
    const email = document.getElementById('upd_email').value;
    const userData = {
            FirstName: firstName,
            LastName: lastName,
            PrimaryPhone: phone,
            PrimaryEmail: email
        };
    const userId = getCookie('userId');
    let apiUrl = "http://api.mabadmlo.xyz/v1/contacts/" + userId;

    fetch(apiUrl, {
    method: 'PUT',
    body: JSON.stringify(userData)
        })
        .then(response => response.json())
        .then(data => {
            console.log('Contact edited successfully:', data);
        })
        .catch(error => {
            console.error('Error editing contact:', error);
        });
}
