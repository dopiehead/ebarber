<div class="sidebar">
    <div class="sidebar-logo">eB</div>
    
    <div class="sidebar-nav">
        <div class="sidebar-item">
            <a class="text-decoration-none" href="../index.php" title="Home">
                <i class="fas fa-home"></i>
            </a>
        </div>
        <div class="sidebar-item active">
            <a class="text-decoration-none" href="dashboard.php" title="Dashboard">
                <i class="fas fa-tachometer-alt"></i>
            </a>
        </div>
        <div class="sidebar-item">
            <a class="text-decoration-none" href="profile.php" title="Profile">
                <i class="fas fa-user-alt"></i>
            </a>
        </div>
        <div class="sidebar-item">
            <a class="text-decoration-none" href="inbox.php" title="Inbox">
                <i class="fas fa-envelope"></i>
            </a>
        </div>

        <div class="sidebar-item">
            <a class="text-decoration-none" id="settings" title="Settings">
                <i class="fas fa-cog"></i>
            </a>
        </div>

        <!-- Grouped Settings Section -->
        <div class="sidebar-settings d-none border-top border-white">
            <!-- <div class="sidebar-item">
                <a class="text-decoration-none" id="btnOpenmodal" title="Change Password">
                    <i class="fas fa-key"></i>
                </a>
            </div> -->
            <div class="sidebar-item">
                <a class="text-decoration-none" href="delete-account.php" title="Delete Account">
                    <i class="fas fa-trash"></i>
                </a>
            </div>

            <div class="sidebar-item">
                <a class="text-decoration-none" href="logout.php" title="log out">
                    <i class="fas fa-sign-out"></i>
                </a>
            </div>
        </div>


    </div>
</div>


<!-- modal for change password -->
 <div class="popup d-none">
  <a style="position:absolute;right:0;cursor:pointer;" class="text-secondary p-1" id="btnOpenmodal"><i class="fas fa-close fa-1x"></i></a>  
<div class="password-reset-card flex-row flex-column">
        <h1 class="form-title">Reset your password</h1>
        
        <form>
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <div class="password-input-container">
                    <input type="password" id="password" class="form-control password-dots" value="••••••••••" readonly>
                    <button type="button" class="password-toggle">
                        <i class="far fa-eye"></i>
                    </button>
                </div>
                <div class="validation-message">
                    <div class="validation-icon">
                        <i class="fas fa-info"></i>
                    </div>
                    <span>Must be at least 8 characters</span>
                </div>
            </div>
            
            <div class="form-group confirm-password">
                <label class="form-label" for="confirm-password">Confirm password</label>
                <div class="password-input-container">
                    <input type="password" id="confirm-password" class="form-control password-dots" value="••••••••">
                    <button type="button" class="password-toggle">
                        <i class="far fa-eye"></i>
                    </button>
                </div>
                <div class="validation-message">
                    <div class="validation-icon">
                        <i class="fas fa-info"></i>
                    </div>
                    <span>Both passwords must match</span>
                </div>
            </div>
            
            <div class="button-group">
                <button type="button" class="btn-cancel">Cancel</button>
                <button type="submit" class="btn-reset">Reset</button>
            </div>
        </form>
    </div>
</div>






<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).on("click","#settings",function(e){
        e.preventDefault();
      $(".sidebar-settings").toggleClass("d-none");
    });
    $(document).on("click","#btnOpenmodal",function(e){
        $(".popup").toggleClass("d-none");
    })
</script>
