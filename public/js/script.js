
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");
// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");
// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
    } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
    }
}
// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
    overlayBg.style.display = "none";
}


function statusToggle(evt) {
    let item = evt.currentTarget;
    console.log(item);
    if (item.className.indexOf("w3-color-brnda") == -1) {
        item.className += " w3-color-brnda";

    } else {
        item.className = item.className.replace(" w3-color-brnda", "");
    }
}
