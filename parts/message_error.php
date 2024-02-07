<?php if ( isset( $_SESSION["error"] ) ) : ?>
    <div class="alert alert-danger" role="alert">
    <?php 
        // echo $_SESSION["error"]; 
    ?>
    You have the following errors:
    <ul class="m-0">
    <?php foreach( $_SESSION["error"] as $error ) : ?>
        <li><?= $error; ?></li>
    <?php endforeach; ?>
    </ul>
    <?php 
        // remove error after it's shown
        unset( $_SESSION["error"] ); 
    ?>
    </div>
<?php endif; ?>