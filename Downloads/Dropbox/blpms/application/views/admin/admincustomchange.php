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
                <a href="<?php echo base_url("admin/admincustomization"); ?>">Admin Customization</a>
            </li>
			<li>
				<?php if(isset($edit_variables)) { ?>
					<a href="<?php echo base_url("admin/admincustomization/edit/{$edit_variables[0]->id}"); ?>">Edit Variables</a>
			    <?php } else { ?>
					<a href="<?php echo base_url("admin/admincustomization/add"); ?>">Add Variables</a>
			    <?php } ?>
			</li>
		</ul>
   </div> 
    
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <?php if(isset($edit_variables)) { ?><h2><i class="glyphicon glyphicon-edit"></i>Edit Variables</h2> 
                <?php } else { ?>
                <h2><i class="glyphicon glyphicon-edit"></i>Add New Variables</h2>
                <?php } ?> 

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="<?php echo base_url("admin/taskmanagement"); ?>" class="btn btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            
          
            <div class="box-content">
				<?php if(isset($edit_variables)) { ?>
                <form role="form" method="post" id="form1" name="customization" onSubmit="return customform();" action="<?php echo base_url(); ?>admin/admincustomization/edit/<?php echo $edit_variables[0]->id; ?>">
				<?php } else { ?>
				<form role="form" method="post" name="customization" onSubmit="return customform();" action="<?php echo base_url(); ?>admin/admincustomization/add" >
				<?php } ?>	
					
                     <div class="form-group">
						<label class="control-label" for="selectError">Variable Name</label>
						
                        
						<div class="controls">								
								
							<?php		if(isset($options)) {
							$attr = 'id="varname" data-rel="chosen" style="width:100%; height:40px;"';
							 echo form_dropdown('variable_name',$options,'0',$attr); 
									}
						        ?>	
							   						
						</div>
					</div>
                    
                    
                    
                    
                    <div class="form-group">
                        <label for="Variable Value">Variable Value</label> 
                        
						
                        <?php 
						  if(isset($edit_variables) && $edit_variables[0]->id == 144)
						  {
						?>
                        
                        <input type="text" id="picker" name="variable_value1"  class="form-control"  placeholder="Variable Value" value="<?php if(isset($edit_variables)) { echo $edit_variables[0]->variable_value; } else { echo set_value('variable_value'); } ?>">
					    <input type="text" name="variable_valueanother1" onkeypress="return IsNumeric(event);" id="picker1" class="form-control"  placeholder="Variable Value" value="<?php if(isset($edit_variables)) { echo $edit_variables[0]->variable_value; } else { echo set_value('variable_valueanother'); } ?>">
                      	<span id="error" style="color: Red; display: none">* Please insert number only </span>
                      	
                      	<?php  }else{ ?>
						
						<input type="text" id="picker" name="variable_value"  class="form-control"  placeholder="Variable Value" value="<?php if(isset($edit_variables)) { echo $edit_variables[0]->variable_value; } else { echo set_value('variable_value'); } ?>">
					    <input type="text" name="variable_valueanother" id="picker1" class="form-control"  placeholder="Variable Value" value="<?php if(isset($edit_variables)) { echo $edit_variables[0]->variable_value; } else { echo set_value('variable_valueanother'); } ?>">
							
						<?php } ?>	
						
						 
										    
                    </div>
                    <div class="form-group">
						<?php if(isset($edit_variables) && $edit_variables[0]->id == 145) { ?>						
						<div class="form-group">
							<label class="control-label" for="selectError">Select Font Family</label>
							<div class="controls">																
							<?php
								$fonts = array("Helvetica"=>"Helvetica","Arial"=>"Arial","verdana"=>"verdana","times new roman"=>"times new roman","sans-serif"=>"sans-serif");
								if(isset($fonts)) {
									$attr = 'id="site_font" data-rel="chosen" style="width:100%; height:40px;"';
									echo form_dropdown('site_font',$fonts,'0',$attr); 
								}
						    ?>	
							</div>
						</div>						
						<?php } ?>
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


<script type="text/javascript">
	var specialKeys = new Array();
	specialKeys.push(8); 
	function IsNumeric(e) {
		var keyCode = e.which ? e.which : e.keyCode
		var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
		document.getElementById("error").style.display = ret ? "none" : "inline";
		return ret;
	}
</script>
