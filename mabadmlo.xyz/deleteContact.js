function deleteRow(contactid){
    const userData = {
        FirstName: null,
        LastName: null,
        PrimaryPhone: null,
        PrimaryEmail: null,
            UserId:-1
        };
    const userId = getCookie('userId');
    let apiUrl = `http://api.mabadmlo.xyz/v1/contacts/` + userId+ "?contactid="+contactid;

    fetch(apiUrl, {
    method: 'PUT',
    body: JSON.stringify(userData),
    headers:{
        'Access-Control-Allow-Origin' : "*",
        'Access-Control-Allow-Methods' : "GET, POST, PUT, OPTIONS"
    }
        })
        .then(response => response.json())
        .then(data => {
            console.log('Contact edited successfully:', data);
        })
        .catch(error => {
            console.error('Error editing contact:', error);
        });
}
