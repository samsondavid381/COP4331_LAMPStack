function validateLoginForm() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var apiUrl = "http://api.mabadmlo.xyz/v1/login/" + username + "?password=" + password;
    console.log(apiUrl);
    
    fetch(apiUrl, {
        method: 'POST'
    })
    .then(response => {
        if (response.ok) {
            var resjson = response.json();
            console.log(resjson);
            return resjson;
        } else {
            document.getElementById("resultMessage").innerHTML = "Username or password incorrect :( Try again";
            throw new Error("Authentication failed");
        }
    })
    .then(data => {
        document.cookie = "userId=" + data.userId;
        window.location.href = "home.html";
    })
    .catch(error => {
        console.error(error);
        document.getElementById("resultMessage").innerHTML = "ERROR! :( ";
    });
}
