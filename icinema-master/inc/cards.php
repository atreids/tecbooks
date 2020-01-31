<?php
  include("./inc/connection.php");
  $sql = "SELECT * FROM movies";
  $data = mysqli_query($db, $sql);
  

?>


<div class="container">
  <div class="row">

    <?php
    while($array = mysqli_fetch_assoc($data)) { echo
    '<div class="col-sm">
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="'.$array['images'].'" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">
             
              '.$array['title'].'
            
          </h5>
          <p class="card-text"> 
            
              '.$array['briefdesc'].'
            
          </p>
          <a href="booknow.php?title='.$array['title'].'" class="btn btn-primary">BOOK</a>
        </div>
      </div>
    </div>'
    ;} ?>
  </div>
</div>