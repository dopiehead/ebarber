    
<div class='d-flex justify-content-center flex-md-row flex-column w-100 mt-4 gap-3'>
    
    <div class="service-container">
        <div class="service-info" data-aos="fade-up">
            <div class="service-title">Become a registered Laundry service under e-wash</div>
            <div class="service-desc">Organize your clients with no marketing at all, just register under e-laundry</div>
            <button href="sign-up.php?page=customer" class="register-btn">Register</button>
        </div>
        <div class="service-image">
            <img src="assets/images/background/pic.png" alt="Laundry service illustration">
        </div>
    </div>
    
    <div data-aos="fade-up" class="service-container">
        <div class="service-info">
            <div class="service-title">Become a registered ebarber service</div>
            <div class="service-desc">Organize your clients with no marketing at all, just register under e-barber</div>
            <button href="sign-up.php?page=barber" class="register-btn">Register</button>
        </div>
        <div class="service-image">
            <img src="assets/images/background/pic1.png" alt="Barber illustration">
        </div>
    </div>

</div>
<script>
    $(document).on("click",".register-btn",function(e){
      let page = $(this).attr("href");
      window.location.href = page;
    });
</script>
