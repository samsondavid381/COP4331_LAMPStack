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

function validateUserId(userId) {
    const id = getCookie("userId");

    if (id === null|| isNaN(id) || parseInt(id) <1 || id !== userId) {
        window.location.href = "login.html";
    }
    //document.getElementById("header").innerHTML = userId;
}