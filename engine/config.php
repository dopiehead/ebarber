<?php 
     $conn = mysqli_connect("localhost","estore_barberdb","estore_barberdb123","estore_barberdb");
     if(!$conn){
         die("Connection failed: ". mysqli_connect_error());
     }
  ?>