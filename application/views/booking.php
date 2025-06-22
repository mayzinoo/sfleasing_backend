
<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
        <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h1 class="mdl-card__title-text">Booking List</h1>
            </div>
            <div class="mdl-card__supporting-text no-padding">
                <table class="mdl-data-table mdl-js-data-table bordered-table">
                    <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">#</th>
                        <th class="mdl-data-table__cell--non-numeric">Booking No</th>
                        <th class="mdl-data-table__cell--non-numeric">Model Name</th>
                        
                        <th class="mdl-data-table__cell--non-numeric">Delivery Date</th>
                        <th class="mdl-data-table__cell--non-numeric">Rental Package</th>                      
                        <th class="mdl-data-table__cell--non-numeric">Total Amount</th>
                        <th class="mdl-data-table__cell--non-numeric">Payment Type</th>
                        <th class="mdl-data-table__cell--non-numeric">Customer Name</th>
                        <th class="mdl-data-table__cell--non-numeric">Phone</th>
                        <th class="mdl-data-table__cell--non-numeric">Booking Status</th>                        
                        <th class="mdl-data-table__cell--non-numeric">Status</th>
                        <th class="mdl-data-table__cell--non-numeric">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                        foreach($bookinglist->result() as $row):
                      ?>  
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $i; ?></td>
                                <td class="mdl-data-table__cell--non-numeric"><a href="dashboard/booking_detail/<?php echo $row->bid; ?>" style="color:#f02424 !important; font-size: 14px !important"><?php echo $row->booking_no; ?></a></td>
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $row->modelname; ?></td>
                                
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $row->delivery_date; ?> ( <?php echo $row->delivery_time; ?> )</td>
                                
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $row->pkgduration; ?> Months, $ <?php echo $row->subscription_price; ?></td>
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $row->total_amt; ?></td>
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $row->payment_method; ?></td>
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $row->name; ?></td>
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $row->billing_phone; ?></td>
                                
                                
                                <td class="mdl-data-table__cell--non-numeric">
                                    <?php if($row->checkstatus=="1"){ ?>
                                        <b><span style="color:#f0ad4e">Pending </span></b>
                                    <?php }else if($row->checkstatus=="2"){ ?>
                                        <b><span style="color:#f0ad4e">Pending Approval</span></b>
                                    <?php }else if($row->checkstatus=="3"){ ?>          
                                        <b><span style="color:#07d227">Approved</span> </b>
                                    <?php }else if($row->checkstatus=="4"){ ?> 
                                        <b><span style="color:red">Rejected </span></b>
                                    <?php } ?>                             
                                </td>

                                <?php if($row->checkstatus=="3"){ ?>
                                        <td class="mdl-data-table__cell--non-numeric">
                                            <?php if($row->bstatus=="0"){ ?>
                                                <div class="btn-group btn-group-xs">
                                                    <a class="btn btn-warning btn-xs booking_status" data-id="<?= $row->bid ?>" type="button" href="javascript:void(0);" >Processing</a>                                       
                                                </div>
                                            <?php }else{ ?>
                                                
                                                    <a class="btn btn-success btn-xs" type="button" href="javascript:void(0);" ><i class="fas fa-check"></i></a>
                                                   
                                                    <a href="dashboard/generateinvoicepdf/<?php echo $row->ivoid; ?>/<?php echo $row->ivono; ?>" target="_blank" type="button" class="delete-asset btn btn-primary btn-xs color-white">
                                                        <i class="fa fa-file-pdf"></i>
                                                    </a>                             
                                                
                                            <?php } ?>
                                                
                                        </td>
                                <?php }else{ ?> 
                                        <td></td>
                                <?php } ?>   
                                
                                <?php if($row->checkstatus=="2"){ ?>
                                    <td class="mdl-data-table__cell--non-numeric">
                                        <a class="btn btn-warning btn-xs booking_approve" data-id="<?= $row->bid ?>" type="button" href="javascript:void(0);" >Approve</a>

                                        <a onclick="return confirm('Are you sure to delete?')" href="<?php echo base_url() .'dashboard/delete_bookings/'.$row->bid;?>" type="button" class="delete-asset btn-xs btn btn-danger color-white">
                                                    <i class="fa fa-trash"></i> 
                                        </a>
                                    </td>
                                <?php }else{ ?>
                                    <td class="mdl-data-table__cell--non-numeric">
                                        <a onclick="return confirm('Are you sure to delete?')" href="<?php echo base_url() .'dashboard/delete_bookings/'.$row->bid;?>" type="button" class="delete-asset btn btn-danger btn-xs color-white">
                                                    <i class="fa fa-trash"></i> 
                                        </a>
                                    </td>
                                <?php } ?>
                                
                            </tr>   
                        <?php
                        $i++;
                        endforeach; ?>                         
                    </tbody>
                </table>
            </div>
        </div>
</div>

<!-- Booking approve check -->
<div class="modal fade" id="modal-approvestatus" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
         <form method="post" action="<?php echo site_url('dashboard/update_bookingapprove') ?>">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Check and confirm user's booking</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="bid" id="bid">
                        <input type="hidden" name="vid" id="vid">
                        <div class="form-group">
                            <label>Confim User's booking</label>
                            <select class="select2" name="approvestatus" data-placeholder="Status" style="width: 100%;" required>
                                    <option value="">&nbsp;</option>
                                    <?php foreach(booking_approvelist() as $key => $status) : ?>
                                    <option value="<?= $key ?>"><?= $status ?></option>
                                    <?php endforeach; ?>
                            </select>
                        </div>
                    </div>   
                    <div class="modal-footer">
                        <div class="form-group">
                              <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
            </form> 
      </div>
      
    </div>
</div>
<!-- end -->


<!-- Payment check -->
<div class="modal fade" id="modal-paymentstatus" role="dialog">
    <div class="modal-dialog">
    
          <!-- Modal content-->
          <div class="modal-content">
             <form method="post" action="<?php echo site_url('dashboard/update_bookingstatus') ?>">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Update Payment</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="bid" id="bid"> 
                        <input type="hidden" name="vid" id="vid"> 
                        <input type="hidden" name="userid"> 

                        <div class="form-group">
                            <label>Payment Method</label>
                            <select class="select2-clear form-control" name="paymentmethod" style="width: 100%;" required>                                
                                <option value="cash" >Cash</option>
                                <option value="bank">Bank Transfer</option>
                            </select>
                        </div>
                        
                        
                        <div class="form-group chkfrm" id="chkfrm2" style="display: none;">
                            <label>Bank Name</label>
                            <select class="select2 form-control" name="paymentbank" style="width: 100%;">
                                <option value="">Select</option>
                                <option value="UOB">UOB</option>
                                <option value="DBS">DBS</option>
                                <option value="DBS">OCBC</option>
                            </select>
                        </div>
                        
                        <div class="form-group chkfrm" id="chkfrm3" style="display: none;">
                            <label>Reference Date</label>
                            <input name="reference_date" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                        </div>
                    </div>    
                    <div class="modal-footer">
                        <div class="form-group">
                              <button type="submit" class="btn btn-success">Update Payment</button>
                        </div>
                    </div>
            </form>                
          </div>  
        
      </div>
</div>

