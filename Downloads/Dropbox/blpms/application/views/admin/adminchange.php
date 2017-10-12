<?php if(isset($user_type)) { 
					if($user_type != 1 ) { 
						redirect('admin/taskmanagement', 'refresh');
					}
				}
		
				
				?>

					
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
		<ul class="breadcrumb">
			<li>
				<a href="<?php echo base_url("admin/taskmanagement"); ?>">Home</a>
			</li>
			 <li>
                <a href="<?php echo base_url("admin/usermanagement"); ?>">User Management</a>
            </li>
			<li>
				<?php if(isset($edit_admin)) { ?>
					<a href="<?php echo base_url("admin/usermanagement/edit/{$edit_admin[0]->id}"); ?>">Edit User</a>
			    <?php } else { ?>
					<a href="<?php echo base_url("admin/usermanagement/add"); ?>">Add User</a>
			    <?php } ?>
			</li>
		</ul>
   </div> 
    
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <?php if(isset($edit_admin)) { ?><h2><i class="glyphicon glyphicon-edit"></i>Edit User</h2> 
                <?php } else { ?>
                <h2><i class="glyphicon glyphicon-edit"></i>Add New User</h2>
                <?php } ?> 

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="<?php echo base_url("admin/taskmanagement"); ?>" class="btn btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            
          
            <div class="box-content">
				<?php if(isset($edit_admin)) { ?>
                <form role="form" method="post" name="editadminform" onSubmit="return editform();" action="<?php echo base_url(); ?>admin/usermanagement/update/<?php if(isset($edit_admin[0]->id)) { echo $edit_admin[0]->id; } ?>">
				<?php } else { ?>
				<form role="form" method="post" name="registration" id="registration" onSubmit="return formValidation();" action="<?php echo base_url(); ?>admin/usermanagement/insert" >
				<?php } ?>	
				    <?php if(isset($edit_admin)) { ?>	
					<input type="hidden" name="edit_hidden_id" id="edit_hidden_id" value="<?php if(isset($edit_admin[0]->id)) { echo $edit_admin[0]->id; } ?>">
					<?php } ?>
					<?php
						$query = $this->db->query('select (MAX(id)+1) as id1 from admin') or die(mysql_error());
                            
                        $query2 = $query->result();    
					
					
					?>
					
					<input type="hidden" name="hidden_id" id="hidden_id" value="<?php if(isset($query2[0]->id1)) { echo $query2[0]->id1; } ?>">
					<div class="form-group">
						
                        <label for="firstname">Firstname<span class="required">*</span></label>
                        <input type="text" name="firstname" class="form-control" id="firstname" placeholder="First Name" value="<?php if(isset($edit_admin)) { echo $edit_admin[0]->firstname; } else { echo set_value('firstname') ;  } ?>">
                    </div>  
                    
                    <div class="form-group">
						
                        <label for="lastname">Lastname<span class="required">*</span></label>
                        
                        <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Last Name" value="<?php if(isset($edit_admin)) { echo $edit_admin[0]->lastname; } else { echo set_value('lastname'); } ?>">
                    </div>
                                        
                    
                    <div class="form-group">
						
                        <label for="username">Username<span class="required">*</span></label>
                       
                        <input type="text" name="username" class="form-control" id="username" placeholder="UserName" value="<?php if(isset($edit_admin)) { echo $edit_admin[0]->username; } else { echo set_value('username'); } ?>">                       
                   
                    <?php if(isset($edit_admin)) { 	
                    $data['address'] = substr($edit_admin[0]->username, strpos($edit_admin[0]->username, "@") + 1);
                    }   ?>
                   
                    </div>
                    
                    <div class="form-group">
                        <label for="Company Name">Company Name<span class="required">*</span></label>
                        <?php if(isset($companyname)) { echo form_input($companyname); } ?>						
                    </div>
                    
                    <div class="form-group">
                        <label for="Postal Address">Postal Address<span class="required">*</span></label>
                        <?php if(isset($postaladdress)) { echo form_textarea($postaladdress); }  ?>						
                    </div>
                    
                     <div class="form-group">
                        <label for="Phone">Phone<span class="required">*</span></label>
                        <?php if(isset($phone)) { echo form_input($phone); } ?>						
                    </div>
                    
                     <div class="form-group">
                        <label for="Industry Type">Industry Type(Optional)</label>
                        <?php if(isset($industrytype)) { echo form_input($industrytype); }  ?>						
                    </div>
                    
                     
                     <?php if(isset($edit_admin)) { ?>                      
					<input type="hidden" name="password" class="form-control" id="pass1" placeholder="Password" value="<?php if(isset($edit_admin[0]->password)) {  echo $edit_admin[0]->password ; } ?>">                       
                                       
                     <div class="form-group">
						 
                        <label for="exampleInputPassword1">Change Password</label>
                       
                        <input type="password" name="cpassword" class="form-control" id="pass2" placeholder="cpassword" value="<?php echo set_value('cpassword'); ?>">                       
                    </div>
                    <?php } else { ?>
                    
                      <div class="form-group">
						 
                        <label for="exampleInputPassword1">Password<span class="required">*</span></label>
                       
                        <input type="password" name="password" class="form-control" id="pass1" placeholder="Password" value="<?php echo set_value('password'); ?>">                       
                    </div>
                    
                    <div class="form-group">
                       
                        <label for="exampleInputPassword1">Confirm Password<span class="required">*</span></label>
                        
                        <input type="password" name="cpassword" class="form-control" id="pass2" placeholder="Confirm Password" value="<?php echo set_value('cpassword'); ?>">
                    </div>           
                    
                    <?php } ?>
                    
                     <div class="form-group">
						<label class="control-label" for="selectError">User Type<span class="required">*</span></label>                      
						<div class="controls">	
							<?php
							if(isset($user)) {
								$attr = 'id="usertype" data-rel="chosen" style="width:100%; height:40px;"';
								 if(isset($edit_admin)) 
								 {                       
									echo form_dropdown('user_type',$user,$edittype->user2,$attr);
								 } 
								 else
								 {
									echo form_dropdown('user_type',$user,'2',$attr);
								 } 
						     }
						       ?> 							   						
						</div>
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
<?php if(isset($edit_admin)) { } else { ?>
<script>
	$( "#username" ).blur(function() 
	{					
		var userval = $(this).val();
		if(userval.indexOf("@") >= 0)
		{	
		var address = userval.substr(userval.indexOf("@") + 1);
	//	var comp = document.getElementById('compname') ;
	//	var id = document.getElementById('edit_hidden_id').value;
		var strurl = "<?php echo base_url() ; ?>admin/usermanagement/getaddval/"+address ;
							
			$.ajax({
			type:"post",			
			url:strurl,
			dataType: "json",	
				
			success:function(data){
									console.log(data);
				                    document.getElementById('compname').value = data.companyname ;
				                    document.getElementById('manufact').value = data.postaladdress ;
				                    document.getElementById('phone').value = data.phone ;
				                    document.getElementById('indtype').value = data.industry ;
				                //    document.getElementById('usertype').value = "3" ;
				                   
				                $("#usertype").change(function() {
									return $( "#usertype" ).val();
								});   
				                /*$("#usertype").change(function() {
				                $("#usertype option").filter(function() {
									//return $(this).attr('value') == "3";
									//return $("#usertype option:selected").val();
									var selected_value=  $( "#usertype" ).val();
									return selected_value;
								}).attr('selected', true); });*/
								
								
				                    $("#compname").prop('readonly', true);
								    $("#manufact").prop('readonly', true);
								    $("#phone").prop('readonly', true);
								    $("#indtype").prop('readonly', true);
				                    
								    
								  }
								  								  
				   });
									document.getElementById('compname').value = '';
				                    document.getElementById('manufact').value = '';
				                    document.getElementById('phone').value = '';
				                    document.getElementById('indtype').value = '';
									$("#compname").prop('readonly', false);
								    $("#manufact").prop('readonly', false);
								    $("#phone").prop('readonly', false);
								    $("#indtype").prop('readonly', false);
				   
			}
			
	});	
	
	
		
		
  		 	
</script>				
<?php } ?>
