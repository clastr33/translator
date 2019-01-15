<?php
    extract($data);
?>
<div class="container-fluid   bg-grey   login_container">
    <div class="row">
        <div class="col-sm-12    align-justify-as01">
            <h1>Cabinet</h1>
            <?php
            if($login_status == "access_denied1") {
                ?>  <p class="unsuccess_action">Access denied. Name or password Failed!</p> <?php
            } elseif($login_status == "access_denied2") {
                ?>  <p class="unsuccess_action">Access denied. CSRF-Token Failed!</p> <?php
            }
            ?>


            <p>
                You have to login to access Cabinet
            </p>
        </div>
    </div>
</div>
<i id="hid_scrf_token" class="display_none"><?php echo $csrf_token ?></i>