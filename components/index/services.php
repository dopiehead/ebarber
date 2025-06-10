
    <div class="main-container">
        <div class="services-section">
            <div data-aos="fade-up" class="section-header">
                <div class="small-title">OUR TREATMENT</div>
                <div class="large-title">SERVICES</div>
            </div>
            
            <div data-aos="fade-up" class="services-grid">
                <div class="service-box">
                    <svg class="scissors-icon" viewBox="0 0 24 24">
                        <path d="M6,16.5L3,19.5L6,22.5L9,19.5L6,16.5M6,13.5L9,10.5L6,7.5L3,10.5L6,13.5M12,13L9,16L12,19L15,16L12,13M15,19L18,22L21,19L18,16L15,19M21,3L12,12L15,15L21,9V3M14,3H9V8L12,5L14,7V3Z"/>
                    </svg>
                    <div class="service-name">HAIRCUT & BEARD TRIM</div>
                </div>
                <div data-aos="fade-up" class="service-box">
                    <svg class="trimmer-icon" viewBox="0 0 24 24">
                        <path d="M20,6C20,3.79 18.21,2 16,2C13.79,2 12,3.79 12,6H8V18H12C12,20.21 13.79,22 16,22C18.21,22 20,20.21 20,18H22V12H20V6M16,4C17.1,4 18,4.9 18,6H14C14,4.9 14.9,4 16,4M16,20C14.9,20 14,19.1 14,18H18C18,19.1 17.1,20 16,20Z"/>
                    </svg>
                    <div class="service-name">SHAVES & HAIRCUT</div>
                </div>
                <div data-aos="fade-up" class="service-box">
                    <svg class="facial-icon" viewBox="0 0 24 24">
                        <path d="M12,2C9.5,2 7.45,3.82 7.06,6.19C6.73,8.24 7.5,10.46 9.08,11.85C7.77,13.07 7,14.85 7,16.81C7,20.24 9.5,23.01 12,23.01C14.5,23.01 17,20.24 17,16.81C17,14.85 16.23,13.07 14.92,11.85C16.5,10.46 17.27,8.24 16.94,6.19C16.55,3.82 14.5,2 12,2Z"/>
                    </svg>
                    <div class="service-name">FACIAL & MORE</div>
                </div>
                <div data-aos="fade-up" class="service-box">
                    <svg class="mustache-icon" viewBox="0 0 24 24">
                        <path d="M21,12C18,12 15,11.3 12,10C9,11.3 6,12 3,12C2.7,16.6 6,20 9.5,20C12,20 14.5,19 16,17C17.5,19 20,20 22.5,20C26,20 29.3,16.6 29,12C26,12 24,12.3 21,12Z"/>
                    </svg>
                    <div class="service-name">THE SHAVE</div>
                </div>
            </div>
            
            <div data-aos="fade-up" class="tagline-section">
                <div class="tagline">styling your hair brings pride</div>
                <button class="style-button">STYLE</button>
            </div>
            
            <button id='products.php' class="text-decoration-none text-warning explore-button">EXPLORE NOW</button>
        </div>
        
        <script>
             $(document).on("click",".explore-button",function(){
                 const barbers = $(this).attr("id");
                 if(barbers.length > 0){
                     window.location.href = barbers;
                 }
             });
            
        </script>
             
  <div class="stats-section">
    <div class="stat-item">
      <svg class="stat-icon" viewBox="0 0 24 24">
        <path fill="#d4af37" d="M7,2H17A2,2 0 0,1 19,4V20A2,2 0 0,1 17,22H7A2,2 0 0,1 5,20V4A2,2 0 0,1 7,2M7,4V8H17V4H7M7,10V12H9V10H7M11,10V12H13V10H11M15,10V12H17V10H15M7,14V16H9V14H7M11,14V16H13V14H11M15,14V16H17V14H15M7,18V20H9V18H7M11,18V20H13V18H11M15,18V20H17V18H15Z"/>
      </svg>
      <div class="stat-number" data-count="2500">0</div>
      <div class="stat-label">CLIENTS</div>
    </div>

    <div class="stat-item">
      <svg class="stat-icon" viewBox="0 0 24 24">
        <path fill="#d4af37" d="M6,16.5L3,19.5L6,22.5L9,19.5L6,16.5M6,13.5L9,10.5L6,7.5L3,10.5L6,13.5M12,13L9,16L12,19L15,16L12,13M15,19L18,22L21,19L18,16L15,19M21,3L12,12L15,15L21,9V3M14,3H9V8L12,5L14,7V3Z"/>
      </svg>
      <div class="stat-number" data-count="4500">0</div>
      <div class="stat-label">HAIRCUTS</div>
    </div>

    <div class="stat-item">
      <svg class="stat-icon" viewBox="0 0 24 24">
        <path fill="#d4af37" d="M20,6C20,3.79 18.21,2 16,2C13.79,2 12,3.79 12,6H8V18H12C12,20.21 13.79,22 16,22C18.21,22 20,20.21 20,18H22V12H20V6M16,4C17.1,4 18,4.9 18,6H14C14,4.9 14.9,4 16,4M16,20C14.9,20 14,19.1 14,18H18C18,19.1 17.1,20 16,20Z"/>
      </svg>
      <div class="stat-number" data-count="25">0</div>
      <div class="stat-label">OPEN SHOPS</div>
    </div>
  </div>
    </div>
    <script>
    $(document).ready(function () {
      $('.stat-number').each(function () {
        var $this = $(this),
            countTo = $this.attr('data-count');

        $({ countNum: 0 }).animate({
          countNum: countTo
        }, {
          duration: 2000,
          easing: 'swing',
          step: function () {
            $this.text(Math.floor(this.countNum));
          },
          complete: function () {
            $this.text(this.countNum);
          }
        });
      });
    });
  </script>