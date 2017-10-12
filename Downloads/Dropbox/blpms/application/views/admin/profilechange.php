<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/validate.js'></script>  
<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
<noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
</noscript>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
		
   </div> 
    
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit Profile</h2> 
                
               

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="<?php echo base_url("admin/taskmanagement"); ?>" class="btn btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            
          
            <div class="box-content">
				
			<?php if(isset($error)) 
			{
				if($error == 2)
				{ ?>
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Your Profile Upadated successfully.</strong> 
					</div>
				<?php }
				else
				{	?>
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Something went wrong. Please try again.</strong> 
					</div>
				<?php }
			} ?>
			
                <form role="form" method="post" name="editprofileform" onSubmit="return profileform();" action="<?php echo base_url(); ?>admin/profile/update/<?php if(isset($edit_profile[0]->id)) { echo $edit_profile[0]->id; } ?>">
				

					<div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input type="text" name="firstname" class="form-control" id="firstname" placeholder="First Name" value="<?php if(isset($edit_profile[0]->firstname)) { echo $edit_profile[0]->firstname; }  ?>">
                    </div>  
                    
                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Last Name" value="<?php if(isset($edit_profile[0]->lastname)) {  echo $edit_profile[0]->lastname; } ?>">
                    </div>
                    
                   
                    
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="UserName" value="<?php if(isset($edit_profile[0]->username)) {  echo $edit_profile[0]->username; } ?>">                       
                    </div>
                     
                    <div class="form-group">
                        <label for="Company Name">Company Name</label>
                        <?php if(isset($companyname)) { echo form_input($companyname); } ?>						
                    </div>
                    
                    <div class="form-group">
                        <label for="Postal Address">Postal Address</label>
                        <?php if(isset($postaladdress)) { echo form_textarea($postaladdress); }  ?>						
                    </div>
                    
                     <div class="form-group">
                        <label for="Phone">Phone</label>
                        <?php if(isset($phone)) { echo form_input($phone); }  ?>						
                    </div>
                    
                     <div class="form-group">
                        <label for="Industry Type">Industry Type(Optional)</label>
                        <?php if(isset($industrytype)) { echo form_input($industrytype); } ?>						
                    </div> 
                                          
					<input type="hidden" name="passwordold" class="form-control" id="pass3" placeholder="Password" value="<?php  if(isset($edit_profile[0]->password)) { echo $edit_profile[0]->password ; } ?>">                       
                                       
                     <div class="form-group">
                        <label for="exampleInputPassword1">Change Password</label>
                        <input type="password" name="password" class="form-control" id="pass1" placeholder="Change Password" value="<?php echo set_value('password'); ?>">                       
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        <input type="password" name="cpassword" class="form-control" id="pass2" placeholder="Confirm Password" value="<?php echo set_value('cpassword'); ?>">                       
                    </div>
                    
                                    
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->

    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->

    

    <hr>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Settings</h3>
                </div>
                <div class="modal-body">
                    <p>Here settings can be configured...</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
                </div>
            </div>
        </div>
    </div>

