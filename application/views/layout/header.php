<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php echo base_url(); ?>">
    <link rel="icon" type="image/png" href="assets/images/favicon1.ico">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sfleasing</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">


    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">


    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,300,100,700,900' rel='stylesheet'
          type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  

    <!-- inject:css -->
    <!-- <link rel="stylesheet" href="assets/css/lib/getmdl-select.min.css"> -->
    <!-- <link rel="stylesheet" href="assets/css/lib/nv.d3.min.css"> -->
    <link rel="stylesheet" href="assets/css/application.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-datepicker3.min.css">
    <!-- endinject -->

    

    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">

    <!-- custom css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <link rel="stylesheet" href="assets/datatables/css/dataTables.bootstrap.min.css"> -->
    
    <script src="assets/ckeditor/ckeditor.js"></script>
    
</head>
<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header is-small-screen">
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <div class="mdl-layout-spacer"></div>            

            <div class="avatar-dropdown" id="icon">
                <span><?php echo $this->session->userdata('name'); ?></span>
                <img src="assets/images/Icon_header.png">
            </div>
            <!-- Account dropdawn-->
            <ul class="mdl-menu mdl-list mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect mdl-shadow--2dp account-dropdown"
                for="icon">
                <li class="mdl-list__item mdl-list__item--two-line">
                    <span class="mdl-list__item-primary-content">
                        <span class="material-icons mdl-list__item-avatar"></span>
                        <span><?php echo $this->session->userdata('name'); ?></span>
                        <span class="mdl-list__item-sub-title"><?php echo $this->session->userdata('email'); ?></span>
                    </span>
                </li>
               
                               
                <li class="list__item--border-top"></li>
                <a href="dashboard/setting">
                    <li class="mdl-menu__item mdl-list__item">
                        <span class="mdl-list__item-primary-content">
                            <i class="material-icons mdl-list__item-icon">settings</i>
                            Settings
                        </span>
                    </li>
                </a>
                <a href="dashboard/logout">
                    <li class="mdl-menu__item mdl-list__item">
                        <span class="mdl-list__item-primary-content">
                            <i class="material-icons mdl-list__item-icon text-color--secondary">exit_to_app</i>
                            Log out
                        </span>
                    </li>
                </a>
            </ul>

            <button id="more"
                    class="mdl-button mdl-js-button mdl-button--icon">
                <i class="material-icons">more_vert</i>
            </button>

            
        </div>
    </header>