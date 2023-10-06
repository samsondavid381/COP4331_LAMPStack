
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
          
            firstNameCell.textContent = contact.first_name;
            lastNameCell.textContent = contact.last_name;
            phoneCell.textContent = contact.phone;
            emailCell.textContent = contact.email;
            row.addEventListener('click', () => {
                showUser(contact); 
                showBlur(); 
            });
    });
}
function showUser(contact){
    const userCard = document.getElementById("userCard");
    userCard.style.display="block";
    userCard.innerHTML = contact.FirstName + '<br>' + contact.LastName + '<br>' + contact.PrimaryPhone + '<br>' + contact.PrimaryEmail;
}
function hideUser(){
    document.getElementById("userCard").style.display="none"
}
          