<?php
    extract($data);
?>
<div class="container-fluid   bg-grey   login_container">
    <div class="row">
        <div class="col-sm-12    align-justify-as01">
            <h1>Login page</h1>
            Login for CSRF test.
            <form method="POST" action="">
                <p><input class="logininput" type="text" name="username" placeholder="Login"></p>
                <p><input class="logininput" type="password" name="password" placeholder="Password"></p>
                Tip: admin - 123
                <p><input class="logininput" type="hidden" name="csrf" value="<?php echo $csrf_token ?>"></p>
                <p><input id="submitbtn" type="submit" name="submit" value="SUBMIT"></p>
            </form>
            <?php
            if($login_status == "access_granted") {
                ?>  <p class="success_action">Access granted</p>  <?php
            } elseif($login_status == "access_denied1") {
                ?>  <p class="unsuccess_action">Access denied. Name or password Failed!</p> <?php
            } elseif($login_status == "access_denied2") {
                ?>  <p class="unsuccess_action">Access denied. CSRF-Token Failed!</p> <?php
            }
            ?>
        </div>
    </div>
</div>


