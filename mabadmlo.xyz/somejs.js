function showForm(id)
{
    document.getElementById(id).style.display="block"
}
function hideForm(id)
{
    document.getElementById(id).style.display="none";
} 
function openNav() {
    document.getElementById("sidebar").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
  }
  

function closeNav() {
    document.getElementById("sidebar").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
  }
function showBlur(){
  document.getElementById("blurContainer").style.background="rgba(0,0,0,0.75)";
  document.getElementById("blurContainer").style.zIndex="1"
}
function hideBlur(){
  document.getElementById("blurContainer").style.background="rgba(0,0,0,0)";
  document.getElementById("blurContainer").style.zIndex="-1"
}
function deleteCookies() {
  var Cookies = document.cookie.split(';');
  for (var i = 0; i < Cookies.length; i++)
  document.cookie = Cookies[i] + "=;expires=" + new Date(0).toUTCString();
}

