
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
				<a href="<?php echo base_url("admin/dashboard"); ?>">Home</a>
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
                <h2><i class="glyphicon glyphicon-edit"></i>Add New Task</h2>
                <?php } ?> 

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="<?php echo base_url("admin/dashboard"); ?>" class="btn btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            
          
            <div class="box-content">
				<?php if(isset($edit_task)) { ?>
                <form role="form" method="post" name="tasklist" enctype="multipart/form-data" onSubmit="return taskform();" action="<?php echo base_url(); ?>admin/taskmanagement/edit/<?php echo $edit_task[0]->id; ?>">
				<?php } else { ?>
				<form role="form" method="post" name="tasklist" enctype="multipart/form-data" onSubmit="return taskform();" action="<?php echo base_url(); ?>admin/taskmanagement/add" >
				<?php } ?>	
					
                    
                    <div class="form-group">
                        <label for="lastname">Task Title</label>
                        <?php echo form_input($tasktitle);  ?>						
                    </div>
                    
                    <div class="form-group">
                        <label for="lastname">Task Description</label>
							<?php  echo form_textarea($taskdescription);  ?>
                    </div>                     
                     <div class="form-group">
                        <label for="lastname">Attachment</label>  
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
                    <div class="form-group">
						<label class="control-label" for="selectError">Status</label>
						             
						<div class="controls">								
								
							<?php		
							
								$attr = 'id="status" data-rel="chosen" style="width:100%; height:40px;"';
								 echo form_dropdown('status',$status,$selected,$attr); 
							?>	
							   						
						</div>
					</div>
                        
                     <div class="form-group">
						<label class="control-label" for="selectError">Assignee</label>						             
						<div class="controls">																
							<?php		
								 $attr = 'id="assigne" data-rel="chosen" style="width:100%; height:40px;"';
								 echo form_dropdown('assign',$assignee,$selectedassignee,$attr); 
							?>								   						
						</div>
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

