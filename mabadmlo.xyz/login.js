function validateLoginForm() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var apiUrl = "https://api.mabadmlo.xyz/v1/login/" + encodeURIComponent(username) + "?password=" + encodeURIComponent(password);

    fetch(apiUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
    })
    .then(response => {
        if (response.ok) {
            window.location.href = "home.html";
        } else {
            document.getElementById("resultMessage").innerHTML = "Username or password incorrect :( Try again";
        }
    })
    .catch(error => {
        console.error(error);
        document.getElementById("resultMessage").innerHTML = "ERROR! :( ";
    });
}
