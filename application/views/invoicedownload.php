<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?php echo base_url(); ?>">
	<meta charset="utf-8">
	<title>Print Invoice</title>
	<link rel="stylesheet" type="text/css" href="assets/css/gistfile1.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body{
			background-color: #fff;
			margin: 0 auto;
			font: 13px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}
		p{color: #000;line-height: 5px;font-size: 12px !important;}
		.header h3{
			font-size: 20px;
    		text-align: center;
		}
		.header-img{
			width:70px;
			height:auto;
		}
		.container-with-shadow {
		    background-color: #FFF;
		    box-shadow: 0 0 3px 1px rgba(0,0,0,.2);
		    border-top-right-radius: 2px;
		    border-bottom-right-radius: 2px;
		    border-bottom-left-radius: 2px;
		    border-top-left-radius: 2px;
		    padding:40px 50px;
		}
		.padding_md{
			padding-top:50px;
			padding-bottom:50px;
		}
		.padding_sm{
			padding-top:10px;
			padding-bottom:10px;
		}
		.toppadding_md{
			padding-top:50px;
		}
		.toppadding_sm{
			padding-top:10px;
		}
		
		.cvtable .table td,.cvtable .table th{
			padding:0px !important;
			border-top:0px !important;
		}
		#container{
		/*margin: 10px;*/
		/*border: 1px solid #D0D0D0;*/
		-webkit-box-shadow: 0 0 8px #D0D0D0;
		}
		#body{
			color: #000 !important;
		}
		.jmcvadj table{
		    table-layout: fixed;
		}
		.jmcvadj table thead{
		    background-color: blue;
		}
		.default-color{
			color:#00bcd4 !important;
			font-weight:bold;
		}
		.jmcvadj tr td:first-child{
            width:50%;
            overflow: hidden;
            display: inline-block;
            white-space: nowrap;
        }
        
        .textLayer span, .textLayer br{
        	color: #000;
        }
        .right_info{
            float: right;
            text-align: right;
        }
	</style>
</head>
<body>

<div id="container">
	<div id="body">
		<div class="col-sm-12 header">
				<h3 class="default-color toppadding_md">TAX INVOICE</h3>
		</div>
		<div class="col-sm-12">
				<div class="col-sm-6">
					<p><b>Billed To</b><br/>
                       <p><?php echo $invoiceinfo->fname.' '.$invoiceinfo->lname;?></p>
                       <p><?php echo $invoiceinfo->billaddress;?></p>
                       <p><?php echo $invoiceinfo->useremail;?></p>
                       <p><?php echo $invoiceinfo->billphone;?></p>
                    </p>
				</div>
				<div class="col-sm-6 right_info">
					<p><b>INFO</b><br/>
                       <p>Invoice : <?php echo $invoiceinfo->invoice_name;?></p>
                       <p>Invoice Date : <?php echo $invoiceinfo->invoice_date;?></p>
                    </p>
				</div>
		</div>
		<div class="col-sm-12 padding_sm jmcvadj">
			<table width="100%" class="table" cellpadding="" cellspacing="0" style="border-bottom: 1px solid #000;">
				<thead>
                    <tr>
                        <th width="5" style="text-align: center; padding: 15px; border-right: 0px !important; font-size: 10px; border: 1px solid #000000; background:#00bcd4;color:#fff">No</th>

                        <th width="60" style="text-align: center; padding: 5px; border-right: 1px solid #000000; font-size: 10px; border-top: 1px solid #000;border-bottom: 1px solid #000; background:#00bcd4;color:#fff">Model Name</th>

                        <th width="40" style="text-align: center; padding: 5px; font-size: 10px; border-top: 1px solid #000000;border-bottom: 1px solid #000; background:#00bcd4;color:#fff">Duration</th>                                            
                        <th width="40" style="text-align: center; padding: 5px;  font-size: 10px; border: 1px solid #000000; background:#00bcd4;color:#fff">Price (SGD)</th>
                        
                    </tr>
                </thead>
                <tbody>
			            <tr>
			                <td valign="top" width="40" style="height:300px;text-align: center; padding: 5px; font-size: 10px; border: 1px solid #000000; border-top: 0; border-bottom-width: 0;">
			                    1
			                </td>
			                <td valign="top" style="text-align: center; padding: 5px; border-right: 1px solid white; font-size: 10px; border: 1px solid #000000; border-left: 0; border-top: 0; border-bottom-width: 0;">
			                    <?php echo $invoiceinfo->modelname; ?>
			                </td>			                
			                <td valign="top" width="90" style="text-align: center; padding: 5px; border-right: 1px solid white; font-size: 10px; border: 1px solid #000000; border-left: 0; border-top: 0; border-bottom-width: 0;">
			                    <?php echo $invoiceinfo->bookingduration; ?> Months
			                </td>
			                <td valign="top" width="90" style="text-align: center; padding: 5px; border-right: 1px solid white; font-size: 10px; border: 1px solid #000000; border-left: 0; border-top: 0; border-bottom-width: 0;">
			                    $ <?php echo number_format($invoiceinfo->subscription_price); ?>
			                </td>
			                
			            </tr>
			            <tr style="border-top: 1px solid #000000;">			                
			                <td colspan="3" width="90" style="text-align: right; padding: 5px; font-size: 10px; border-top: 1px solid #000; border-left: 1px solid #000;border-right: 1px solid #000;">Total Amount
			                </td>
			                <td width="100" style="text-align: center; padding: 5px; font-size: 10px; border-top: 1px solid #000;border-right: 1px solid #000;">
			                    $ <?php echo number_format($invoiceinfo->total_amt); ?>
			                </td>
			            </tr>
			            <tr style="border-top: 1px solid #000000;">			                
			                <td colspan="4" width="90" style="text-align: center; padding: 5px; font-size: 10px; border-top: 1px solid #000; border-left: 1px solid #000;border-right: 1px solid #000;"><?php echo $invoiceinfo->delivery_remark; ?>
			                </td>
			            </tr>
			            

			          
			    </tbody>
			    </table>  
			    
		
		</div>
	</div>

</div>

</body>
</html>