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
  