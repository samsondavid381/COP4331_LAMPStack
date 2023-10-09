function deleteRow(){


    const firstName = document.getElementById('firstname').value;
    const lastName = document.getElementById('lastname').value;
    const phone = document.getElementById('phone').value;
    const email = document.getElementById('email').value;
    const userData = {
            UserId:-1
        };
    const userId = getCookie('userId');
    const apiUrl = `http://api.mabadmlo.xyz/v1/contacts/${userId}`;

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
