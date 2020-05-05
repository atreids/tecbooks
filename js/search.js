//This page is called from the browse.php pages search bar
function searchbar() {
  var searchterm = document.getElementById("searchbar").value;

  var xhttp;
  if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
  } else {
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("book_display").innerHTML = this.responseText;
    }
  };
  xhttp.open("POST", "./php/search.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("searchterm=" + searchterm);
}
