<?php 
if(isset($user_type))
{ 
	if($user_type != 1 )
	{ 
		redirect('admin/dashboard', 'refresh');
	}
}	
?>
  
<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="<?php echo base_url("admin/taskmanagement"); ?>">Home</a></li>
			<li><a href="<?php echo base_url("admin/{$filename}"); ?>"><?php echo $title ?></a></li>
		</ul>
	</div> 
    <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
		<div class="box-header well" data-original-title="">
			<h2><i class="<?php echo $icon; ?>"></i> <?php echo $title ?></h2>
			<div class="box-icon">
				
				<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
				<a href="<?php echo base_url("admin/dashboard"); ?>" class="btn btn-round btn-default">
					<i class="glyphicon glyphicon-remove"></i>
				</a>
			</div>
		</div>
    <div class="box-content">
		<?php if(isset($error)) 
		{
			if($error == 1)
			{ ?>
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>User added successfully.</strong> 
				</div>
			<?php }
			else if($error == 2)
			{  ?>
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>User updated successfully.</strong> 
				</div>
			<?php }	
			else if($error == 3)
			{	?>
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>User Deleted successfully.</strong> 
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
		<div class="row">
			<a class="pull-right btn btn-success" style ="font-size:<?php echo $font_size[0]->variable_value; ?>px;font-family:<?php echo $site_font[0]->variable_value; ?>;" href="<?php echo base_url("admin/$filename/add"); ?>"><i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;<?php echo $addnew;  ?></a>
		</div>
		<div class="clearfix"></div>
		<div class="row">
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
					<?php if(isset($thfourth)) { ?>    <th><?php echo $thfourth;  ?></th> <?php } ?>
					<?php if(isset($thfifth)) { ?>    <th><?php echo $thfifth;  ?></th> <?php } ?>
				</tr>
			</thead>
			<tbody>
				<?php
					
					foreach($all['tablerow'] as $row){ ?>
				<tr>
					

					<td>
						
						<div class="clearfix"></div>
						<div class="input-prepend">
			
						<input type="checkbox" name="check_list[]" value=" <?php echo $row->id; ?>">
								
						</div>
					</td>
					<td><?php echo " <a href='".base_url()."admin/$filename/views/{$row->id}'>".$row->{$colfirst}."</a>" ; ; ?></td>
					<?php if(isset($thsecond)) { ?>  <td class="center"><?php echo $row->{$colsecond} ; ?></td> <?php } ?>
					<?php if(isset($ththird)) { ?> <td class="center"><?php echo $row->{$colthird} ; ?></td>  <?php } ?>  
					<?php if(isset($thfourth)) { ?> <td class="center"><?php echo $row->{$colfourth} ; ?></td>  <?php } ?>  
					<td class="center">        
						<a class="btn btn-danger" style ="font-size:<?php echo $font_size[0]->variable_value; ?>px;font-family:<?php echo $site_font[0]->variable_value; ?>;" href="<?php echo base_url("admin/$filename/delete/{$row->id}"); ?>" onclick=" return ConfirmDelete();">
						<i class="glyphicon glyphicon-trash icon-white"></i>
					
						</a>    
					</td>
				<?php }	?>
			</tbody>
		</table>	
		<button type="submit" name="delete" onclick="return validate()" class="btn btn-danger" >
		<i class="glyphicon glyphicon-trash icon-white"></i> Delete Selected</button><br>
		</form>
		<?php echo $all['pages']; ?>
		
		</div>
		
    </div>
    </div>
    </div>
    <!--/span-->

    </div><!--/row-->
</div><!-- content -->
</div><!-- row  -->
<hr>  
   
 

    
    
