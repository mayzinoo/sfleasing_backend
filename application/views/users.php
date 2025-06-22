
<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
        <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h1 class="mdl-card__title-text">Users List</h1>
                <div class="card-tools">
                      <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                          <a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#modal-new-users"><i class="fa fa-plus"></i> New</a>
                        </li>
                      </ul>
                </div>
            </div>
            <div class="mdl-card__supporting-text no-padding">
                <table class="mdl-data-table mdl-js-data-table bordered-table">
                    <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">#</th>
                        <th class="mdl-data-table__cell--non-numeric">First Name</th>
                        <th class="mdl-data-table__cell--non-numeric">Last Name</th>
                        <th class="mdl-data-table__cell--non-numeric">Email</th>
                        <th class="mdl-data-table__cell--non-numeric">Phone</th>
                        <!-- <th class="mdl-data-table__cell--non-numeric">Address</th> -->
                        <!-- <th width="300" class="mdl-data-table__cell--non-numeric">Message</th> -->
                        <th class="mdl-data-table__cell--non-numeric">Created Date</th>
                        <th class="mdl-data-table__cell--non-numeric">Role</th>
                        <th class="mdl-data-table__cell--non-numeric">Status</th>
                        <th class="mdl-data-table__cell--non-numeric">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                            $i=1;
                                foreach($userslist->result() as $row):
                            ?> 
                                <tr>
                                    <td class="mdl-data-table__cell--non-numeric"><?php echo $i; ?></td>
                                    <td class="mdl-data-table__cell--non-numeric"><?php echo $row->first_name; ?></td>
                                    <td class="mdl-data-table__cell--non-numeric"><?php echo $row->last_name; ?></td>
                                    <td class="mdl-data-table__cell--non-numeric"><?php echo $row->email; ?></td>
                                    <td class="mdl-data-table__cell--non-numeric"><?php echo $row->phone; ?></td>
                                   
                                    <td class="mdl-data-table__cell--non-numeric"><?php echo $row->created_date; ?></td>
                                    
                                        <?php if($row->role=='dealer'){ ?>
                                                <td class="mdl-data-table__cell--non-numeric editortxt">Dealer</td>
                                        <?php }else if($row->role=='admin'){ ?>
                                                <td class="mdl-data-table__cell--non-numeric admintxt">Admin</td>
                                        <?php }else{ ?>
                                                <td class="mdl-data-table__cell--non-numeric">Customer</td>
                                         <?php } ?>
                                        
                                    <td class="mdl-data-table__cell--non-numeric">
                                        <?php if($row->status=='2' || $row->role=="admin"){ ?>
                                                <span style="color:#5cb85c"><b>Approved</b></span>
                                        <?php }else{ ?>
                                                <span style="color:#f4d00b"><b>Pending</b></span>
                                        <?php } ?>
                                    </td>
                                
                               
                                    <td class="mdl-data-table__cell--non-numeric">
                                        <?php if($row->status=="1" && $row->role!="customer" && $row->role!="admin"){ ?>
                                            <a data-id="<?= $row->id ?>" type="button" href="javascript:void(0);" class="dealer_approve btn btn-success btn-xs color-white">
                                                <i class="fa fa-edit"></i> Approve
                                            </a>
                                        <?php } ?>
                                        <a data-id="<?= $row->id ?>" type="button" href="javascript:void(0);" class="edit-users btn btn-primary btn-xs color-white">
                                            <i class="fa fa-edit"></i> 
                                        </a>
                                        <a onclick="return confirm('Are you sure to delete?')" href="<?php echo base_url() .'dashboard/delete_users/'.$row->id;?>" type="button" class="delete-asset btn btn-danger btn-xs color-white">
                                            <i class="fa fa-trash"></i> 
                                        </a>
                                    </td>
                                
                                </tr>    
                        <?php
                        $i++;
                        endforeach; ?>                            
                    </tbody>
                </table>
            </div>
        </div>
</div>

<!-- Model Popup  -->
<div class="modal fade" id="modal-new-users" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
         <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add Users</h4>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="user_firstname" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="user_lastname" class="form-control" placeholder="Last Name" required>
                        </div>
                        
                        <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="user_email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="user_phone" class="form-control" placeholder="Phone" required>

                        </div>
                        <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="user_password" class="form-control" placeholder="Password" minlength="5" required>
                        </div>
                        <div class="form-group">
                                <label>Role</label>
                                <select class="select2 form-control" name="role" data-placeholder="Role" style="width: 100%;" required>
                                    <option value="">&nbsp;</option>
                                    <?php foreach(role_list() as $key => $status) : ?>
                                    <option value="<?= $key ?>"><?= $status ?></option>
                                    <?php endforeach; ?>
                                </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
        </form>
      </div>
      
    </div>
</div>

<div class="modal fade" id="modal-edit-users" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
         <form method="post" action="<?php echo site_url('dashboard/update_users') ?>">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Update Users</h4>
                </div>
                <div class="modal-body">
                        <input type="hidden" name="id"/> 
                        <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="firstname" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="lastname" class="form-control" placeholder="Last Name" required>
                        </div>
                        <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control" placeholder="Phone" required>

                        </div>
                        <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Leave empty if no change" >
                        </div>
                        <div class="form-group">
                                <label>Role</label>
                                <select class="select2" name="role" data-placeholder="Role" style="width: 100%;" required>
                                    <option value="">&nbsp;</option>
                                    <?php foreach(role_list() as $key => $status) : ?>
                                    <option value="<?= $key ?>"><?= $status ?></option>
                                    <?php endforeach; ?>
                                </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
        </form>
      </div>
      
    </div>
</div>
<!-- end -->

<!-- Dealer approve form -->
<div class="modal fade" id="modal-dealerapprove" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
         <form method="post" action="<?php echo site_url('dashboard/update_dealerapprove') ?>">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Are you sure you want to approve?</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" >
                    <label>Dealer's Password</label>
                    <input type="password" class="form-control" name="password" placeholder="If you leave empty , the email will send with default password(12345) to dealers.">
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success">Approve and Send Email</button>
                    </div>
                </div>
        </form>
      </div>
      
    </div>
</div>


