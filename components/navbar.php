<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Barbershop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .mobile-nav {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease-out;
            background-color: #f8f8f8; /* Optional styling */
        }

        .nav-list.active {
            max-height: 300px; /* Adjust depending on the content size */
            display:block;
            opacity: 1;
        }
    </style>
</head>
<body>
    <div class="container nav-container">
        <header >

             <div class="logo">
                  <span>LOGO</span>
            </div>

            <div id="menuToggle">

                 <span class="d-md-none menu-icon"><i class="bi bi-list"></i></span>
                
            </div>

            <!-- ✅ Fixed ID here -->
            <nav id="mobileNav" class="nav-list">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="products.php">e-barbers</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                </ul> 
            </nav>

            <a href="products.php" class="book-btn">BOOK APPOINTMENT</a>
        </header>
        
        <div class="main-content">
            <div class="logo-container" >
                <div class="scissors-container" data-aos="fade-up">
                    <div class="line line-left"></div>
                    <svg class="scissors" viewBox="0 0 24 24">
                        <path d="M8,3C6.7,3 5.6,3.8 5.2,5L3,9L6,12L9,9L13,5C13,3.9 12.1,3 11,3H8M16,3C15.8,3 15.5,3 15.3,3.1L12,6.4L15,9.4L18,6.4L17.7,5.7C17.3,4.2 16.2,3 15,3H16M6,14L3,17L5.2,21C5.6,22.2 6.7,23 8,23H11C12.1,23 13,22.1 13,21V21L9,17L6,14M18,14L15,17L12,20V21C12,22.1 12.9,23 14,23C16.2,23 18,21.2 18,19C18,17.5 18,16.5 18,14Z"/>
                    </svg>
                    <div class="line line-right"></div>
                </div>
                
                <h1 class="site-title">BARBERSHOP</h1>
                <p class="tagline text-secondary"data-aos="fade-down">Get your hair cut like the big boiz</p>
                
                <div class="mustache-container">
                    <svg class="mustache" viewBox="0 0 24 24">
                        <path d="M12,15C10.12,15 8.47,13.87 8.06,12C7.97,11.61 7.53,11.35 7.14,11.45C6.75,11.54 6.5,11.97 6.6,12.36C7.17,14.94 9.39,16.69 12,16.69C14.61,16.69 16.83,14.94 17.4,12.36C17.5,11.97 17.25,11.54 16.86,11.45C16.47,11.35 16.03,11.61 15.94,12C15.53,13.87 13.88,15 12,15Z"/>
                    </svg>
                </div>
                
                <div class="services-badge" data-aos="fade-up">
                    <div class="services-text">shaves & trims</div>
                </div>
                
                <div class="established" data-aos="fade-down">
                    <div class="est-text">EST.</div>
                    <div class="year">2024</div>
                </div>
            </div>
        </div>
        
        <div class="bottom-content" data-aos="fade-in">
            <div class="styling-text">styling your hair brings pride</div>
            <div class="stylist-badge">STYLIST</div>
        </div>
    </div>

    <!-- ✅ JavaScript works with corrected ID -->
    <script>
        const menuToggle = document.getElementById('menuToggle');
        const mobileNav = document.getElementById('mobileNav');

        menuToggle.addEventListener('click', () => {
            mobileNav.classList.toggle('active');
           
        });
    </script>
</body>
</html>
