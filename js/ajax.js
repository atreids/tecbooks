function loadDoc(url, cFunction) {
  //generic ajax function
  var xhttp;
  if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
  } else {
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      cFunction(this);
    }
  };
  xhttp.open("GET", url, true);
  xhttp.send();
}

function loadDocCart(stock_id) {
  //generic ajax function adapted for adding items to the cart
  var xhttp;
  if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
  } else {
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("btn_" + stock_id).innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "./php/add_cart.php?stocknumber=" + stock_id, true);
  xhttp.send();
}

function paymentSuccessful() {
  var xhttp;
  if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
  } else {
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("checkout_box").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "./php/payment_success.php", true);
  xhttp.send();
}
