
function populateTableForUser(userId) {
    apiUrl='https://api.mabadmlo.xyz/v1/contacts/'+userId;
    console.log(apiUrl);
    fetch(apiUrl)
    .then(response => response.json())
    .then(data => {
        populateTable(data);
        console.log(data);
    })
    .catch(error => {
        console.error('Error fetching contacts:', error);
    });
}
          
function populateTable(contacts) {
        const tableBody = document.getElementById('contactsTableBody');
        contacts.forEach(contact => {
            const row = tableBody.insertRow();
            const firstNameCell = row.insertCell(0);
            const lastNameCell = row.insertCell(1);
            const phoneCell = row.insertCell(2);
            const emailCell = row.insertCell(3);
            const addressCell = row.insertCell(4);
          
            firstNameCell.textContent = contact.FirstName;
            lastNameCell.textContent = contact.LastName;
            phoneCell.textContent = contact.PrimaryPhone;
            emailCell.textContent = contact.PrimaryEmail;
            addressCell.textContent = contact.address;
            row.addEventListener('click', () => {
                showUser(); 
                showBlur(); 
            });
    });
}
          