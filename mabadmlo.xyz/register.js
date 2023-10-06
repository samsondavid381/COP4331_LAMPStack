function validateRegistrationForm() {
    var registerUsername = document.getElementById("reg-username").value;
    var registerPassword = document.getElementById("reg-password").value;
    var confirmPassword = document.getElementById("reg-confirm").value;
    var apiUrl = "http://api.mabadmlo.xyz/v1/register";
    var data = {
        username: registerUsername,
        password: registerPassword,
        confirm: confirmPassword
    };
    if (password===confirmPassword){
        fetch(apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json', 
            },
            body: JSON.stringify(data), 
        })
        .then(response => {
            if (response.ok) {
                document.getElementById("regResultMessage").innerHTML = "Registration successful!";
            } else {
                document.getElementById("regResultMessage").innerHTML = "Registration failed. Please try again.";
            }
        })
        .catch(error => {
            console.error(error);
            document.getElementById("regResultMessage").innerHTML = "ERROR :(";
        });
    }
}