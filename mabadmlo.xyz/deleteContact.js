function deleteRow(contactid){
    const userData = {
        FirstName: firstName,
        LastName: lastName,
        PrimaryPhone: phone,
        PrimaryEmail: email,
            UserId:-1
        };
    const userId = getCookie('userId');
    let apiUrl = `http://api.mabadmlo.xyz/v1/contacts/` + userId+ "?contact=?"+contactid;

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
