<?php 
     $conn = mysqli_connect("localhost","root","","ebarber");
     if(!$conn){
         die("Connection failed: ". mysqli_connect_error());
     }
  ?>