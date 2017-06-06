<?php 
if(isset($user_type)) 
{
	
if($user_type == 1 ) {

	if(isset($edit_task[0]->id))
	{
		
	}
	else
	{
		redirect('admin/taskmanagement', 'refresh');
	}		
}
if($user_type == 2 ) {
	
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

if($user_type == 3 ) {
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
				
					<a href="<?php echo base_url("admin/taskmanagement/views/{$edit_task[0]->id}"); ?>">View Task</a>
			   
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
        <li class="active"><a data-toggle="tab" href="#sectionA">Summary</a></li>
        <li><a data-toggle="tab" href="#sectionB">Attachments</a></li>
         
        <li><a data-toggle="tab" href="#sectionC">Notes</a></li>
       
    </ul>
    <div class="tab-content">
        <div id="sectionA" class="tab-pane fade in active">
           
		<form role="form" method="post" name="tasklist" enctype="multipart/form-data"  action="<?php echo base_url(); ?>admin/taskmanagement/views/<?php echo $edit_task[0]->id; ?>">
				
					
                    
                    
                   <div class="form-group" style="background-color: #D3D3D3;">
                        <div class="row">
							<div class="col-md-4"><h5>Application Name :</h5></div>
							<div class="col-md-4"><h5><?php 
							if(isset($applicationname))
							{
								echo $applicationname ; 
							}
							?></h5></div>
							
					   </div>
                       
                    </div>
                    
                    <div class="form-group">
						<div class="row">
								<div class="col-md-4"><h5>Manufacturer :</h5></div>
								<div class="col-md-4"><h5><?php if(isset($manufacturer)){echo $manufacturer ;}?></h5></div>								
						</div>
                        
                    </div>
                    
                    <div class="form-group" style="background-color: #D3D3D3;">
						<div class="row">
								<div class="col-md-4"><h5>Version :</h5></div>
								<div class="col-md-4"><h5><?php if(isset($version))	{ echo $version ; } ?></h5></div>								
						</div>                       
                    </div>
                    
                    <div class="form-group">
						<div class="row">
								<div class="col-md-4"><h5>Install Instruction :</h5></div>
								<div class="col-md-4"><h5><?php if(isset($install))	{echo $install ; } ?></h5></div>								
						</div>
                        
                    </div>
                    
                     
                    <legend>Application Owner contact</legend>
                    <div class="form-group" style="background-color: #D3D3D3;">
						<div class="row">
								<div class="col-md-4"><h5>Name :</h5></div>
								<div class="col-md-4"><h5><?php if(isset($aname)) { echo $aname ; } ?> </h5></div>								
						</div>                      
                    </div>
                    
                    <div class="form-group">
						<div class="row">
								<div class="col-md-4"><h5>Phone num :</h5></div>
								<div class="col-md-4"><h5> <?php if(isset($aphone)) { echo $aphone ; }  ?></h5></div>								
						</div>
                         
                    </div>
                    
                    <div class="form-group" style="background-color: #D3D3D3;">
						<div class="row">
								<div class="col-md-4"><h5>Email :</h5></div>
								<div class="col-md-4"><h5> <?php if(isset($aemail)) { echo $aemail ; } 	?></h5></div>								
						</div>
                        
                    </div>
                    
                    
                    <legend>Technical Support contact</legend>
                    
                    <div class="form-group" style="background-color: #D3D3D3;">
						<div class="row">
								<div class="col-md-4"><h5>Name :</h5></div>
								<div class="col-md-4"><h5><?php echo $tname ; ?></h5></div>								
						</div>
                        
                    </div>
                    
                    <div class="form-group" >
						<div class="row">
								<div class="col-md-4"><h5>Phone num :</h5></div>
								<div class="col-md-4"><h5><?php if(isset($tphone)) { echo $tphone ; } ?></h5></div>								
						</div>
                       
                    </div>
                    
                    <div class="form-group" style="background-color: #D3D3D3;">
						<div class="row">
								<div class="col-md-4"><h5>Email :</h5></div>
								<div class="col-md-4"><h5><?php if(isset($temail))  {  echo $temail ; }  ?></h5></div>								
						</div>
                      
                    </div>
                    
                    <legend>Other</legend>
                     <div class="form-group" style="background-color: #D3D3D3;">
						 <div class="row">
								<div class="col-md-4"><h5>Business Group :</h5></div>
								<div class="col-md-4"><h5> <?php  if(isset($bg))  {  echo $bg ;  }  ?></h5></div>								
						</div>
                       
                    </div>
                   
                    
                    <div class="form-group">
						<div class="row">
								<div class="col-md-4"><h5>Database Connectivity :</h5></div>
								<div class="col-md-4"><h5> <?php if(isset($bg))  {   echo $selected ;  } ?></h5></div>								
						</div>
						
					</div>
                      <?php  if($user_type != 2)
                      { ?>
                     <div class="form-group" style="background-color: #D3D3D3;" >
						 <div class="row">
								<div class="col-md-4"><h5>Packaging Engineer :</h5></div>
								<div class="col-md-4"><h5><?php if(isset($selectedassignee)) { echo $selectedassignee ;  } ?>		</h5></div>								
						</div>
					</div>    
					<?php } ?>
					<?php if($user_type == 3) { ?> 
					 <div class="form-group">
						 
						<label class="control-label" for="selectError">Status</label>						             
						<div class="controls">																
							<?php		
							    
								 $attrs = 'id="status" data-rel="chosen" style="width:100%; height:40px;"';
								 echo form_dropdown('status',$statuses,$selectedstatus,$attrs); 
							?>								   						
						</div>
					</div>        					
					
					<?php } else { ?>
						<div class="form-group" >
							<div class="row">
								<div class="col-md-4"><h5>Status :</h5></div>
								<div class="col-md-4"><h5><?php if(isset($statusname)) { echo $statusname ; } ?></h5></div>								
						</div>
														
						</div>                   
                   <?php } ?>
                   <?php if($user_type == 3) { ?> 
						<div class="form-group" >
								<div class="row">
									<div class="col-md-4"><h5>File Upload :</h5></div>
									<div class="col-md-4"><input type="file" name="uploadimages" class="form-control"/></div>								
								</div>
						</div> 
                   <?php } ?>
                   <?php if($user_type == 3) { ?> 
						<div class="form-group" >
								<div class="row">
									<div class="col-md-4"><h5>Add Notes :</h5></div>
									<div class="col-md-4"><textarea rows="4" cols="50" name="addnote" class="form-control"></textarea></div>								
								</div>
						</div>
                   <?php } ?>
                   
                   
                     
                     <?php if($user_type == 3) { ?>               
                    <button type="submit" class="btn btn-default">Update Status</button>
                    <?php } ?>
                </form>
		</div>
        <div id="sectionB" class="tab-pane fade">
            <form action="<?php echo base_url(); ?>admin/taskmanagement/download_zip" id="sectionBform" method="post">
            <?php if($attach['attachment'] != '') { ?>
                     <div class="form-group">
                        <div class='checkattach'>
                        <input type="checkbox" id="selectall" class="btn btn-default" Value="Select All"/> 
                        </div>                        
                              <div class="selectall">Select All</div>
                        
                       
                        <?php } ?>  
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
											if($attaches != '')
											{
												echo "<div class='checkattach'>";
												echo "<input type='checkbox' class='checkbox1' name='files[]' value='".$attaches."' />";
												echo "</div>";
											}
											echo "<div class='attachview'>";
											echo "<a href='".base_url()."upload/".$attaches."'>";
											echo $attaches;
											echo "</a>";
											echo "</div>";
											
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
											echo "<img src= '".base_url()."assets/img/file-pdf.png' style='padding-left: 12px;'>";
												
											}
											else if($ext[1] == "zip")
											{
											echo "<img src= '".base_url()."assets/img/file-zip.png' style='padding-left: 12px;'>";
												
											}
											else if($ext[1] == " ")
											{
											echo "<img src= '".base_url()."assets/img/file-txt.png' style='padding-left: 12px;'>";
												
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
										//	echo "<br/><a href='../deleteattach/{$edit_task[0]->id}/{$attaches}'>delete</a>";
										    
											}
											echo "</div>";
										}
										} ?>  <div class="form-group">						   
				
										<input type="hidden" name="file_name" id="file_name" value="task_<?php echo $edit_task[0]->id ; ?>" id="firstname" placeholder="Enter Zip Folder Name"> 
				
										</div>
        
										<button type="submit" value="Download" id="download" class="btn btn-default">Download</button>
									</form>   <?php
									} 	  
									else
									{ ?>
										<legend>No Attachment Found</legend>
									<?php 	
										}  
                            } ?>    
                           <div style="display:none;">              
						 <?php						 
						 echo form_upload($attachment,'','multiple');   ?>
						 </div>    <?php if($attach['attachment'] != '') { ?> 
                    </div>  <?php }  ?>
                    
        </div>
      
			
       <div id="sectionC" class="tab-pane fade">
		 <table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Form</th>
					<th>Note</th>
					<th>created</th>
				</tr>
			</thead>
			<tbody>
		  
		   <?php
		    
			/*foreach($notes->result() as $rows)
			{
				$timestamp = strtotime($rows->timestamp);
				$php_date = date("d<\sup>S</\sup> F Y", $timestamp);
				echo "<div>";
				echo"<ul>";
				echo "<li>".$rows->note."</li>";
				foreach($getusername->result() as $row)
				{
				 echo "Added By <a href=''>".$row->username."</a></br>";
			    }
			    echo "On ".$php_date."</br>";
				echo"</ul></div>"; 
					 
			}*/
			
			//echo "<div class='row'><div class='col-md-4'>From</div><div class='col-md-4'>Note</div><div class='col-md-4'>Created</div></div>";
			foreach($notes->result() as $rows)
			{


				$timestamp = strtotime($rows->timestamp);
				$php_date = date("d<\sup>S</\sup> F Y", $timestamp);
				
				//echo"<div class='row'>";
				//echo"<ul><li class='displaynotes'></li></ul>";
				echo"<tr>";
				foreach($getusername->result() as $row)
				{					
				echo'<td class="center">'.$row->username.'</td>';
				
				echo"<td class=\"center\"><a href='#popup".$rows->id."' class='fancybox' style='display: inline-block;'>".$str=substr($rows->note, 0, 50)."</a></td>";
				echo"<td class=\"center\">".$php_date."</td>";
				echo"</tr>";
				echo "<div id='popup".$rows->id."' style='display:none;'>".$rows->note."</div>";
			}
	 
			}
			
			
  
		   ?>
		    </tbody>
		    </table>
		</div>
		 
			
    </div>

    </div>

    <!--/span-->
    <?php if($user_type == 1 || $user_type == 2 ) { ?>
   <div class="editdelete">
   <tr>
	   <td class="center">
		    
			<a class="btn btn-info" href="<?php echo base_url("admin/taskmanagement/edit/{$edit_task[0]->id}"); ?>" style ="font-size:<?php echo $font_size[0]->variable_value; ?>px;font-family:<?php echo $site_font[0]->variable_value; ?>;">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a>
            
            <a class="btn btn-danger"  href="<?php echo base_url("admin/taskmanagement/delete/{$edit_task[0]->id}"); ?>" onclick=" return ConfirmDelete();" style ="font-size:<?php echo $font_size[0]->variable_value; ?>px;font-family:<?php echo $site_font[0]->variable_value; ?>;">
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
		

		$(".fancybox").fancybox();

  </script>
  
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
