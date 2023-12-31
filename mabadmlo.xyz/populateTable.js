
function populateTableForUser(userId) {

    apiUrl='http://api.mabadmlo.xyz/v1/contacts/'+userId;
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
        firstNameCell.textContent = contact.FirstName;
        lastNameCell.textContent = contact.LastName;
        phoneCell.textContent = contact.PrimaryPhone;
        emailCell.textContent = contact.PrimaryEmail;
        row.addEventListener('click', () => {
            document.cookie = "contactid=" + contact.ContactId;
            showUser(contact); 
            showBlur(); 
            document.getElementById('userCard').addEventListener('click',() => {
                hideUser();
                hideBlur();
            });
        });
    });
    
}
function showUser(contact){
    const userCard = document.getElementById("userCard");
    userCard.style.display="block";
    userCard.innerHTML = contact.FirstName + '<br>' + contact.LastName + '<br>' + contact.PrimaryPhone + '<br>' + contact.PrimaryEmail;
    document.getElementById("cardDelButton").style.display="inline-block"
    document.getElementById("cardUpdButton").style.display="inline-block"
}
function hideUser(){
    document.getElementById("userCard").style.display="none"
    document.getElementById("cardDelButton").style.display="none"
    document.getElementById("cardUpdButton").style.display="none"
}
          