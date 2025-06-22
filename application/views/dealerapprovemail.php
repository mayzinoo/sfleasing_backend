
<html>
<head>
    <meta charset="utf-8" />
    <title>Verify Email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
    .col-md-12 {
    width: 100%;
    }
    .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
        float: left;
    }
    .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
        position: relative;
        min-height: 1px;
        padding-left: 15px;
        padding-right: 15px;
    }
    .btn{
        padding: 5px 10px;
        font-size: 12px;
        line-height: 1.5;
        border-radius: 3px;
        display: inline-block;
        margin-bottom: 0;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        touch-action: manipulation;
        cursor: pointer;
        border: 1px solid transparent;
        user-select: none;
    }
    .btn-primary{
      color: #fff;
      background-color: #912422 !important;
      border-color: #912422;
    }
</style>
<body>
    <div>    
        <p style="font-size:14px;"><b>Hi <?php echo $username; ?>,</b></p>
        <h4><b>Welcome from Sfleasing !</b></h4>
        <p>You can enter sfleasing admin dashboard with the following username and password:</p>
        <p>
            Dealer dashboard link : <?php echo $base_url; ?><br/>
            Username : <?php echo $email; ?> <br/>
            Password : <?php echo $password; ?>
        </p>
       
    <p style="font-weight:bold;margin-top:20px;">Sfleasing Team<br/>
    <span>Thank you</span></p>
    </div>
</body>
</html>