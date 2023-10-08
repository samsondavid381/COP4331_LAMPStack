function validateRegistrationForm() {
    var registerUsername = document.getElementById("reg-username").value;
    var registerPassword = document.getElementById("reg-password").value;
    var confirmPassword = document.getElementById("reg-confirm").value;
    var apiUrl = "http://api.mabadmlo.xyz/v1/register";
    var data = {
        Username: registerUsername,
        Password: registerPassword,
        Confirm: confirmPassword
    };
    if (registerPassword.value===confirmPassword.value){
        fetch(apiUrl, {
            method: 'POST',
            body: JSON.stringify(data), 
        })
        .then(response => {
            if (response.ok) {
                document.getElementById("regResultMessage").innerHTML = "Registration successful!";
                document.getElementById("regResultMessage").style.color = "green";
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