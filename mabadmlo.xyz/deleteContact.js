function deleteRow(e, userId) {
    apiURL='http://api.mabadmlo.xyz/v1/contacts/'+userId;
    fetch(userId, {
        method: 'DELETE',
    })
    .then(response => {
        if (response.ok) {
            // Remove the row from the table upon successful deletion
            const table = document.getElementById('contactsTableBody');
            const deleteButton = e.target;
            deleteButton.closest("tr").remove();

            console.log('Data removed');
        } else {
            console.error('Error');
        }
    })
    .catch(error => console.error('Error:', error));
}

