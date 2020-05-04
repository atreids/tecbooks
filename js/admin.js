//
//
//
//For admin.php page
//
//
//
function toggle_existing_books() {
  document.getElementById("existing_books").classList.toggle("d-none");
  document.getElementById("book_edited_alert").className =
    "alert alert-success w-50 margin-top d-none";
  document.getElementById("new_book_form").className = "margin-top d-none";
  document.getElementById("book_inserted_alert").className =
    "alert alert-success w-50 margin-top d-none";
}

function toggle_new_admin_form() {
  document.getElementById("new_admin_form").classList.toggle("d-none");
  document.getElementById("existing_admins").className =
    "container-fluid margin-top d-none";
}

function toggle_new_book_form() {
  //Toggles display of new book form, called when button "New Book" is pressed
  document.getElementById("new_book_form").classList.toggle("d-none");
  document.getElementById("book_inserted_alert").className =
    "alert alert-success w-50 margin-top d-none";
  document.getElementById("existing_books").className =
    "table margin-top d-none";
  document.getElementById("book_edited_alert").className =
    "alert alert-success w-50 margin-top d-none";
}

function new_book() {
  //Called when new book form is submitted, gathers values
  //and submits to a php page insert_book.php AJAX style :)
  var title = document.getElementById("title").value;
  var author = document.getElementById("author").value;
  var cover = document.getElementById("cover").value;
  var isbn = document.getElementById("isbn").value;
  var quantity = document.getElementById("quantity").value;
  var price = document.getElementById("price").value;
  var tags = document.getElementById("tags").value;
  var desc = document.getElementById("desc").value;
  var xhttp;
  if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
  } else {
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("new_book_form").className = "margin-top d-none";
      document.getElementById("book_inserted_alert").className =
        "alert alert-success w-50 margin-top";
    }
  };
  xhttp.open("POST", "./php/insert_book.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(
    "title=" +
      title +
      "&author=" +
      author +
      "&cover=" +
      cover +
      "&isbn=" +
      isbn +
      "&quantity=" +
      quantity +
      "&price=" +
      price +
      "&tags=" +
      tags +
      "&desc=" +
      desc
  );
}

function display_book(stock_id) {
  //called when a book is selected from <select></select>
  var xhttp;
  if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
  } else {
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("table_body").innerHTML = this.responseText;
      document.getElementById("existing_book_table").className =
        "table margin-top";
    }
  };
  xhttp.open("POST", "./php/display_book.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("stock_id=" + stock_id);
}

function display_admin(customer_id) {
  //called when an admin is selected from <select></select>
  var xhttp2;
  if (window.XMLHttpRequest) {
    xhttp2 = new XMLHttpRequest();
  } else {
    xhttp2 = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhttp2.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("admin_table_body").innerHTML = this.responseText;
      document.getElementById("existing_admins").className =
        "container-fluid margin-top";
    }
  };
  xhttp2.open("POST", "./php/display_amin.php", true);
  xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp2.send("customer_id=" + customer_id);
}

function display_customer(customer_id) {
  //called when an admin is selected from <select></select>
  var xhttp2;
  if (window.XMLHttpRequest) {
    xhttp2 = new XMLHttpRequest();
  } else {
    xhttp2 = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhttp2.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("customers_orders").innerHTML = this.responseText;
      document.getElementById("customers_orders").className =
        "container-fluid margin-top";
    }
  };
  xhttp2.open("POST", "./php/display_customer.php", true);
  xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp2.send("customer_id=" + customer_id);
}

function change_order_status(order_id, status) {
  //called when an admin is selected from <select></select>
  var xhttp2;
  if (window.XMLHttpRequest) {
    xhttp2 = new XMLHttpRequest();
  } else {
    xhttp2 = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhttp2.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("changed_status_alert").className =
        "alert alert-success w-50 margin-top";
    }
  };
  xhttp2.open("POST", "./php/change_order_status.php", true);
  xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp2.send("order_id=" + order_id + "&status=" + status);
}

function delete_book(stock_id) {
  //called from display_book.php
  var xhttp;
  if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
  } else {
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("book_edited_alert").className =
        "alert alert-success w-50 margin-top";
      document.getElementById(
        "book_edited_alert"
      ).innerHTML = this.responseText;
      document.getElementById("existing_book_table").className =
        "table margin-top d-none";
    }
  };
  xhttp.open("POST", "./php/delete_book.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("stock_id=" + stock_id);
}

function delete_admin(customer_id) {
  //called from display_book.php
  var xhttp;
  if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
  } else {
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("admin_edited_alert").className =
        "alert alert-success w-50 margin-top";
      document.getElementById(
        "admin_edited_alert"
      ).innerHTML = this.responseText;
      document.getElementById("existing_admins").className =
        "container-fluid margin-top d-none";
    }
  };
  xhttp.open("POST", "./php/delete_admin.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("customer_id=" + customer_id);
}

function show_desc() {
  //called from display_book.php
  document.getElementById("desc_row").classList.toggle("d-none");
}

function edit_book_show() {
  //called from display_book.php
  document.getElementById("desc_row").className = "d-none";
  document.getElementById("edit_row1").classList.toggle("d-none");
  document.getElementById("edit_row2").classList.toggle("d-none");
}

function edit_book_submit(stock_id) {
  //called from display_book.php
  var new_title = document.getElementById("edited_title_" + stock_id).value;
  var new_author = document.getElementById("edited_author_" + stock_id).value;
  var new_price = document.getElementById("edited_price_" + stock_id).value;
  var new_quantity = document.getElementById("edited_quantity_" + stock_id)
    .value;
  var new_desc = document.getElementById("edited_desc_" + stock_id).value;
  var new_cover = document.getElementById("edited_cover_" + stock_id).value;
  var xhttp;
  if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
  } else {
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("existing_book_table").className =
        "table table-striped margin-top d-none";
      document.getElementById("book_edited_alert").className =
        "alert alert-success w-50 margin-top";
    }
  };
  xhttp.open("POST", "./php/edit_book.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(
    "new_title=" +
      new_title +
      "&new_author=" +
      new_author +
      "&new_price=" +
      new_price +
      "&new_quantity=" +
      new_quantity +
      "&new_desc=" +
      new_desc +
      "&new_cover=" +
      new_cover +
      "&stock_id=" +
      stock_id
  );
}
