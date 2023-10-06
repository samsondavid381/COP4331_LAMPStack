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
  }
function closeNav() {
    document.getElementById("sidebar").style.width = "0";
  }
function showBlur(){
  document.getElementById("blurContainer").style.background="rgba(0,0,0,0.75)";
  document.getElementById("blurContainer").style.zIndex="1"
}
function hideBlur(){
  document.getElementById("blurContainer").style.background="rgba(0,0,0,0)";
  document.getElementById("blurContainer").style.zIndex="-1"
}
function showUser(){
  document.getElementById("userCard").style.display="block"
}
function hideUser(){
  document.getElementById("userCard").style.display="none"
}