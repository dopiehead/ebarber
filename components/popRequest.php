    <link rel="stylesheet" href="assets/css/popRequest.css">
    <form id="form-request">
    <div class="form-container">
        <a style="position:absolute;right:0;top:0; padding:5px;cursor:pointer;" class="btn-request fs-1">&times;</a>
        <!-- Profile Section -->
        <div class="profile-section">
            <div class="profile-avatar">
                <img src="<?= htmlspecialchars($user_image ?? "")  ?>" alt="Johnson James">
            </div>
            <div class="profile-info">
                <h3><?= htmlspecialchars($user_name ?? "")  ?></h3>
            </div>
        </div>
        
        <!-- Personal Phone Section -->
        <div class="form-field w-100">
            <label class="form-label">Personal Phone no</label>
            <?php if(!empty($_SESSION['user_phone'])): ?>
            <input type="tel" class="form-input" value="<?= htmlspecialchars($_SESSION['user_phone']) ?>" readonly >
            <?php else: ?>
            <input type="tel" class="form-input" value="<?= htmlspecialchars($_SESSION['user_phone'] ?? "") ?>">
            <?php endif ?>
        </div>

        <!-- Number of People Section -->
        <div class="form-field w-100">
            <label class="form-label">How many people are barbing</label>
            <select name="number_of_people_barbing" class="form-select">
                <option value="1">1</option>
                <option value="2">2</option>
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
                <option value="young">Young</option>
            </select>
        </div>

        <!-- Service Options Section -->
        <div class="service-options">
            <div class="option-group">
                <div class="option-item">
                    <input type="radio" id="afro" name="barber_style[]" class="option-radio" checked>
                    <label for="afro" class="option-label">Afro</label>
                </div>
                <div class="option-item">
                    <input type="radio" id="galax" name="barber_style[]" class="option-radio">
                    <label for="galax" class="option-label">Galax</label>
                </div>
                <div class="option-item">
                    <input type="radio" id="sideshave" name="barber_style[]" class="option-radio">
                    <label for="sideshave" class="option-label">Sideshave</label>
                </div>
            </div>
            <div class="option-group">
                <div class="option-item">
                    <input type="radio" id="trim" name="barber_style[]" class="option-radio" checked>
                    <label for="trim" class="option-label">Trim</label>
                </div>
                <div class="option-item">
                    <input type="radio" id="shave" name="barber_style[]" class="option-radio">
                    <label for="shave" class="option-label">Shave</label>
                </div>
                <div class="option-item">
                    <input type="radio" id="skin" name="barber_style[]" class="option-radio">
                    <label for="skin" class="option-label">Skin</label>
                </div>
                <div class="option-item">
                    <input type="radio" id="skin" name="others" class="option-radio other-option">
                    <label for="skin" class="option-label">Others</label>
                </div>
            </div>

        <div class=" other-container d-none">
             <input type="text" name="barber_style[]" class="w-100 mb-1 px-2 border-1 border-white bg-dark py-1 text-white" placeholder="Other styles">
             
        </div>

        </div>


        <!-- Service Type Buttons Section -->
        <div class="service-type-section">
            <div class="service-buttons">
                 <?php if($user_preference=='home_service'): ?>
                    <button name="user_preference[]" id="home_service" class="service-btn active">Home service</button>
                 <?php elseif($user_preference=='shop') : ?>
                    <button name="user_preference[]" id="shop_owner" class="service-btn active">Shop service</button>
                 <?php else : ?>
                    <button name="user_preference[]" id="home_service" class="service-btn active">Home service</button>
                    <button name="user_preference[]" id="shop_owner" class="service-btn">Shop service</button>
                <?php endif ?>
            </div>
        </div>

        <!-- Location and Date Section -->
        <div class="location-date-section">
            <div class="form-field">
                <label class="form-label">Location</label>
                <select name="location" class="form-select text-capitalize">
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
            <div class="charge-total"><i class='fa fa-naira-sign'></i><?=htmlspecialchars($user_fee);?></div>
        </div>

        <!-- Additional Fields Section -->
        <div class="additional-fields">

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
            <button class="btn cancel-btn btn-reject">Clear</button>
            <?php if(!isset($_SESSION['user_id'])) : ?>
                <a href='sign-in?details=<?= $_SERVER['REQUEST_URI'] ?>' class="btn btn-accept d-flex align-items-center justify-content-center"><span>Send request</span></a>
            <?php else : ?>
                <button class="btn btn-accept">Send request</button>
             <?php endif ?>
        </div>
    </div>

            </form>

    <script>
    $(document).on("click",".other-option",function(e){
        $(".other-container").toggleClass("d-none");
    });

    $(document).on("click",".service-btn",function(e){
        e.preventDefault();
        $(".service-btn").removeClass("active");
        $(this).addClass("active");

    });
    $(document).on("click",".cancel-btn",function(e){
        e.preventDefault();
        $("#form-request")[0].reset();



    });
</script>

</body>
</html>