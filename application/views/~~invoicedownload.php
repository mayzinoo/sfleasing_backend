<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php echo base_url(); ?>">
	<meta charset="utf-8">
	<title>Print CV</title>
	<!-- <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css"> -->
	<link rel="stylesheet" type="text/css" href="assets/css/vendors/style.css">
	<style type="text/css">
	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }
    @page {
        margin: 70px; /* <any of the usual CSS values for margins> */
    }
	body{
			background-color: #fff;
			margin: 0 auto;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
            line-height: normal;
		}
        p
        {
            line-height: 5px !important;
        }
        .row {
          margin-right: -15px;
          margin-left: -15px;
        }
        .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
          position: relative;
          min-height: 1px;
          padding-right: 15px;
          padding-left: 15px;
        }

        .col-lg-12 {
            width: 100%;
        }

        .text-center {
          text-align: center;
        }

		.padding_md{
			padding-top:50px;
			padding-bottom:50px;
		}
		.padding_sm{
			padding-top:10px;
			padding-bottom:10px;
		}
        .toppadding_lg{
            padding-top: 80px;
        }
        .toppadding_xl{
            padding-top: 120px;
        }
		.toppadding_md{
			padding-top:50px;
		}
		.toppadding_sm{
			padding-top:10px;
		}
		.bottompadding_md{
            padding-bottom:30px !important;
        }
        .right-info{
            float: right;
             text-align: right;
        }
        .left-info{
            float:left;
           
        }
        .main-title{
            text-align: center;
            font-size: 22px;
        }
        .tx-capital{
            text-transform: uppercase;
            font-weight: bold;
        }
        .invoiceform{
            border: 1px solid red;
        }
        .invoiceform table{
            border: 1px solid #ddd;
            width: 100%;
            font-size: 14px !important;
            position: relative;
            border-collapse: collapse;
        }

		.invoiceform table tr{
            line-height:10px;
        }
        .invoiceform table th{
            text-align:center !important;
            position: relative;
            vertical-align: bottom;
            text-overflow: ellipsis;
            font-weight: 700;
            line-height: 25px;
            letter-spacing: 0;
            font-size: 13px;
            color: #000;
            padding-bottom: 8px;
            box-sizing: border-box;
            padding: 0 8px 12px;
            border-right: 1px solid #606060;
        }
	</style>
</head>
<body>

<div id="container">
	<div id="body">
	        <div class="invoiceform">
                    <div class="col-md-12">
                        <div class="row">
                            <p class="main-title"><b>TAX INVOICE</b></p>
                        </div>
                        <!--------------------------------------->                        
                        <div class="row">
                            <div class="col-md-6" style="float:left;">
                                <p><b><span class="tx-capital">Billed To</span></b><br/>
                                           <p><?php echo $invoiceinfo->fname.' '.$invoiceinfo->lname;?></p>
                                           <p><?php echo $invoiceinfo->billaddress;?></p>
                                           <p><?php echo $invoiceinfo->useremail;?></p>
                                           <p><?php echo $invoiceinfo->billphone;?></p>
                                </p>
                            </div>
                            <div class="col-md-6" style="float:right;">
                                <p><b><span class="tx-capital">INFO</span></b><br/>
                                           <p><?php echo $invoiceinfo->useremail;?></p>
                                           <p><?php echo $invoiceinfo->billphone;?></p>
                                </p>
                            </div>
                        </div>
                        
                        <div class="col-md-12 toppadding_xl" width: 100%; border-spacing: 0; margin-top: 10px;">
                                <table style="<?= $fontFamily ?> width: 100%; border-spacing: 0; margin-top: 10px;">
                                    <thead>
                                    <tr>
                                        <th width="40" style="text-align: center; padding: 5px; border-right: 1px solid white; font-size: 10px; border: 1px solid #000000;">No</th>
                                        <th width="40" style="text-align: center; padding: 5px; border-right: 1px solid white; font-size: 10px; border: 1px solid #000000;">Model Name</th>
                                        <th width="40" style="text-align: center; padding: 5px; border-right: 1px solid white; font-size: 10px; border: 1px solid #000000;">Duration</th>                                            
                                        <th width="40" style="text-align: center; padding: 5px; border-right: 1px solid white; font-size: 10px; border: 1px solid #000000;">Price</th>
                                        <th width="40" style="text-align: center; padding: 5px; border-right: 1px solid white; font-size: 10px; border: 1px solid #000000;">Total Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="40" style="text-align: center; padding: 5px; border-right: 1px solid white; font-size: 10px; border: 1px solid #000000; border-top: 0; border-bottom-width: 0;">
                                                    dsfa
                                                </td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                        
                  </div><!--end invoice-->
                </div>
                    
                   
        	</div>
	</div>

	
</div>

</body>
</html>