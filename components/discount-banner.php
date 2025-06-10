
    <div class="discount-banner">
        <div class="banner-content "  data-aos="fade-up">
            <div class="discount-text">25% Discount</div>
            <div class="discount-description">Get a discount of up to 25% if you pay for products via e-wallet</div>
            <button href='products?filter=discount' class="book-now-btn book-now">Book Now</button>
        </div>
        <div class="banner-image">
            <!-- Background image is set in CSS -->
             <!-- <img src="assets/images/background/barber-illustration.avif" alt=""> -->
        </div>
        <br><br>
    </div>
    <script>
        $(document).on("click",".book-now",function(event){
           event.preventDefault();
           let discountBooking = $(this).attr("href");
           if(discountBooking.length != " "){
            window.location.href = discountBooking;
           }
        });
    </script>