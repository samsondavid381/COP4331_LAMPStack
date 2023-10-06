function searchContacts() {
    var searchInput = document.getElementById("search-input").value.toLowerCase();
    var table = document.querySelector('.table'); 
    var rows = table.getElementsByTagName('tr'); 

    for (var i = 1; i < rows.length; i++) {
        var row = rows[i];
        var firstNameCell = row.cells[0];
        if (firstNameCell.textContent.toLowerCase().includes(searchInput)) {
            row.style.display = ""; 
        } else {
            row.style.display = "none";
        }
    }
}
