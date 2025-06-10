
    <div data-aos="fade-up" class="location-section">
        <h2 class="location-title">We have people to help with barbing your hair anywhere you are</h2>
        
        <div class="location-tags">
            <?php
               ini_set('display_errors', 1);
               ini_set('display_startup_errors', 1);
               error_reporting(E_ALL);
               require("engine/connection.php");
               $getstate = $con->prepare("SELECT DISTINCT state FROM states_in_nigeria ORDER BY state ASC");
               if($getstate->execute()):
                   $result = $getstate->get_result();
                  while($row = $result->fetch_assoc()): ?>
                     <a href='products?state=<?= htmlspecialchars($row['state']) ?>' class="location-tag text-capitalize text-decoration-none">
                         
                         <?= htmlspecialchars($row['state'])?>
                         
                     </a>
            <?php  endwhile;
               endif;
            ?>     
        </div>
    </div>