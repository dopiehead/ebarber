<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat|sofia|Trirong|Poppins">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/fontawesome.min.css" integrity="sha384-NvKbDTEnL+A8F/AA5Tc5kmMLSJHUO868P+lDtTpJIeQdGYaUIuLr4lVGOEA1OcMy" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/sweetalert.min.js"></script>
<script src="assets/js/flickity.pkgd.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="assets/css/flickity.min.css">

<!-- <link rel="stylesheet" href="assets/css/ads.css"> -->

<link rel="stylesheet" href="assets/css/contact-us.css">
<link rel="stylesheet" href="assets/css/scrollbar.css">
<link rel="stylesheet" href="assets/css/btn_scroll.css">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

<!-- JavaScript -->

<style>
    
body{

    font-family:poppins !important;

    overflow-x: hidden; 


}

.fw-bold{
    font-weight:bold;

}

.text-sm{
    font-size:14px;
}

.g-3{
    gap:8px;
}

/* Mobile styles */
@media (max-width: 768px) {


    .nav-links {
        position: absolute;
        top: 70px;
        left: 0;
        width: 100%;
        flex-direction: column;
        background-color:rgb(0, 0, 0);
        display: none;
        padding: 30px 0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 999;
        color:black;
    }

    .nav-links.active {
        display: flex;
        text-align:center;
    }


}

.mobile-nav {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.4s ease-out;
    background-color: #f8f8f8; /* Optional styling */
    padding:20px 0;
}

.nav-links a{

    padding:10px 0;
}

/* When active, expand the nav */
.mobile-nav.active {
    max-height: 300px; /* Adjust depending on the content size */
}


</style>

<!------------------------------------------btn-scroll--------------------------------------------------->

<a class="btn-down" onclick="topFunction()">&#8593;</a>

<script src="assets/js/scroll.js" type="text/javascript"></script>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
        duration: 1000
    });
    
  </script>