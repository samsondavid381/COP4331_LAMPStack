function editRow(e, userId) {
    userId = getCookie('userId');
    apiURL='http://api.mabadmlo.xyz/v1/contacts/'+userId;
    fetch(userId, {
        method: 'POST',
    })
    .then(response => {
        if (response.ok) {

            target=e.target;
            if(target.classList.contains("edit")){
                currentRow=target.parentElement.parentElement;
                document.getElementById("First").value=currentRow.children[0].textContent;
                document.getElementById("Last").value=currentRow.children[1].textContent;
                document.getElementById("Phone").value=currentRow.children[2].textContent;
                document.getElementById("Email").value=currentRow.children[3].textContent;
            }
           
           // const table = document.getElementById('contactsTableBody');
            
            console.log('Data edited');
        } else {
            console.error('Error');
        }
    })
    .catch(error => console.error('Error:', error));

}
//once i click edit, a window pops up, with the table already filled, once i hit confirm it updates