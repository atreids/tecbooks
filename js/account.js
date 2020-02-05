function loadDoc(url, cFunction) {
  //generic ajax function
  var xhttp;
  if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
  } else {
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      cFunction(this);
    }
  };
  xhttp.open("GET", url, true);
  xhttp.send();
}

function updateEmail() {
  //Is used to update user's email address
  var newemail = document.getElementById("newemail").value;
  var xhttp;
  if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
  } else {
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("ajax").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "./inc/updatedetails.php?q=" + newemail, true);
  xhttp.send();
}

function addAddress(xhttp) {
  var num = document.getElementById("num").value;
  var street = document.getElementById("street").value;
  var city = document.getElementById("city").value;
  var zip = document.getElementById("zip").value;
  var iso = document.getElementById("iso").value;
  var add_type = document.getElementById("add_type").value;
  var xhttp;
  if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
  } else {
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("ajax").innerHTML = this.responseText;
    }
  };
  xhttp.open("POST", "./inc/new_address.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(
    "num=" +
      num +
      "&street=" +
      street +
      "&city=" +
      city +
      "&zip=" +
      zip +
      "&iso=" +
      iso +
      "&add_type=" +
      add_type
  );
}

function paymentDetails(xhttp) {
  document.getElementById("ajax").innerHTML = xhttp.responseText;
  document.querySelector(".btn-active").className = "btn";
  document.getElementById("payments").className = "btn btn-active";
}
//Displays current account details and sets button to be visually selected
function v_accountDetails(xhttp) {
  document.getElementById("ajax").innerHTML = xhttp.responseText;
  document.querySelector(".btn-active").className = "btn";
  document.getElementById("vdetails").className = "btn btn-active";
}
//Displays current address details and sets button to be visually selected
function v_addressDetails(xhttp) {
  document.getElementById("ajax").innerHTML = xhttp.responseText;
  document.querySelector(".btn-active").className = "btn";
  document.getElementById("vaddresses").className = "btn btn-active";
}
//Displays current payment details and sets button to be visually selected
function v_paymentDetails(xhttp) {
  document.getElementById("ajax").innerHTML = xhttp.responseText;
  document.querySelector(".btn-active").className = "btn";
  document.getElementById("vpayments").className = "btn btn-active";
}
