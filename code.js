/* Toggle between adding and removing the "responsive" class to topmenu class when the user clicks on the icon */
function showMenu() {
    var x = document.getElementById("topmenu");
    if (x.className === "topmenu") {
        x.className += " responsive";
    } else {
        x.className = "topmenu";
    }
}
