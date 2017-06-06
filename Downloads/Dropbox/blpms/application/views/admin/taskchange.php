<?php 
if(isset($edit_task)) {
	
		if($user_type == 1 ) {

			if(isset($edit_task[0]->id))
			{
				
			}
			else
			{
				redirect('admin/taskmanagement', 'refresh');
			}		
	}

	if($user_type == 2 ) 
	{
		if(isset($edit_task[0]->id))
		{
			$query = $this->db->query('select * from tasklist where task_id = "'.$id.'" and id="'.$edit_task[0]->id.'"');
			$results = $query->result();
			if($results)
			{
				
			}
			else
			{
				redirect('admin/taskmanagement', 'refresh');
			}		
		}
		else
		{
			redirect('admin/taskmanagement', 'refresh');
		}			
	} 
	
	if($user_type == 3 ) 
	{
		if(isset($edit_task[0]->id))
		{
			$query = $this->db->query('select * from tasklist where assignee = "'.$id.'" and id="'.$edit_task[0]->id.'"');
			$results = $query->result();
			if($results)
			{
				
			}
			else
			{
				redirect('admin/taskmanagement', 'refresh');	
			}
		}
		else
		{
			redirect('admin/taskmanagement', 'refresh');	
		}	
	
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
                <a href="<?php echo base_url("admin/taskmanagement"); ?>">Task Management</a>
            </li>
			<li>
				<?php if(isset($edit_task)) { ?>
					<a href="<?php echo base_url("admin/taskmanagement/edit/{$edit_task[0]->id}"); ?>">Edit Task</a>
			    <?php } else { ?>
					<a href="<?php echo base_url("admin/taskmanagement/add"); ?>">Add Task</a>
			    <?php } ?>
			</li>
		</ul>
   </div> 
    
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <?php if(isset($edit_task)) { ?><h2><i class="glyphicon glyphicon-edit"></i>Edit Task</h2> 
                <?php } else { ?>
                <h2><i class="glyphicon glyphicon-edit"></i>Add Task</h2>
                <?php } ?> 

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="<?php echo base_url("admin/taskmanagement"); ?>" class="btn btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            
          
            <div class="box-content">
				<?php if(isset($edit_task)) { ?>
                <form role="form" method="post" name="tasklist" enctype="multipart/form-data" onSubmit="return taskform();" action="<?php echo base_url(); ?>admin/taskmanagement/update/<?php echo $edit_task[0]->id; ?>">
				<?php } else { ?>
				<form role="form" method="post" name="tasklist" enctype="multipart/form-data" onSubmit="return taskform();" action="<?php echo base_url(); ?>admin/taskmanagement/insert" >
				<?php } ?>	
					<?php
						$query = $this->db->query('select (MAX(id)+1) as id1 from tasklist') or die(mysql_error());
                            
                        $query2 = $query->result();    
					
					
					?>
					
					<input type="hidden" name="hidden_id" id="hidden_id" value="<?php echo $query2[0]->id1; ?>">
                    
                    <div class="form-group">
                        <label for="lastname">Application name <span class="required">*</span>  <a href="#" title="Add text for Application name help" data-toggle="tooltip"><i class="glyphicon glyphicon-question-sign"></i></a></label>
                        <?php if(isset($applicationname)) { echo form_input($applicationname); }  ?>						
                    </div>
                    
                    <div class="form-group">
                        <label for="lastname">Manufacturer <span class="required">*</span>  <a href="#" title="Add text for Manufacturer help" data-toggle="tooltip"><i class="glyphicon glyphicon-question-sign"></i></a></label>
                        <?php if(isset($manufacturer)) { echo form_input($manufacturer); }  ?>						
                    </div>
                    
                     <div class="form-group">
                        <label for="lastname">Version  <span class="required">*</span> <a href="#" title="Add text for Version help" data-toggle="tooltip"><i class="glyphicon glyphicon-question-sign"></i></a></label>
                        <?php if(isset($version)) { echo form_input($version); } ?>						
                    </div>
                    
                     <div class="form-group">
                        <label for="lastname">Install instructions<span class="required">*</span></label>
                        <?php if(isset($install)) {  echo form_textarea($install); } ?>						
                    </div>
                    
                                      
                     <div class="form-group">
                        <label for="lastname">Source files</label>  
                        <?php if(isset($edit_task)) 
                            { 
								if($attach['attachment'] != '')
									{
										$attached = explode(',',$attach['attachment']);
										foreach($attached as $attaches)
										{
											if(isset($attaches))
											{
											echo "<div class ='attchments'>";
											echo "<br/>";
											echo $attaches;
											
											$ext = explode('.',$attaches);
											if(isset($ext[1]))
											{
												
											echo "<br/><a href='".base_url()."upload/".$attaches."'>";
											
											if($ext[1] == "gif")
											{
											echo "<img src= '".base_url()."assets/img/file-gif.png' style='padding-left: 12px;'/>";
										    }
										    else if($ext[1] == "png")
										    {	
											echo "<img src= '".base_url()."assets/img/file-png.png' style='padding-left: 12px;'>";
										    }
										    else if($ext[1] == "jpg")
										    {
											echo "<img src= '".base_url()."assets/img/file-jpg.png' style='padding-left: 12px;'>";
											
											}
											else if($ext[1] == "docx")
											{
											echo "<img src= '".base_url()."assets/img/file-doc.png' style='padding-left: 12px;'>";
											
											}
											else if($ext[1] == "xml")
											{
											echo "<img src= '".base_url()."assets/img/file-xml.png' style='padding-left: 12px;'>";
												
											}
											else if($ext[1] == "pdf")
											{
											echo "<img src= '".base_url()."assets/img/file-xml.png' style='padding-left: 12px;'>";
												
											}
											else if($ext[1] == "zip")
											{
											echo "<img src= '".base_url()."assets/img/file-zip.png' style='padding-left: 12px;'>";
												
											}
											else if($ext[1] == "txt")
											{
											echo "<img src= '".base_url()."assets/img/file-txt.png' style='padding-left: 12px;'>";
												
											}
											else if($ext[1] == "js")
											{
											echo "<img src= '".base_url()."assets/img/file-js.png' style='padding-left: 12px;'>";
												
											}
											else if($ext[1] == "css")
											{
											echo "<img src= '".base_url()."assets/img/file-css.png' style='padding-left: 12px;'>";
												
											}
											else if($ext[1] == "php")
											{
											echo "<img src= '".base_url()."assets/img/file-php.png' style='padding-left: 12px;'>";
												
											}
											else
											{
											echo "<img src= '".base_url()."assets/img/file-edit.png' style='padding-left: 12px;'>";
												
											}
											echo "</a>";
											echo "<br/><a href='../deleteattach/{$edit_task[0]->id}/{$attaches}'>delete</a>";
										    echo "</div>";
											}
										}
										}
									}	    
                            } ?>                 
						 <?php						 
						  echo form_upload($attachment,'','multiple');   ?>    
                    </div>
                    
                    <fieldset><legend>Application Owner contact</legend>
                    <div class="form-group">
                        <label for="lastname">Name<span class="required">*</span></label>
                        <?php if(isset($aname)) {  echo form_input($aname); } ?>						
                    </div>
                    
                    <div class="form-group">
                        <label for="lastname">Phone num<span class="required">*</span></label>
                        <?php if(isset($aphone)) {  echo form_input($aphone); } ?>						
                    </div>
                    
                    <div class="form-group">
                        <label for="lastname">Email<span class="required">*</span></label>
                        <?php if(isset($aemail)) {  echo form_input($aemail); }  ?>						
                    </div>
                    </fieldset>
                    <br/>
                    <fieldset>
                    <legend>Technical Support contact</legend>
                    
                    <div class="form-group">
                        <label for="lastname">Name<span class="required">*</span></label>
                        <?php if(isset($tname)) {  echo form_input($tname); }  ?>						
                    </div>
                    
                    <div class="form-group">
                        <label for="lastname">Phone num<span class="required">*</span></label>
                        <?php if(isset($tphone)) {  echo form_input($tphone); } ?>						
                    </div>
                    
                    <div class="form-group">
                        <label for="lastname">Email<span class="required">*</span></label>
                        <?php if(isset($temail)) {  echo form_input($temail); } ?>						
                    </div>
                    </fieldset>
                    <br/>
                     <div class="form-group">
                        <label for="lastname">Business Group<span class="required">*</span></label>
                        <?php if(isset($bg)) {  echo form_input($bg); } ?>						
                    </div>
                    
                    
                    <div class="form-group">
						<label class="control-label" for="selectError">Database Connectivity<span class="required">*</span></label>
						             
						<div class="controls">																
							<?php			if(isset($database)) { 						
								$attr = 'id="database" data-rel="chosen" style="width:100%; height:40px;"';
								 echo form_dropdown('database',$database,$selected,$attr); 
							  }
							?>								   						
						</div>
					</div>
                        
                     <?php  if($user_type == 1) { ?>  
                     <div class="form-group">
						<label class="control-label" for="selectError">Packaging Engineer<span class="required">*</span></label>						             
						<div class="controls">																
							<?php		
							if(isset($assignee)) { 
								 $attr = 'id="assigne" data-rel="chosen" style="width:100%; height:40px;"';
								 echo form_dropdown('assign',$assignee,$selectedassignee,$attr); 
								}
							?>								   						
						</div>
					</div>    
					<?php } ?>
					
					
					
					<div class="form-group">
						<label class="control-label" for="selectError">Status<span class="required">*</span></label>						             
						<div class="controls">																
							<?php	if(isset($statuses)) { 
										  if($user_type == 2) 
										 {		  
											 if(isset($edit_task))
											 {
												 $attrs = 'id="status" data-rel="chosen" style="width:100%; height:40px;"';
												 echo form_dropdown('status',$statuses,$selectedstatus,$attrs); 
											 }
											 else
											 {
												 $attrs = 'id="status" data-rel="chosen" disabled="disable" style="width:100%; height:40px;"';
												 echo form_dropdown('status',$statuses,$selectedstatus,$attrs); 
											 }	 
										 }	 
										 else
										 {
											 $attrs = 'id="status" data-rel="chosen" style="width:100%; height:40px;"';
											 echo form_dropdown('status',$statuses,$selectedstatus,$attrs); 
											 
										 }
									}
							?>								   						
						</div>
					</div> 
					<div class="form-group">
                        <?php echo form_label('Add Note :');?>
                        <?php
							$data = array('name' => 'addnote','id' => 'addnote1','rows' => '4','cols' => '25','class' => 'form-control');

							echo form_textarea($data);
                
						?>						
                    </div>
                    
                        <?php  if($user_type == 2) { ?>  
					<!-- <fieldset><legend>Email</legend>
                    <div class="form-group">
                        <label for="lastname">E-mail Subject</label>
                        <input type="text" name="subject" class="form-control" required />						
                    </div>
                    
                    <div class="form-group">
                        <label for="lastname">E-mail Body</label>
                        <input type="text" name="body" class="form-control" required />						
                    </div>
                    
                    </fieldset>-->   
                     <?php } ?>             
                     <div style="display:none;">
                        <?php if(isset($timestamp)) { echo form_input($timestamp); }  ?>						
                    </div>
                    <div style="display:none;">
                        <?php if(isset($lastupdate)) { echo form_input($lastupdate); }  ?>						
                    </div>
                                    
                    <button type="submit" class="btn btn-default"><?php if(isset($edit_task)) { ?> Update <?php } else { ?>Submit<?php } ?></button>
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

