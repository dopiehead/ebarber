<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include("components/links.php") ?>
    <title>Contact Us</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/services/services.css">
    <link rel="stylesheet" href="assets/css/contact/contact.css">
    <link rel="stylesheet" href="assets/css/contact-us.css">
</head>
<body>
    <div>
        <?php include("components/nav.php") ?>
    <div class="contact-container container bg-black mb-4 mt-4 ">
        <div class="contact-formposition-relative overflow-x-hidden ">
            <div class="form-section" data-aos="fade-down-left">
                <div class="form-inputs">
                    <form id="conv">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-3" >
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter a valid email address">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter your Name">
                            </div>
                        </div>
                        <div class="row">
                             <div class="col-12 col-md-6 mb-3">
                                  <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your Name">
                             </div>
                        </div>

                        <div class="mb-3">
                            <textarea class="form-control message-textarea" id="message" placeholder="Enter your message"></textarea>
                        </div>
                        <button type="submit" id="submit2" class="submit-btn"><span class="spinner-border text-dark"></span><span>Submit</span></button>
                        
                        <div class="social-icons">
                            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-behance"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-pinterest"></i></a>
                        </div>
                    </form>
                </div>

                <div class="contact-content" data-aos="fade-down-right">

                    <h1 class="contact-title text-dark" id="co">Contact Us</h1>
                    <div class="contact-text">
                        Right now there is no us, I'm running the show alone. So every feedback you provide, any suggestions you have and any new idea you like to share — please don't hesitate, write to me immediately.
                    </div>
                    <div class="contact-text">
                        I'm a social animal. Animal because I've some degree of randomness in my behaviour. Social because I love to hear and share with people.
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <?php include("components/contact.php") ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
         $(".spinner-border").hide();
         $('#submit2').on('click', function(e){
             e.preventDefault();

             $("#submit2").prop('disabled', true);
             $(".spinner-border").show();

             $.ajax({
                type: "POST",
                url: "engine/contact-process.php",
                data: $("#conv").serialize(),
                cache: false,
                contentType: "application/x-www-form-urlencoded",
                success: function(response) {
                    $("#submit2").prop('disabled', false);
                    $(".spinner-border").hide();
                    
                    if (response == 1) {
                        Swal.fire({
                            title: "Success !!",                        
                            text: "Message sent",
                            icon: "success"
                        });
                        $("#conv").find('input:text, textarea').val('');
                    } else {
                        Swal.fire({
                            title:"Notice",
                            text: response,
                            icon: "warning"
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            });
        });
    </script>
</body>
</html>