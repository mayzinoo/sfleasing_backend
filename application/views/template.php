<?php include ('layout/header.php') ?> 
<?php include ('layout/aside.php') ?> 
<main class="mdl-layout__content ">
    <div class="mdl-grid ui-tables">
            <?php $this->load->view($content);?>
    </div>
</main>
<?php include ('layout/footer.php') ?> 