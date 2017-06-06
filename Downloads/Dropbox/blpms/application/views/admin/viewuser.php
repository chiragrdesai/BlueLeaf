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
				
					<a href="<?php echo base_url("admin/usermanagement/views/{$edit_admin[0]->id}"); ?>">View Task</a>
			   
			</li>
		</ul>
   </div> 
    
<div class="row">
    <div class="box col-md-12" style="border: 1px solid #DDD;">
        <!--<div class="box-inner">
            <div class="box-header well" data-original-title="">
               <h2><i class="glyphicon glyphicon-edit"></i>View Task</h2> 
               

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="<?php echo base_url("admin/taskmanagement"); ?>" class="btn btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div> -->
            
          
           <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#sectionC">View User</a></li>
    </ul>
    <div class="tab-content">
        <div id="sectionC" class="tab-pane fade in active">
           
				    <div class="form-group fodd">
                        <div class="row">
							<div class="col-md-4"><h5>First Name :</h5></div>
							<div class="col-md-4"><h5><?php if(isset($edit_admin[0]->firstname))	{ echo $edit_admin[0]->firstname ; } ?></h5></div>
							
					   </div>
                       
                    </div>
                    
                    <div class="form-group feven">
						<div class="row">
								<div class="col-md-4"><h5>Last Name :</h5></div>
								<div class="col-md-4"><h5><?php if(isset($edit_admin[0]->lastname)){ echo $edit_admin[0]->lastname ;}?></h5></div>								
						</div>
                        
                    </div>
                    
                    <div class="form-group fodd">
						<div class="row">
								<div class="col-md-4"><h5>Username :</h5></div>
								<div class="col-md-4"><h5><?php if(isset($edit_admin[0]->username))	{ echo $edit_admin[0]->username ; } ?></h5></div>								
						</div>                       
                    </div>
					
                    
                    
                   <div class="form-group feven">
                        <div class="row">
							<div class="col-md-4"><h5>Company Name :</h5></div>
							<div class="col-md-4"><h5><?php if(isset($companyname))	{ echo $companyname ; } ?></h5></div>
							
					   </div>
                       
                    </div>
                   
                    <div class="form-group fodd">
						<div class="row">
								<div class="col-md-4"><h5>Postal Address :</h5></div>
								<div class="col-md-4"><h5><?php if(isset($postaladdress)){ echo $postaladdress ;}?></h5></div>								
						</div>
                        
                    </div>
                    
                    <div class="form-group feven">
						<div class="row">
								<div class="col-md-4"><h5>Phone :</h5></div>
								<div class="col-md-4"><h5><?php if(isset($phone))	{ echo $phone ; } ?></h5></div>								
						</div>                       
                    </div>
                 <?php   if(isset($industrytype))	{ ?>
                    <div class="form-group fodd">
						<div class="row">
								<div class="col-md-4"><h5>Industry Type :</h5></div>
								<div class="col-md-4"><h5><?php echo $industrytype ;  ?></h5></div>								
						</div>
                        
                    </div>
                    <?php } ?>
                    
                    <div class="form-group feven">
						<div class="row">
								<div class="col-md-4"><h5>User Type :</h5></div>
								<div class="col-md-4"><h5><?php echo $edittype->user1 ; ?></h5></div>								
						</div>
                        
                    </div>
                               
                    
		</div>
        
                    
        </div>
			
    </div>
				
                
                                  
                    
                    

           
        </div>
  
    <!--/span-->
    <?php if($user_type == 1 || $user_type == 2 ) { ?>
   <div class="editdelete">
   <tr>
	   <td class="center">
			<a class="btn btn-info" href="<?php echo base_url("admin/usermanagement/edit/{$edit_admin[0]->id}"); ?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a>
            
            <a class="btn btn-danger"  href="<?php echo base_url("admin/usermanagement/delete/{$edit_admin[0]->id}"); ?>" onclick=" return ConfirmDelete();">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                Delete
            </a>
        </td>
    </tr> 
    </div>  
    <?php } ?>      

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
	$('#sectionBform').submit(function() {
    
  		var checked_boxes = $(":checkbox:checked").length;

  		if(checked_boxes < 1){
      			alert("Please Select Files");
      			return false;
  		}else if($('#file_name').val() == ''){
      			alert("Please Enter Name");
      			return false;
  		}
  
	});
	
	$(document).ready(function() {
    $('#selectall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
});
</script>
