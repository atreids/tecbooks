function loadDoc(url, cFunction) {
  var xhttp;
  if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
  } else {
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhttp.onreadystatechange = function() {
    document.getElementById("ajax").innerHTML = this.status;
    if (this.readyState == 4 && this.status == 200) {
      cFunction(this);
    }
  };
  xhttp.open("GET", url, true);
  xhttp.send();
}

function accountDetails(xhttp) {
  document.getElementById("ajax").innerHTML = xhttp.responseText;
  if (document.querySelector(".btn-active") !== null) {
    document.querySelector(".btn-active").className = "btn";
    document.getElementById("details").className = "btn btn-active";
  }
}

function addressDetails(xhttp) {
  document.getElementById("ajax").innerHTML = xhttp.responseText;
  document.querySelector(".btn-active").className = "btn";
  document.getElementById("addresses").className = "btn btn-active";
}

function paymentDetails(xhttp) {
  document.getElementById("ajax").innerHTML = xhttp.responseText;
  document.querySelector(".btn-active").className = "btn";
  document.getElementById("payments").className = "btn btn-active";
}

function v_accountDetails(xhttp) {
  document.getElementById("ajax").innerHTML = xhttp.responseText;
  document.querySelector(".btn-active").className = "btn";
  document.getElementById("vdetails").className = "btn btn-active";
}

function v_addressDetails(xhttp) {
  document.getElementById("ajax").innerHTML = xhttp.responseText;
  document.querySelector(".btn-active").className = "btn";
  document.getElementById("vaddresses").className = "btn btn-active";
}

function v_paymentDetails(xhttp) {
  document.getElementById("ajax").innerHTML = xhttp.responseText;
  document.querySelector(".btn-active").className = "btn";
  document.getElementById("vpayments").className = "btn btn-active";
}
