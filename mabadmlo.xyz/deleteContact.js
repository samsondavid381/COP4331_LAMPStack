document.getElementById('cardDelButton').addEventListener('submit', function (e) {
    const userId = '<?php echo $userID;?>';
    const apiUrl = `http://api.mabadmlo.xyz/v1/contacts/${userId}`;

    fetch(apiUrl, {
        method: 'DELETE',
    })
    .then(response => response.json())
    .then(data => {
        const table = document.getElementById('contactsTableBody');
        const deleteButton = e.target;
        deleteButton.closest("tr").remove();

        console.log('Contact deleted:', data);
    })
    .catch(error => {
        // Handle errors here (e.g., show an error message)
        console.error('Error:', error);
    });

});
