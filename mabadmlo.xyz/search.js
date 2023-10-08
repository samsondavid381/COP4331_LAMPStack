function searchContacts() {
    let searchInput = document.getElementById("search-input").value.toLowerCase();
    let table = document.querySelector('.table'); 
    let rows = table.getElementsByTagName('tr'); 

    for (let i = 1; i < rows.length; i++) {
        let row = rows[i];
        let foundMatch = false;
        for (let j = 0; j < row.cells.length; j++) {
            let cell = row.cells[j];
            if (cell.textContent.toLowerCase().includes(searchInput)) {
                foundMatch = true;
                break; 
            }
        }
        if (foundMatch) {
            row.style.display = "";
        } else {
            row.style.display = "none"; 
        }
    }
}
