function change_email() {
  var xhttp;
  var new_email = document.getElementById("change_email").value;
  if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
  } else {
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("change_email_form").className =
        "margin-top d-none";
      document.getElementById("email_updated_alert").className =
        "alert alert-success w-25 margin-top";
    }
  };
  xhttp.open("GET", "./php/update_email.php?new_email=" + new_email, true);
  xhttp.send();
}

function display_change_email_form() {
  document.getElementById("email_updated_alert").className =
    "alert alert-success w-25 margin-top d-none";
  document.getElementById("change_email_form").className = "margin-top";
  document.getElementById("delete_account").className = "margin-top d-none";
  document.getElementById("change_password_form").className =
    "margin-top d-none";
}

function change_password_form() {
  document.getElementById("delete_account").className = "margin-top d-none";
  document.getElementById("change_email_form").className = "margin-top d-none";
  document.getElementById("change_password_form").className = "margin-top";
}

function display_delete_account() {
  document.getElementById("change_email_form").className = "margin-top d-none";
  document.getElementById("change_password_form").className =
    "margin-top d-none";
  document.getElementById("delete_account").className = "margin-top";
}

function delete_account() {
  var current_password = document.getElementById("current_password2").value;
  var xhttp;
  if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
  } else {
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("details_alert").innerHTML = this.responseText;
      document.getElementById("details_alert").className =
        "alert alert-warning w-25 margin-top";
      document.getElementById("delete_account").className = "margin-top d-none";
      window.location.replace("./php/logout.php");
    }
  };
  xhttp.open("POST", "./php/delete_customer.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("current_password=" + current_password);
}

function change_password() {
  var currentpassword = document.getElementById("current_password").value;
  var new_password = document.getElementById("new_password").value;
  var repeat_new_password = document.getElementById("repeat_new_password")
    .value;

  var xhttp;
  if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
  } else {
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("details_alert").innerHTML = this.responseText;
      document.getElementById("details_alert").className =
        "alert alert-warning w-25 margin-top";
      document.getElementById("change_password_form").className =
        "margin-top d-none";
    }
  };
  xhttp.open("POST", "./php/change_password.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(
    "currentpassword=" +
      currentpassword +
      "&new_password=" +
      new_password +
      "&repeat_new_password=" +
      repeat_new_password
  );
}

function display_current_addresses() {
  document.getElementById("current_addresses").className =
    "container-fluid margin-top d-flex flex-row flex-wrap";
  document.getElementById("new_address_form").className =
    "container-fluid margin-top d-none";
}

function display_new_address_form() {
  document.getElementById("new_address_form").classList.toggle("d-none");
  document.getElementById("current_addresses").className =
    "container-fluid margin-top d-none flex-row flex-wrap";
}

function display_change_address_form(address_id) {
  document.getElementById("address_id").value = address_id;
  document.getElementById("edit_form").classList.toggle("d-none");
}

function delete_address(customer_id, address_id) {
  var xhttp;
  if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
  } else {
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById(address_id).className =
        "card margin-top ml-1 mr-1 d-none";
    }
  };
  xhttp.open("POST", "./php/delete_address.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("customer_id=" + customer_id + "&address_id=" + address_id);
}
