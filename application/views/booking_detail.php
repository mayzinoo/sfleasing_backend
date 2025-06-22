<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
        <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h1 class="mdl-card__title-text">Users Booking Details</h1>                
            </div>
            <div class="mdl-card__supporting-text no-padding">
                <div class="col-md-12">
                        <div class="col-md-6 box-content">
                            <h5>User Information</h5>   
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title">Booking ID</span>
                                </div>
                                <div class="col-md-6">
                                    <p>: #<?php echo $bookingdata->booking_no; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title">Customer Name</span>
                                </div>
                                <div class="col-md-6">
                                    <p>: <?php echo $bookingdata->first_name.' '.$bookingdata->last_name; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title">Email</span>
                                </div>
                                <div class="col-md-6">
                                    <p>: <?php echo $bookingdata->email; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title">Phone</span>
                                </div>
                                <div class="col-md-6">
                                    <p>: <?php echo $bookingdata->phone; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title">Payment Status</span>
                                </div>
                                <div class="col-md-6">
                                    <?php if($bookingdata->bstatus=='0'){ ?>
                                        <p>: <span class="btn btn-warning btn-xs">Processing</span></p>
                                    <?php }else{ ?>
                                        <p>: <span class="btn btn-success btn-xs">Success</span></p>
                                    <?php } ?>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title">Payment Method</span>
                                </div>
                                <div class="col-md-6">
                                    <p>: <?php echo $bookingdata->payment_method; ?></p>
                                </div>
                            </div>
                            <?php if($bookingdata->payment_method=="bank"){ ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span class="mini-title">Bank Name</span>
                                        </div>
                                        <div class="col-md-6">
                                            <p>: <?php echo $bookingdata->bank_name; ?></p>
                                        </div>
                                    </div>
                            <?php }else{ ?>

                            <?php } ?>
                            
                            <h5>Vehicle Information</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title">Model Name</span>
                                </div>
                                <div class="col-md-6">
                                    <p>: <?php echo $bookingdata->modelname; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title">Duration</span>
                                </div>
                                <div class="col-md-6">
                                    <p>: <?php echo $bookingdata->duration; ?> Months</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title">Price</span>
                                </div>
                                <div class="col-md-6">
                                    <p>: SGD <?php echo $bookingdata->subscription_price; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title">Color</span>
                                </div>
                                <div class="col-md-6">
                                    <?php if($bookingdata->color=="#ffffff"){ ?>
                                        <p>: White</p>
                                    <?php }else if($bookingdata->color=="#00a4ff"){ ?>
                                        <p>: Blue</p>
                                    <?php }else if($bookingdata->color=="#f10a0a"){ ?>
                                        <p>: Red</p>
                                    <?php }else if($bookingdata->color=="#aab5bb"){ ?>
                                        <p>: Grey</p>
                                    <?php }else if($bookingdata->color=="#000000"){ ?>
                                        <p>: Black</p>
                                    <?php }else if($bookingdata->color=="#682c18"){ ?>
                                        <p>: Brown</p>
                                    <?php } ?>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title">Total Amount</span>
                                </div>
                                <div class="col-md-6">
                                    <p>: SGD <?php echo $bookingdata->total_amt; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title">Expired Date</span>
                                </div>
                                <div class="col-md-6">
                                    <p>: <?php echo $bookingdata->available_date; ?></p>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6 box-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title ">Driving License Front</span>
                                    <?php if($bookingdata->driving_license_front!=""){ ?>
                                        <img src="<?php echo base_url() .'upload/usersinfo/'.$bookingdata->driving_license_front;?>" class="img-responsive license-img sm_topmargin">
                                        <?php }else{ ?>
                                               No Photo
                                        <?php } ?>
                                </div>
                                <div class="col-md-6">
                                    <span class="mini-title ">Driving License Back</span>
                                    <?php if($bookingdata->driving_license_back!=""){ ?>
                                        <img src="<?php echo base_url() .'upload/usersinfo/'.$bookingdata->driving_license_back;?>" class="img-responsive license-img sm_topmargin">
                                        <?php }else{ ?>
                                               No Photo
                                        <?php } ?>
                                </div>
                            </div> 
                            <div class="row md_topmargin">
                                <div class="col-md-6">
                                    <span class="mini-title">National ID Fronot</span>
                                    <?php if($bookingdata->national_id_front!=""){ ?>
                                        <img src="<?php echo base_url() .'upload/usersinfo/'.$bookingdata->national_id_front;?>" class="img-responsive license-img sm_topmargin">
                                        <?php }else{ ?>
                                               No Photo
                                        <?php } ?>
                                </div>
                                <div class="col-md-6">
                                    <span class="mini-title">National ID Back</span>
                                    <?php if($bookingdata->national_id_back!=""){ ?>
                                        <img src="<?php echo base_url() .'upload/usersinfo/'.$bookingdata->national_id_back;?>" class="img-responsive license-img sm_topmargin">
                                        <?php }else{ ?>
                                               No Photo
                                        <?php } ?>
                                </div>
                            </div> 
                            
                            
                        </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6 box-content">
                        <h5>Delivery Address</h5>  
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title">Delivery Date</span> 
                                </div>
                                <div class="col-md-6">
                                    <p>: <?php echo $bookingdata->delivery_date; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title">Delivery Time</span> 
                                </div>
                                <div class="col-md-6">
                                    <p>: <?php echo $bookingdata->delivery_time; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title">Delivery Address 1</span> 
                                </div>
                                <div class="col-md-6">
                                    <p>: <?php echo $bookingdata->delivery_address1; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title">Delivery Address 2</span> 
                                </div>
                                <div class="col-md-6">
                                    <p>: <?php echo $bookingdata->delivery_address2; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title">Phone</span> 
                                </div>
                                <div class="col-md-6">
                                    <p>: <?php echo $bookingdata->deli_phone; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title">Postcode</span> 
                                </div>
                                <div class="col-md-6">
                                    <p>: <?php echo $bookingdata->delivery_postcode; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title">Delivery Remark</span> 
                                </div>
                                <div class="col-md-6">
                                    <p>: <?php echo $bookingdata->delivery_remark; ?></p>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-6 box-content">
                        <h5>Billing Address</h5>  
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title">Billing Address 1</span> 
                                </div>
                                <div class="col-md-6">
                                    <p>: <?php echo $bookingdata->billing_address1; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title">Billing Address 2</span> 
                                </div>
                                <div class="col-md-6">
                                    <p>: <?php echo $bookingdata->billing_address2; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title">Phone</span> 
                                </div>
                                <div class="col-md-6">
                                    <p>: <?php echo $bookingdata->billing_phone; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title">Country</span> 
                                </div>
                                <div class="col-md-6">
                                    <p>: <?php echo $bookingdata->country; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title">State</span> 
                                </div>
                                <div class="col-md-6">
                                    <p>: <?php echo $bookingdata->state; ?></p>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="mini-title">Postcode</span> 
                                </div>
                                <div class="col-md-6">
                                    <p>: <?php echo $bookingdata->billing_postcode; ?></p>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
</div>






