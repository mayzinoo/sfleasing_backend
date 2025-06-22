<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
		        <div class="mdl-card mdl-shadow--2dp">
		            <div class="mdl-card__title">
		                <h1 class="mdl-card__title-text">Invoice List</h1>		                
		            </div>
		            <div class="mdl-card__supporting-text no-padding ">
		                <table class="mdl-data-table mdl-js-data-table bordered-table invoicelist">
		                    <thead>
		                    <tr>
		                        <th class="mdl-data-table__cell--non-numeric">#</th>
		                        <th class="mdl-data-table__cell--non-numeric">Invoice No</th>
		                        <th class="mdl-data-table__cell--non-numeric">Total Amount (SGD) </th>
		                        <th class="mdl-data-table__cell--non-numeric">Invoice Date</th>
		                        <th class="mdl-data-table__cell--non-numeric">Delivery Date</th>
		                        <th class="mdl-data-table__cell--non-numeric">Status</th>
		                        <th width="200" class="mdl-data-table__cell--non-numeric" width="100">Action</th>
		                    </tr>
		                    </thead>
		                    <tbody>
		                             <?php
									$i=1;
					                    foreach($invoicelist->result() as $row):
					                  ?>  
					                <tr>
					                	<td class="mdl-data-table__cell--non-numeric"><?php echo $i; ?></td>
					                	<td class="mdl-data-table__cell--non-numeric"><?php echo $row->invoice_name; ?></td>					                	
										<td class="mdl-data-table__cell--non-numeric">$ <?php echo number_format($row->totalamt); ?></td>
										<td class="mdl-data-table__cell--non-numeric"><?php echo $row->invoice_date; ?></td>
										<td class="mdl-data-table__cell--non-numeric"><?php echo $row->delidate; ?></td>
										<td class="mdl-data-table__cell--non-numeric"><b>Approved</b></td>
		                                <td class="mdl-data-table__cell--non-numeric">
		                                	<a href="dashboard/generateinvoicepdf/<?php echo $row->ivoid; ?>/<?php echo $row->ivono; ?>" target="_blank" type="button" class="delete-asset btn btn-primary btn-sm color-white">
		                                        <i class="fa fa-file-pdf"></i>
		                                    </a>
		                                	
											<a onclick="return confirm('Are you sure to delete ?')" href="<?php echo base_url() .'dashboard/delete_invoice/'.$row->ivoid;?>" type="button" class="delete-asset btn btn-danger btn-sm color-white">
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
		</div><!-- Brands column -->

