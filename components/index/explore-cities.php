
    <!-- Header section with title and search -->
    <div class="header mt-4 px-4" data-aos="fade-up">
        <h1 class='fs-2'>Explore Cities in Nigeria</h1>
        <div class="subtitle">These popular destinations have a lot to offer</div>
        <input type="text" name="search" id="search" class="search-bar" placeholder="search for barber">
        <button style='float:right;margin-top:-52px;position:relative;' name='submit' class='btn btn-primary text-white rounded-pill py-1 me-1' id='submit'>Search</button>
    </div>
    
    <!-- City thumbnails section -->
    <div class="cities-grid"   data-aos="flip-up">
        <div class="city-item">
            <img src="assets/images/background/state.jpg" alt="Abuja" class="city-image">
            <div class="city-name"><a class='text-decoration-none text-white' href='products.php?state=abuja'>Abuja</a></div>
        </div>
        <div class="city-item">
            <img src="assets/images/background/state.jpg" alt="Lagos" class="city-image">
            <div class="city-name"><a class='text-decoration-none text-white' href='products.php?state=lagos'>Lagos</a></div>
        </div>
        <div class="city-item">
            <img src="assets/images/background/state.jpg" alt="Delta" class="city-image">
            <div class="city-name"><a class='text-decoration-none text-white' href='products.php?state=delta'>Delta</a></div>
        </div>
        <div class="city-item">
            <img src="assets/images/background/state.jpg" alt="Rivers" class="city-image">
            <div class="city-name"><a class='text-decoration-none text-white' href='products.php?state=rivers'>Rivers</a></div>
        </div>
        <div class="city-item">
            <img src="assets/images/background/state.jpg" alt="Enugu" class="city-image">
            <div class="city-name"><a class='text-decoration-none text-white' href='products.php?state=enugu'>Enugu</a></div>
           
        </div>
    </div>
    <script>
        $(document).ready(function(){
           $(document).on("click","#submit",function(e){
             e.preventDefault();  
             let search = $("#search").val();
             window.location.href = "products.php?search="+search;
           });
        });
        
        
    </script>