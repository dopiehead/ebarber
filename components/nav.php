
<header class="header w-100">
        <div class="nav-container d-flex justify-content-between align-items-center w-100">
            <div class="ms-0 ms-md-2">
                <a href="index.php" class="text-decoration-none text-white">LOGO</a>
            </div>  
          
           <div class="menu-icon d-md-none" id="menuToggle">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <nav class="nav-links" id="mobileNav">
                <a href="index.php" >Home</a>
                <a href="services.php">Services</a>
                <a href="about.php">About Us</a>
                <a href="products.php">e-barbers</a>
                <a href="blog.php">Blog</a>
                <a href="contact.php">Contact Us</a>
            </nav>

            <a href="products.php" class="book-btn">BOOK APPOINTMENT</a>

        </div>
    </header>

    <script>
    const menuToggle = document.getElementById('menuToggle');
    const mobileNav = document.getElementById('mobileNav');

    menuToggle.addEventListener('click', () => {
        mobileNav.classList.toggle('active');
    });
    </script>