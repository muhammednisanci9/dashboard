function sidebaropen(){
	document.getElementById("sidebar-container").style.width = "250px";
}
function sidebarclose(){
	document.getElementById("sidebar-container").style.width = "75px";
}

function sidebarlist() {
  	document.getElementById("sidebar-alt-items").classList.toggle("dropdownshow");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.sidebar-item')) {
    var dropdowns = document.getElementsByClassName("sidebar-alt-items");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('dropdownshow')) {
        openDropdown.classList.remove('dropdownshow');
      }
    }
  }
}