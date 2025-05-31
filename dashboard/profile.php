<?php include("checkSession.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>

    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/dashboard/sidebar.css">
    <link rel="stylesheet" href="../assets/css/dashboard/overview.css">
    <link rel="stylesheet" href="../assets/css/dashboard/settings.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

<?php include("components/sidebar.php"); ?>

<div class="main-content">
    <?php include("components/overview.php"); ?>

    <div class="container-fluid py-4">
        <!-- Tabs -->
        <div class="text-center mb-4">
            <div class="btn-group">
                <button class="btn btn-primary tablinks" id="defaultOpen" onclick="openTab(event,'London')">My Profile</button>
                <button class="btn btn-secondary tablinks" onclick="openTab(event,'Paris')">Edit Profile</button>
            </div>
        </div>

        <!-- My Profile -->
        <div id="London" class="tabcontent">
            <div class="card p-4 mb-4">
                <h5 class="card-title border-bottom pb-2">Personal Details</h5>
                <div class="card-body">
                    <p><small>Phone: <?= htmlspecialchars($_SESSION['user_phone']) ?></small></p>
                    <p><small>Dial code: +234</small></p>

                    <form id="editpage-form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($_SESSION['user_id']) ?>">
                        <div class="mb-3">
                            <label for="fileupload" class="form-label">Change Photo</label>
                            <input type="file" class="form-control"  accept="image/*" name="fileupload" id="fileupload">
                        </div>
                        <button type="submit" class="btn btn-success">Change photo (Max 4MB)</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Profile -->
        <div id="Paris" class="tabcontent">
        <form id="editpage-details" class="card p-4">
    <h5 class="card-title mb-3">Edit Profile</h5>
    <input type="hidden" name="user_type" value="<?= htmlspecialchars($user['user_type'] ?? $_SESSION['user_type']) ?>">

    <div class="mb-3">
        <input type="text" name="user_name" class="form-control" placeholder="<?php if($_SESSION['user_role']==="barber")echo"Business ";?> Name" value="<?= htmlspecialchars($user['user_name'] ?? '') ?>">
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md"><input type="password" name="user_password" class="form-control" placeholder="Password"></div>
        <div class="col-md"><input type="password" name="cpassword" class="form-control" placeholder="Confirm Password"></div>
    </div>

    <?php if ($_SESSION['user_role'] == 'barber'): ?>
        <div class="mb-3"><input type="text" name="bank_name" class="form-control" placeholder="Bank Name" value="<?= htmlspecialchars($user['bank_name'] ?? '') ?>"></div>
        <div class="mb-3"><input type="number" name="account_number" class="form-control" placeholder="Account Number" value="<?= htmlspecialchars($user['account_number'] ?? '') ?>"></div>
    <?php endif ?>

    <h6>Contact Information</h6>
    <div class="row g-3 mb-3">
        <div class="col-md"><input type="text" name="country" class="form-control" placeholder="Country" value="<?= htmlspecialchars($user['country'] ?? '') ?>"></div>
        <div class="col-md"><input type="text" name="user_phone" class="form-control" placeholder="Phone number" value="<?= htmlspecialchars($user['user_phone'] ?? '') ?>"></div>
        <div class="col-md"><input type="text" name="whatsapp" class="form-control" placeholder="WhatsApp" value="<?= htmlspecialchars($user['whatsapp'] ?? '') ?>"></div>
    </div>

    <h6>Address Details</h6>
    <?php require '../engine/connection.php'; ?>
    <div class="mb-3">
        <select name="user_location" class="form-select location">
            <option value="">Entire Nigeria</option>
            <?php
            $getStates = mysqli_query($con, "SELECT * FROM states_in_nigeria GROUP BY state");
            while ($states = mysqli_fetch_array($getStates)) {
                $selected = ($user['user_location'] ?? '') === $states['state'] ? "selected" : "";
                echo "<option value='" . htmlspecialchars($states['state']) . "' $selected>" . htmlspecialchars($states['state']) . "</option>";
            }
            ?>
        </select>
    </div>

    <span id="lg" class="d-block mb-3"></span>
    <input type="text" name="user_address" class="form-control mb-3" placeholder="Enter full address" value="<?= htmlspecialchars($user['user_address'] ?? '') ?>">

    <?php if ($_SESSION['user_role'] == 'barber'): ?>
        <h6>About Your Organisation</h6>
        <div class="mb-3">
            <textarea class="form-control" name="user_bio" rows="3" placeholder="About Your Organization"><?= htmlspecialchars($user['user_bio'] ?? '') ?></textarea>
        </div>
        <div class="mb-3">
            <textarea class="form-control" name="user_services" rows="3" placeholder="Services Your Organization Provides"><?= htmlspecialchars($user['user_services'] ?? '') ?></textarea>
        </div>

        <h6>Availability</h6>
        <div class="row g-3 mb-3">
            <div class="col-md">
                <select name="days" class="form-select">
                    <option value="">Days</option>
                    <?php
                    $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
                    foreach ($days as $day) {
                        $selected = ($user['days'] ?? '') === $day ? "selected" : "";
                        echo "<option $selected>$day</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md">
                <input type="text" name="opening_time" class="form-control" placeholder="Opening Time (am/pm)" value="<?= htmlspecialchars($user['opening_time'] ?? '') ?>">
            </div>
            <div class="col-md">
                <input type="text" name="closing_time" class="form-control" placeholder="Closing Time (am/pm)" value="<?= htmlspecialchars($user['closing_time'] ?? '') ?>">
            </div>
        </div>
    <?php endif ?>

    <h6>Social Media</h6>
    <div class="row g-3 mb-3">
        <div class="col-md"><input type="text" name="facebook" class="form-control" placeholder="Facebook" value="<?= htmlspecialchars($user['facebook'] ?? '') ?>"></div>
        <div class="col-md"><input type="text" name="twitter" class="form-control" placeholder="Twitter" value="<?= htmlspecialchars($user['twitter'] ?? '') ?>"></div>
        <div class="col-md"><input type="text" name="linkedin" class="form-control" placeholder="LinkedIn" value="<?= htmlspecialchars($user['linkedin'] ?? '') ?>"></div>
        <div class="col-md"><input type="text" name="instagram" class="form-control" placeholder="Instagram" value="<?= htmlspecialchars($user['instagram'] ?? '') ?>"></div>
    </div>

    <div class="text-center mb-3" id="loading-image" style="display: none;">
        <span class="spinner-border text-success fs-2"></span>
    </div>

    <div class="d-flex gap-3">
        <button type="button" class="btn btn-danger" onclick="cancel()">Cancel</button>
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
</form>

        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert/dist/sweetalert.min.js"></script>

<script>
function openTab(evt, tabName) {
    $(".tabcontent").hide();
    $(".tablinks").removeClass("active");
    $("#" + tabName).show();
    evt.currentTarget.classList.add("active");
}
document.getElementById("defaultOpen").click();


$('.location').on('change', function () {
    var location = $(this).val();
    $.post("../engine/get-lga", { location: location }, function (data) {
        $('#lg').html(data);
    });
});

$('#editpage-details').on('submit', function (e) {
    e.preventDefault();
    $("#loading-image").show();

    $.ajax({
        type: "POST",
        url: "../engine/edit-page", // Clean URL, relies on .htaccess rewrite
        data: $(this).serialize(),
        dataType: "json", // Expect JSON response
        success: function (response) {
            $("#loading-image").hide();
            if (response.status === "success") {
                Swal.fire("Success", response.message, "success");
                $("#editpage-details")[0].reset();
            } else {
                Swal.fire("Error", response.message || "Unknown error.", "error");
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $("#loading-image").hide();
            console.log("AJAX Error:", textStatus, errorThrown, jqXHR.responseText);
            Swal.fire("Error", "Request failed: " + textStatus, "error");
        }
    });
});

function cancel() {
    $("#editpage-details")[0].reset();
}
</script>


<script>
$('#editpage-form').on('submit', function (e) {
    e.preventDefault();
    if (!confirm("Are you sure you want to change this?")) return;

    $("#loading-image").show();
    
    $.ajax({
        type: "POST",
        url: "../changeprofilepic",
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (response) {
            $("#loading-image").hide();
            // If PHP returns a success message
            if (response.includes("1")) {
                Swal.fire("Success", "Image has been changed", "success");
                $("#editpage-form")[0].reset();
            } else {
                Swal.fire("Error", response, "error");
            }
        },
        error: function (xhr, status, error) {
            $("#loading-image").hide();
            Swal.fire("Error", "Request failed: " + error, "error");
        }
    });
});
</script>
</body>
</html>
