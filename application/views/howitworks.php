
<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
        <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h1 class="mdl-card__title-text">How it Works</h1>
                <div class="card-tools">
                      <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                          <a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#modal-new-howitworks"><i class="fa fa-plus"></i> New</a>
                        </li>
                      </ul>
                </div>
            </div>
            <div class="mdl-card__supporting-text no-padding">
                <table class="mdl-data-table mdl-js-data-table bordered-table">
                            <thead>
                            <tr>
                                <th class="mdl-data-table__cell--non-numeric">#</th>
                                <th width="100" class="mdl-data-table__cell--non-numeric">Step</th>
                                <th width="200" class="mdl-data-table__cell--non-numeric">Title</th>
                                <th width="300" class="mdl-data-table__cell--non-numeric">Description</th>
                                <th width="200" class="mdl-data-table__cell--non-numeric">Photo</th>
                                <th class="mdl-data-table__cell--non-numeric">Date</th>
                                <th class="mdl-data-table__cell--non-numeric">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i=1;
                                    foreach($howitwork->result() as $row):
                                ?> 
                                    <tr>
                                        <td style="vertical-align: top" class="mdl-data-table__cell--non-numeric"><?php echo $i; ?></td>
                                        <td style="vertical-align: top" class="mdl-data-table__cell--non-numeric"><?php echo $row->step; ?></td>
                                        <td style="vertical-align: top" class="mdl-data-table__cell--non-numeric"><?php echo $row->title; ?></td>
                                        <td style="vertical-align: top" class="mdl-data-table__cell--non-numeric"><?php echo $row->description; ?></td>
                                        <?php if($row->photo!=""){ ?>
                                            <td style="vertical-align: top" class="mdl-data-table__cell--non-numeric"><img src="<?php echo base_url() .'upload/files/'.$row->photo;?>" class="img-responsive"></td>   
                                            <?php }else{ ?>
                                                    <td></td>
                                            <?php } ?>                                                
                                        <td style="vertical-align: top" class="mdl-data-table__cell--non-numeric"><?php echo $row->created_date; ?></td>
                                        <td style="vertical-align: top" class="mdl-data-table__cell--non-numeric">
                                            <a data-id="<?= $row->id ?>" type="button" href="javascript:void(0);" class="edit-howitworks btn btn-primary btn-xs color-white">
                                                <i class="fa fa-edit"></i> 
                                            </a>
                                            <a onclick="return confirm('Are you sure to delete?')" href="<?php echo base_url() .'dashboard/delete_howitwork/'.$row->id;?>" type="button" class="delete-asset btn btn-danger btn-xs color-white">
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

<div class="modal fade" id="modal-new-howitworks" role="dialog">
    <div class="modal-dialog">    
      <!-- Modal content-->
      <div class="modal-content">
         <form method="post" id="form_howitworks" enctype="multipart/form-data">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add How it works Text</h4>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                                <label>Step</label>
                                <input type="text" name="step" class="form-control" placeholder="Step"required="required">
                        </div>
                        <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Title" required="required">
                        </div>
                        <div class="form-group">
                                <label>Description</label>
                                <textarea cols="80" id="description" name="description" rows="10">
                                    <?php echo $page_content->message1; ?>
                                                </textarea>
                                                <script>

                                                    CKEDITOR.replace('description');

                                                </script>
                                
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

<!-- Edit How it works Modal -->
<div class="modal fade" id="modal-edit-howworks" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
         <form method="post" id="edit_howitworks" enctype="multipart/form-data" action="<?php echo site_url('dashboard/update_howitworks') ?>">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Edit How it works Text</h4>
                </div>
                <div class="modal-body">
                        <input type="hidden" value="" name="id"/> 
                        <div class="form-group">
                                <label>Step</label>
                                <input type="text" name="edit_step" class="form-control" placeholder="Step" >
                        </div>
                        <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="edit_title" class="form-control" placeholder="Title" >
                        </div>
                        <div class="form-group">
                                <label>Description</label>
                                <textarea cols="80" id="edit_description" name="edit_description" rows="10">
                                    <?php echo $page_content->message1; ?>
                                                </textarea>
                                                <script>

                                                    CKEDITOR.replace('edit_description');

                                                </script>
                        </div>                        
                        <div class="form-group" id="photo-preview">
                            <label>Photo</label>
                            <div>
                                    (No photo)
                                    <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label id="label-photo">Upload Photo </label>
                            <div>
                                    <input name="photo" type="file" class="form-control"multiple="true" accept="image/*">
                                    <span class="help-block"></span>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" id="howworksform" class="btn btn-success">Update</button>
                    </div>
                </div>
        </form>
      </div>
      
    </div>
</div>