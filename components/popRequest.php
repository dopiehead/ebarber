    <link rel="stylesheet" href="assets/css/popRequest.css">
    <div class="form-container">
        <a style="position:absolute;right:0;top:0; padding:5px;cursor:pointer;" class="btn-request fs-1">&times;</a>
        <!-- Profile Section -->
        <div class="profile-section">
            <div class="profile-avatar">
                <img src="<?= htmlspecialchars($user_image)  ?>" alt="Johnson James">
            </div>
            <div class="profile-info">
                <h3><?= htmlspecialchars($user_name)  ?></h3>
            </div>
        </div>

        <!-- Personal Phone Section -->
        <div class="form-field w-100">
            <label class="form-label">Personal Phone no</label>
            <input type="tel" class="form-input" value="<?= htmlspecialchars($_SESSION['user_phone']) ?>" readonly>
        </div>

        <!-- Number of People Section -->
        <div class="form-field w-100">
            <label class="form-label">How many people are barbing</label>
            <select class="form-select">
                <option value="2">2</option>
                <option value="1">1</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5+">5+</option>
            </select>
        </div>

        <!-- Style Selection Section -->
        <div class="form-field w-100">
            <label class="form-label">Choose Gender</label>
            <select class="form-select">
                <option value="">Choose from the dropdown</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>

        <!-- Service Options Section -->
        <div class="service-options">
            <div class="option-group">
                <div class="option-item">
                    <input type="radio" id="afro" name="style1" class="option-radio" checked>
                    <label for="afro" class="option-label">Afro</label>
                </div>
                <div class="option-item">
                    <input type="radio" id="galax" name="style2" class="option-radio">
                    <label for="galax" class="option-label">Galax</label>
                </div>
                <div class="option-item">
                    <input type="radio" id="sideshave" name="style3" class="option-radio">
                    <label for="sideshave" class="option-label">Sideshave</label>
                </div>
            </div>
            <div class="option-group">
                <div class="option-item">
                    <input type="radio" id="trim" name="style4" class="option-radio" checked>
                    <label for="trim" class="option-label">Trim</label>
                </div>
                <div class="option-item">
                    <input type="radio" id="shave" name="style5" class="option-radio">
                    <label for="shave" class="option-label">Shave</label>
                </div>
                <div class="option-item">
                    <input type="radio" id="skin" name="style6" class="option-radio">
                    <label for="skin" class="option-label">Skin</label>
                </div>
                <div class="option-item">
                    <input type="radio" id="skin" name="others" class="option-radio other-option">
                    <label for="skin" class="option-label">Others</label>
                </div>
            </div>

        <div class=" other-container d-none">
             <input type="text" name="other_input" class="w-100 mb-1 px-2 border-1 border-white bg-dark py-1 text-white" placeholder="Other styles">
             
        </div>

        </div>


        <!-- Service Type Buttons Section -->
        <div class="service-type-section">
            <div class="service-buttons">
                <button class="service-btn active">Home service</button>
                <button class="service-btn">Shop service</button>
            </div>
        </div>

        <!-- Location and Date Section -->
        <div class="location-date-section">
            <div class="form-field">
                <label class="form-label">Location</label>
                <select class="form-select text-capitalize">
                <?php
                // ini_set('display_errors', 1);
                // ini_set('display_startup_errors', 1);
                // error_reporting(E_ALL);
                require("engine/connection.php");            
                $stmt = $con->prepare("SELECT DISTINCT state FROM states_in_nigeria ORDER BY state ASC");
                $stmt->execute();
                $result = $stmt->get_result();
                    while ($loc = $result->fetch_assoc()) {    ?>
                            <option value="<?= htmlspecialchars($loc['state']) ?>"><?= htmlspecialchars($loc['state']) ?></option>
                   <?php }    ?>
                </select>
            </div>
            <div class="form-field">
                <label class="form-label">Date</label>
                <input type="date" class="form-select form-control py-2">
                   
            </div>
        </div>

        <!-- Charge Total Section -->
        <div class="charge-section">
            <label class="form-label">Charge Total</label>
            <div class="charge-total">#6272</div>
        </div>

        <!-- Additional Fields Section -->
        <div class="additional-fields">
            <div class="form-field">
                <label class="form-label">Home service</label>
                <input type="text" class="form-input" value="#3234" readonly>
            </div>

            <div class="note-section">
                <label class="form-label">NOTE</label>
                <div class="checkbox-item">
                    <input type="checkbox" id="client-note" class="checkbox" checked>
                    <label for="client-note" class="checkbox-label">CLIENT provide my clipper and accessories</label>
                </div>
            </div>
        </div>

        <!-- Action Buttons Section -->
        <div class="action-buttons">
            <button class="btn btn-reject">Clear</button>
            <button class="btn btn-accept">Send request</button>
        </div>
    </div>

    <script>
    $(document).on("click",".other-option",function(e){
        $(".other-container").toggleClass("d-none");
    });

    $(document).on("click",".service-btn",function(e){
        e.preventDefault();
        $(".service-btn").removeClass("active");
        $(this).addClass("active");

    });
</script>

</body>
</html>