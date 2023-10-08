function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        console.log(c.substring(name.length, c.length));
        return c.substring(name.length, c.length);
      }
    }
    return "";
}

function validateUserId() {
    const userId = getCookie("userId");

    if (userId === null|| isNaN(userId) || parseInt(userId) <1) {
        window.location.href = "login.html";
    }
    //document.getElementById("header").innerHTML = userId;
}