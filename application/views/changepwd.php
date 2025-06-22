<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php echo base_url(); ?>">
    <link rel="icon" type="image/png" href="images/DB_16х16.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Everest Auto Admin Dashboard</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">


    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,300,100,700,900' rel='stylesheet'
          type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/lib/getmdl-select.min.css">
    <link rel="stylesheet" href="assets/css/lib/nv.d3.min.css">
    <link rel="stylesheet" href="assets/css/application.min.css">
    <!-- endinject -->
</head>
<style>
        .cmytitle{
          color: #03a9f4 !important;
          font-size: 21px !important;
        }
</style>
<body>

<div class="mdl-layout mdl-js-layout color--gray is-small-screen login">
    <main class="mdl-layout__content">
        <div class="mdl-card mdl-card__login mdl-shadow--2dp">
        <?=form_open('dashboard/change_password/')?>
        <form action="#">    
                <div class="mdl-card__supporting-text color--dark-gray">
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone">
                            <span class="mdl-card__title-text text-color--smooth-gray cmytitle">EVEREST AUTO</span>
                        </div>
                        <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone">
                            <span class="login-name text-color--white">Change password?</span>
                            <span class="login-secondary-text text-color--smoke">Change your password</span>
                        </div>
                        <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
                                <input class="mdl-textfield__input" type="password" name="password" id="password" required>
                                <label class="mdl-textfield__label" for="password">Password</label>
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
                                <input class="mdl-textfield__input" type="password" name="cfmpassword" id="password" required>
                                <label class="mdl-textfield__label" for="password">Confirm Password</label>
                            </div>
                        </div>
                        <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone submit-cell">
                            <div class="mdl-layout-spacer"></div>                            
                            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised color--light-blue">
                                   UPDATE
                                </button>
                            
                        </div>
                    </div><!--  -->
                </div>
        </form>
        <?=form_close()?>
        </div>
    </main>
</div>


<!-- inject:js -->
<script src="assets/js/d3.min.js"></script>
<script src="assets/js/getmdl-select.min.js"></script>
<script src="assets/js/material.min.js"></script>
<script src="assets/js/nv.d3.min.js"></script>
<script src="assets/js/layout/layout.min.js"></script>
<script src="assets/js/scroll/scroll.min.js"></script>
<!-- endinject -->

<!-- custom js -->
<script src="assets/js/custom.js"></script>

</body>
</html>