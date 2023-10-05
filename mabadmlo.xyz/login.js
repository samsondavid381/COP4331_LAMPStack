document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("login-form");
    const resultMessage = document.getElementById("resultMessage");

    loginForm.addEventListener("submit", function (event) {
        event.preventDefault();
        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;
        const apiUrl = "https://api.mabadmlo.xyz/v1/login/{username}?password={password}";
        fetch(apiUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ Username, Password}),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                resultMessage.textContent = "Login successful!";
                window.location.href = "home.html";
            } else {
                resultMessage.textContent = "Login failed. Please check your credentials.";
            }
        })
        .catch(error => {
            console.error("Error:", error);
            resultMessage.textContent = "An error occurred. Please try again later.";
        });
    });
});