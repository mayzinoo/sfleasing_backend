
<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
        <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h1 class="mdl-card__title-text">FAQ</h1>
                <div class="card-tools">
                      <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                          <a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#modal-new-faq"><i class="fa fa-plus"></i> New</a>
                        </li>
                      </ul>
                </div>
            </div>
            <div class="mdl-card__supporting-text no-padding">
                <table class="mdl-data-table mdl-js-data-table bordered-table">
                    <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">#</th>
                        <th width="300" class="mdl-data-table__cell--non-numeric">Main Title</th>
                        <th width="300" class="mdl-data-table__cell--non-numeric">Sub Title</th>
                        <th width="400" class="mdl-data-table__cell--non-numeric">Description</th>
                        <th class="mdl-data-table__cell--non-numeric">Date</th>
                        <th class="mdl-data-table__cell--non-numeric">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                            $i=1;
                                foreach($faq->result() as $row):
                            ?> 
                                <tr>
                                    <td style="vertical-align:top" class="mdl-data-table__cell--non-numeric"><?php echo $i; ?></td>
                                    <td style="vertical-align:top" class="mdl-data-table__cell--non-numeric"><?php echo $row->main_title; ?></td>
                                    <td style="vertical-align:top" class="mdl-data-table__cell--non-numeric"><?php echo $row->sub_title; ?></td>
                                    <td style="vertical-align:top" class="mdl-data-table__cell--non-numeric"><?php echo $row->description; ?></td>
                                    <td style="vertical-align:top" class="mdl-data-table__cell--non-numeric"><?php echo $row->created_date; ?></td>
                                    <td style="vertical-align:top" class="mdl-data-table__cell--non-numeric">
                                        <a data-id="<?= $row->id ?>" type="button" href="javascript:void(0);" class="edit-faq btn btn-primary btn-xs color-white">
                                            <i class="fa fa-edit"></i> 
                                        </a>
                                        <a onclick="return confirm('Are you sure to delete?')" href="<?php echo base_url() .'dashboard/delete_faq/'.$row->id;?>" type="button" class="delete-asset btn btn-danger btn-xs color-white">
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


<!-- New FAQ -->
<div class="modal fade" id="modal-new-faq" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
         <form method="post" enctype="multipart/form-data;charset=utf-8">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add FAQ</h4>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                                <label>Main Title</label>
                                <input type="text" name="n_maintitle" class="form-control" placeholder="Title" required>
                        </div>
                        <div class="form-group">
                                <label>Sub Title</label>
                                <input type="text" name="n_subtitle" class="form-control" placeholder="Title" required>
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


<!-- Edit FAQ -->
<div class="modal fade" id="modal-edit-faq" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
         <form method="post" action="<?php echo site_url('dashboard/update_faq') ?>">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Update FAQ</h4>
                </div>
                <div class="modal-body">
                        <input type="hidden" value="" name="id"/> 
                        <div class="form-group">
                                <label>Main Title</label>
                                <input type="text" name="maintitle" id="maintitle" class="form-control" placeholder="Title" required>
                        </div>
                        <div class="form-group">
                                <label>Sub Title</label>
                                <input type="text" name="subtitle" id="subtitle" class="form-control" placeholder="Title" required>
                        </div>                       
                        <div class="form-group">
                                <label>Description</label>
                                <textarea cols="80" id="faq_description" name="faq_description" rows="10">
                                    <?php echo $page_content->message1; ?>
                                                </textarea>
                                                <script>

                                                    CKEDITOR.replace('faq_description');

                                                </script>
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