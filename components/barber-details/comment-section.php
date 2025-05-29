

<div class="comments-container mt-5 px-4 mb-5">
        <!-- Comments Header -->
        <div class="comments-header">
            <h2 class="comments-title">Comments</h2>
        </div>

        <!-- Comment Input Section -->
        <?php if(isset($_SESSION['user_id'])): ?>
        <div class="comment-input-section">
         
            <form id="commentForm">             
                <input type="hidden" name="sender_name" value="<?= htmlspecialchars($_SESSION['user_name']) ?>">
                <input type="hidden" name="sender_email" value="<?= htmlspecialchars($_SESSION['user_email']) ?>">
                <input type="hidden" name="barber_id" value="<?= htmlspecialchars($id) ?>">           
               <textarea name="comment" class="comment-input" placeholder="Write something about this Barber"></textarea>
               <button name="submit" class="send-btn">Send</button>
            </form>

        </div>
        <?php endif ?>

        <!-- Comment Thread -->
        <div class="comment-thread">
            <!-- Comment 1 -->

<?php
 $getcomment = $conn->prepare("SELECT * FROM barber_comment WHERE barber_id = ? ");
 $getcomment->bind_param("i",$id);
 if($getcomment->execute()):
    $commentResult = $getcomment->get_result();
    if($commentResult->num_rows > 0):   
      while($rowComment = $commentResult->fetch_assoc()): 
        include ("engine/time_ago.php");          
      ?>
         <div class="comment">               
             <div class="comment-content">
                    <div class="comment-header">
                        <span class="comment-author"><?= htmlspecialchars($rowComment['sender_name']) ?></span>
                        <span class="verified-badge">Commend</span>
                    </div>
                    <div class="comment-text"><?= htmlspecialchars($rowComment['comment']) ?></div>
                    <div class="comment-emojis">😊😊😊❤️💕❤️</div>
                    <div class="comment-timestamp text-white"><?= htmlspecialchars(time_ago($rowComment['date'])) ?><span class="live-indicator"><span class="live-dot"></span></span></div>
                </div>
            </div>
 <?php
      endwhile;
    endif;
endif;

?>     
        </div>
    </div>

    <!-- Include jQuery if not already included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#commentForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: '../engine/barber-comment.php',  // Change to your actual PHP file path
            type: 'POST',
            data: $(this).serialize(),   // Serialize form data for POST
            success: function(response) {
                if (response === "1") {
                    swal({
                        title:"Success!!",
                        icon:"success",
                        text:"Comment added successfully!"
                    });
                    $('#commentForm')[0].reset();  // Clear the form
                } else if (response === "SPAM") {
                    swal({
                        icon:"warning",
                        title:"Notice",
                        text:"Duplicate comment detected, please wait before posting again."
                    });
                } else {
                    swal({
                        icon:"error",
                        title:"Error",
                        text:"Duplicate comment detected, please wait before posting again."
                    });// Show any error messages sent by PHP
                }
            },
            error: function() {
                alert('An error occurred while submitting the comment.');
            }
        });
    });
});

</script>
