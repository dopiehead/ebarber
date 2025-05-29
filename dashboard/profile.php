<?php include("checkSession.php")  ?>
<html lang="en">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/dashboard/sidebar.css">
    <link rel="stylesheet" href="../assets/css/dashboard/overview.css">
    <link rel="stylesheet" href="../assets/css/dashboard/settings.css">
    <title>Profile</title>
</head>
<body>
<?php include("components/sidebar.php"); ?>
<div class="main-content">
    <?php include("components/overview.php"); ?>
    
    <div class="container-fluid py-4">
        <div class="text-center mb-4">
            <div class="btn-group" role="group">
                <button class="btn btn-primary tablinks" id="defaultOpen" onclick="openCity(event,'London')">My Profile</button>
                <button class="btn btn-secondary tablinks" onclick="openCity(event,'Paris')">Edit Profile</button>
            </div>
        </div>

        <div id="London" class="tabcontent">
            <div class="card p-4 mb-4">
                <h5 class="card-title border-bottom pb-2">Personal Details</h5>
                <div class="card-body">
                    <p><small>Phone: 2347034497654</small></p>
                    <p><small>Dial code: +234</small></p>
                    <p><i class="fas fa-user-alt"></i></p>

                    <form id="editpage-form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="">
                        <div class="mb-3">
                            <label for="fileupload" class="form-label">Change Photo</label>
                            <input type="file" class="form-control" name="fileupload" id="fileupload">
                        </div>
                        <button type="submit" class="btn btn-success">Change photo (Max 4MB)</button>
                    </form>
                </div>
            </div>
        </div>

        <div id="Paris" class="tabcontent">
            <form id="editpage-details" class="card p-4">
                <h5 class="card-title mb-3">Edit Profile</h5>
                
                <input type="hidden" name="sid" value="">
                <input type="hidden" name="user_type" value="">

                <div class="mb-3">
                    <label for="business_name" class="form-label">Business Name</label>
                    <input type="text" class="form-control" id="business_name" name="business_name" placeholder="Business Name">
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="col-md">
                        <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password">
                    </div>
                </div>

                <div class="mb-3">
                    <input type="text" name="bank_name" class="form-control" placeholder="Bank Name">
                </div>

                <div class="mb-3">
                    <input type="number" name="account_number" class="form-control" placeholder="Account Number">
                </div>

                <h6>Contact Information</h6>
                <div class="row g-3 mb-3">
                    <div class="col-md">
                        <input type="text" name="country" class="form-control" placeholder="Country">
                    </div>
                    <div class="col-md">
                        <input type="text" name="contact" class="form-control" placeholder="Phone number">
                    </div>
                    <div class="col-md">
                        <input type="text" name="whatsapp" class="form-control" placeholder="WhatsApp">
                    </div>
                </div>

                <div class="mb-3">
                    <input type="email" name="business_email" class="form-control" placeholder="Email Address">
                </div>

                <h6>Address Details</h6>
                <?php
                    require '../engine/connection.php';
                    $getStates = mysqli_query($con, "SELECT * FROM states_in_nigeria GROUP BY state");
                ?>
                <div class="mb-3">
                    <select name="location" class="form-select">
                        <option value="">Entire Nigeria</option>
                        <?php while ($states = mysqli_fetch_array($getStates)) { ?>
                            <option value="<?= $states['state'] ?>"><?= $states['state'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <span id="lg" class="d-block mb-3"></span>

                <h6>About Your Organisation</h6>
                <div class="mb-3">
                    <textarea class="form-control" name="about" rows="3" placeholder="About Your Organization"></textarea>
                </div>

                <div class="mb-3">
                    <textarea class="form-control" name="services" rows="3" placeholder="Services Your Organization Provides"></textarea>
                </div>

                <h6>Availability</h6>
                <div class="row g-3 mb-3">
                    <div class="col-md">
                        <select name="days" class="form-select">
                            <option value="days">Days</option>
                            <option value="monday">Monday</option>
                            <option value="tuesday">Tuesday</option>
                            <option value="wednesday">Wednesday</option>
                            <option value="thursday">Thursday</option>
                            <option value="friday">Friday</option>
                            <option value="saturday">Saturday</option>
                            <option value="sunday">Sunday</option>
                        </select>
                    </div>
                    <div class="col-md">
                        <input type="text" name="opening_time" class="form-control" placeholder="Opening Time (am/pm)">
                    </div>
                    <div class="col-md">
                        <input type="text" name="closing_time" class="form-control" placeholder="Closing Time (am/pm)">
                    </div>
                </div>

                <h6>Social Media</h6>
                <div class="row g-3 mb-3">
                    <div class="col-md"><input type="text" name="facebook" class="form-control" placeholder="Facebook"></div>
                    <div class="col-md"><input type="text" name="twitter" class="form-control" placeholder="Twitter"></div>
                    <div class="col-md"><input type="text" name="linkedin" class="form-control" placeholder="LinkedIn"></div>
                    <div class="col-md"><input type="text" name="instagram" class="form-control" placeholder="Instagram"></div>
                </div>

                <div class="text-center mb-3" id="loading-image" style="display: none;">
                    <img src="loading-image.GIF" alt="Loading..." height="50" width="50">
                </div>

                <div class="d-flex gap-3">
                    <button type="button" class="btn btn-danger" onclick="cancel()">Cancel</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>

<script>
function openCity(evt, cityName) {
var i, tabcontent, tablinks;
tabcontent = document.getElementsByClassName("tabcontent");
for (i = 0; i < tabcontent.length; i++) {
tabcontent[i].style.display = "none";
 }
tablinks = document.getElementsByClassName("tablinks");
for (i = 0; i < tablinks.length; i++) {
 tablinks[i].className = tablinks[i].className.replace(" active", "");
 }
document.getElementById(cityName).style.display = "block";
evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();
</script>


<script type="text/javascript">

$('#editpage-form').on('submit',function(e){

if (confirm("Are you sure to change this?")) {

 e.preventDefault();

$(".loading-image").show();


var formdata = new FormData();
   $.ajax({
           type: "POST",

           url: "../engine/changeprofilepic.php",
           data:new FormData(this),
           cache:false,
           processData:false,
           contentType:false,
           success: function(response) {
           $(".loading-image").hide();
          if(response==1){

            swal({

          text:"Image has been changed",
          icon:"success",
        });
       $('#bom').load(location.href + " #my");
}

else
 { 
  swal({
            icon:"error",
            text:response

           });
            $("#editpage-form")[0].reset();      

            }
 }
        });
 }
    });

</script>

<script type="text/javascript">

$('#lg').html("<select  id='lga' class='lga address_details form-control'><option>Business Axis</option></select>");  
$('.location').on('change',function() { 
var location = $(this).val();
      $.ajax({
          type:"POST",
            url:"../engine/get-lga.php",
            data:{'location':location},
            success:function(data) {
              $('#lg').html(data);              
            }
     });
});

</script>


<script type="text/javascript">

  $('#btn-submit').on('click',function(){
      
       $(".loading-image").show();

      $.ajax({

            type: "POST",

            url: "edit-page.php",

            data:  $("#editpage-details").serialize(),

            cache:false,

            contentType: "application/x-www-form-urlencoded",

             success: function(response) {
             
             if (response==1) {

            
            swal({
              
              text:"Details update is saved",

              icon:"success",

            });
           $("#editpage-details")[0].reset();
           
            $(".loading-image").hide();

              $("#myformx").hide();

          }
            
             else{

              swal({

                   text:response,
                   icon:"error",

              });
             }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        })
    });

</script>


<script> 
function cancel() {
     $("#editpage-details")[0].reset();
}
</script>

</body>
</html>