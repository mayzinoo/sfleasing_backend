<div class="mdl-cell--2-offset mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone">
        <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h1 class="mdl-card__title-text">Change Settings</h1>
                
            </div>
            <div class="mdl-card__supporting-text no-padding">
                	
		        <div class="mdl-grid">
				        <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--4-col-phone">
				        <span class="login-name text-color--white">USER SETTING</span>
				        <?=form_open('dashboard/update_setting/')?>
        				<form action="#">
        							<input type="hidden" name="id" value="<?php echo $admin->id; ?>">
				                	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
				                        <input name="firstname" class="mdl-textfield__input" type="text" value="<?php echo $admin->first_name; ?>">
				                        <label class="mdl-textfield__label" for="name">First Name</label>
				                    </div>

				                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
				                        <input name="lastname" class="mdl-textfield__input" type="text" value="<?php echo $admin->last_name; ?>">
				                        <label class="mdl-textfield__label" for="name">Last Name</label>
				                    </div>

				                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
				                        <input name="phone" class="mdl-textfield__input" type="text" value="<?php echo $admin->phone; ?>">
				                        <label class="mdl-textfield__label" for="name">Phone</label>
				                    </div>

				                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
				                        <input name="email" class="mdl-textfield__input" type="email" value="<?php echo $admin->email; ?>" required>
				                        <label class="mdl-textfield__label" for="e-mail">Email</label>
				                    </div>
				                    <!-- <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
				                        
				                        <select class="mdl-textfield__input mdl-js-menu dark_dropdown" name="role" id="role" data-placeholder="" style="width: 100%;" required>
		                                    <option value="<?php echo $admin->role; ?>"><?php echo $admin->role; ?></option>
		                                    <?php foreach(role_list() as $key => $status) : ?>
		                                    <option value="<?= $key ?>"><?= $status ?></option>
		                                    <?php endforeach; ?>
		                                </select>
				                        <label class="mdl-textfield__label" >Role</label>
				                    </div> -->
				                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised color--light-blue">Update Setting</button>
				        </form>
        				<?=form_close()?>
				        </div>
				  
				        <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--4-col-phone">
				        <span class="login-name text-color--white">PASSWORD SETTING</span>
				        <?=form_open('dashboard/update_password/')?>
        				<form action="#">
        							<input type="hidden" name="id" value="<?php echo $admin->id; ?>">
				                	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
				                        <input name="password" class="mdl-textfield__input" type="password"  value="" required>
				                        <label class="mdl-textfield__label" for="password">New Password</label>
				                    </div>

				                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
				                        <input name="confirm_password" class="mdl-textfield__input" type="password" required>
				                        <label class="mdl-textfield__label" for="password">Confirm Password</label>
				                    </div>
				                    
					                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised color--light-blue">Change Password</button>
					    </form>
        				<?=form_close()?>            
				        </div>				      
				    	
				</div>
				    
            </div>
        </div>
</div>
