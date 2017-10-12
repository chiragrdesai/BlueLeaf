
<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="<?php echo base_url("admin/taskmanagement"); ?>">Home</a></li>
			<li><a href="<?php echo base_url("admin/{$filename}"); ?>"><?php echo $title ?></a></li>
		</ul>
	</div> 
    
    <div class="row">
    <div class="box col-md-16">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="<?php echo $icon; ?>"></i> <?php echo $title ?></h2>

        <div class="box-icon">
            
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="<?php echo base_url("admin/taskmanagement"); ?>" class="btn btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <?php if($user_type == 3)
    { ?>
		<div class="box-content worker">
	<?php } else { ?>
		<div class="box-content task">
	<?php }	?>
		
		<?php if(isset($error)) 
		{
			if($error == 1)
			{ ?>
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Task added successfully.</strong> 
				</div>
			<?php }
			else if($error == 2)
			{  ?>
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Task updated successfully.</strong> 
				</div>
			<?php }	
			else if($error == 3)
			{	?>
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Task Deleted successfully.</strong> 
				</div>
			<?php }
			else
			{	?>
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Something went wrong. Please try again.</strong> 
				</div>
			<?php }
		} ?>
			   <form action="<?php echo base_url("admin/$filename/statusaction"); ?>" method="POST">
					<div class="row">
					    <div class="col-md-4 task_status">    
							<div class="form-group"  style="display:inline-block;">
								<label class="control-label" for="selectError">Status</label>						             
								<div class="controls">																
									<?php	
									if(isset($statuses)) {
										 $attrs = 'id="status" data-rel="chosen" onchange="this.form.submit()" style="width:100%;height:40px;"';
										 echo form_dropdown('status',$statuses,$selectedstatus,$attrs); 
									 }
									?>								   						
								</div>
							</div>
						</div>       
						 <?php if($user_type == 1) {  ?> 
						 <div class="col-md-4 task_packaging"> 
							<div class="form-group" style="display:inline-block;">
								<label class="control-label" for="selectError">Packaging Engineer</label>						             
								<div class="controls">																
									<?php		
									if(isset($assignee)) {
										 $attr = 'id="assigne"  data-rel="chosen" onchange="this.form.submit()" style="width:100%;height:40px;"';
										 echo form_dropdown('assign',$assignee,$selectedassignee,$attr); 
										} 
									?>								   						
								</div>
							</div> 
						</div>
					
					<?php } ?>
					</div>  
				</form>	
    <?php if($user_type != 3) {  ?>
    
   <a class="btn btn-success" style ="font-size:<?php echo $font_size[0]->variable_value; ?>px;font-family:<?php echo $site_font[0]->variable_value; ?>;" href="<?php echo base_url("admin/$filename/add"); ?>"><i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;<?php echo $addnew;  ?></a>
  
   <?php } ?>
     <form method="post" id="frm1" action="<?php echo base_url("admin/$filename/multipledelete"); ?>">
    <table class="table table-striped table-bordered bootstrap-datatable responsive">
    <thead>
    <tr>
        <th>
			<div class="clearfix"></div>
			<div class="input-prepend">
			<input type="checkbox" name="all_checked"  onclick='checkedAll(frm1);'>
			</div>
		</th>
        <th><?php echo $thfirst;  ?></th>
    <?php if(isset($thsecond)) { ?>   <th><?php echo $thsecond;  ?></th> <?php } ?>
    <?php if(isset($ththird)) { ?>    <th><?php echo $ththird;  ?></th> <?php } ?>
     <?php if(isset($thfourth)) { ?>   <th><?php echo $thfourth;  ?></th> <?php } ?>
    <?php if(isset($thfifth)) { ?>    <th ><?php echo $thfifth;  ?></th> <?php } ?>
     <?php if(isset($thsixth)) { ?>   <th><?php echo $thsixth;  ?></th> <?php } ?>
     <?php if($user_type != 2) { ?>
    <?php if(isset($thseventh)) { ?>    <th style="width:10%;"><?php echo $thseventh;  ?></th> <?php }  ?>
     <?php } ?>
     <?php if(isset($theighth)) { ?>   <th><?php echo $theighth;  ?></th> <?php } ?>
    
        <th>Actions</th>  
    </tr>
    </thead>
 
    <tbody>
		<?php
		
	       
        foreach($tablerow as $row){
			
			?>

		
    <tr>
		<td>
			<div class="clearfix"></div>
			<div class="input-prepend">		
			<input type="checkbox" name="check_list[]" value=" <?php echo $row->id; ?>">
			</div>
		</td>
        <td><?php echo " <a href='".base_url()."admin/$filename/views/{$row->id}'>".$row->{$colfirst}."</a>" ; ?></td>
      <?php if(isset($thsecond)) { ?>  <td class="center"><?php echo $row->{$colsecond} ; ?></td> <?php } ?>
       <?php if(isset($ththird)) { ?> <td class="center"><?php echo $row->{$colthird} ; ?></td>  <?php } ?>  
        <?php if(isset($thfourth)) { ?>  <td class="center"><?php echo $row->{$colfourth} ; ?></td> <?php } ?>
       <?php if(isset($thfifth)) { ?> <td class="center" ><?php echo $row->{$colfifth} ; ?></td>  <?php } ?>  
        <?php if(isset($thsixth)) { ?>  <td class="center"><?php echo $row->{$colsixth} ; ?></td> <?php } ?>
       <?php if(isset($thseventh)) { ?> <td class="center" style="width:10%"><?php echo $row->{$colseventh} ; ?></td>  <?php } ?>  
        <?php if(isset($theighth)) { ?>  <td class="center"><?php echo $row->{$coleighth} ; ?></td> <?php } ?>
		<td class="center">            
            <a class="btn btn-danger"  href="<?php echo base_url("admin/$filename/delete/{$row->id}"); ?>" onclick=" return ConfirmDelete();">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                
            </a>
            
        </td>
      
      
      
    <!--    <td class="center">   
            <?php if($user_type != 3) {  ?>      
      <!--      <a class="btn btn-info" href="<?php echo base_url("admin/$filename/edit/{$row->id}"); ?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a>
            
            <a class="btn btn-danger"  href="<?php echo base_url("admin/$filename/delete/{$row->id}"); ?>">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                Delete
            </a> -->
            <?php  } ?>
            
        <!--    <a class="btn btn-info" href="<?php echo base_url("admin/$filename/views/{$row->id}"); ?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                View
            </a>  -->
           
      <!--  </td> -->
    </tr>
        <?php
	}
        ?>
        
    </tbody>
    </table>
		<button type="submit" name="delete" onclick="return validate()" class="btn btn-danger" >
		<i class="glyphicon glyphicon-trash icon-white"></i> Delete Selected</button><br>
   </form>
    <?php echo $all['pages']; ?>
    
    </div>
    </div>
    </div>
    <!--/span-->

    </div><!--/row-->
</div><!-- content -->
</div><!-- row  -->
<hr>  
   
 

    
    
