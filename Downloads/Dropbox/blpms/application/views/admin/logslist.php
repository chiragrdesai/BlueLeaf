
<?php if(isset($user_type)) { 
					if($user_type != 1 ) { 
						redirect('admin/taskmanagement', 'refresh');
					}
				}	
					?>
					
<div id="content"  class="col-lg-10 col-sm-10 logsm">
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
        <h2><i class="glyphicon glyphicon-calendar"></i> <?php echo $title ?></h2>

        <div class="box-icon">
            
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="<?php echo base_url("admin/dashboard"); ?>" class="btn btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content logs">
		
		<?php if(isset($error)) { ?>
		<?php if($error == 1){ ?>
			<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Record deleted successfully.</strong>
                </div>
		<?php }else{  ?>	
			<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Something went wrong while deleting the record.</strong>
                </div>
		<?php } } ?>
    
  <!--  
   <a class="btn btn-success" href="<?php echo base_url("admin/$filename/add"); ?>"><i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;<?php echo $addnew;  ?></a><br/><br/>
   -->
   
	<form action="<?php echo base_url("admin/$filename"); ?>" method="POST">
		<div class="row">
			<div class="col-md-4 ">    
				<div class="form-group"  style="display:inline-block;">
					<label class="control-label" for="selectError">User</label>						             
						<div class="controls">																
							<?php							
								if(isset($check_user)) {
									if($selecteduser == "")
									{
										$selecteduser = $this->session->userdata('sel_username');
									}
									$attrs = 'id="username" data-rel="chosen" onchange="this.form.submit()" style="width:100%;height:40px;"';
									echo form_dropdown('username',$check_user,$selecteduser,$attrs); 
									}
							?>								   						
						</div>
					</div>
				</div>
			<div class="col-md-4">    
			<div class="form-group">
				<label class="control-label" for="selectError">Date</label>		
					<div class="input-append date input-group controls"  >
						<?php
							$data = array(
								'type'		=>'text',
								'class'		=> 'form-control',
								'value'		=> $selecteddate,
								'name'		=> 'selectdate',
								'id'		=>'selectdate',
								'placeholder'=>'Select Date',
								'onchange'	=>'this.form.submit()',
								);
					
							echo form_input($data);
						?>
						<span class="input-group-addon add-on"><i class="glyphicon glyphicon-calendar"></i></span>
							<script type="text/javascript">
								// When the document is ready
								$(document).ready(function () {
								$('.date').datepicker({
								weekStart: 2,
								startDate: "01/12/2001",
								endDate: new Date(),
								});
							});
							</script>
					</div>
				</div>
			</div>				
		</div>       
	</form>
					
    <form method="post" id="frm1" action="<?php echo base_url("admin/$filename/multipledelete"); ?>">   
    <table class="table table-striped table-bordered bootstrap-datatable responsive examp" >
    <thead>
    <tr>
         <th>
			<div class="clearfix"></div>
			<div class="input-prepend">
			<input type="checkbox" name="all_checked"  onclick='checkedAll(frm1);'>
			</div>
		</th>
    <?php if(isset($thfirst)) { ?>    <th><?php echo $thfirst;  ?></th> <?php } ?>
    <?php if(isset($thsecond)) { ?>   <th><?php echo $thsecond;  ?></th> <?php } ?>
    <?php if(isset($ththird)) { ?>    <th><?php echo $ththird;  ?></th> <?php } ?>
    <?php if(isset($thfourth)) { ?>    <th><?php echo $thfourth;  ?></th> <?php } ?>
        <th>Actions</th>
    </tr>
    </thead>
 
    <tbody>
		<?php
		
	       
        foreach($all['tablerow'] as $row){
			
			?>

		
    <tr>
		<td>
			<div class="clearfix"></div>
			<div class="input-prepend">
			<input type="checkbox" name="check_list[]" value=" <?php echo $row->id; ?>">
			</div>
		</td>
        <td><?php echo $row->{$colfirst} ; ?></td>
      <?php if(isset($thsecond)) { ?>  <td class="center"><?php echo $row->{$colsecond} ; ?></td> <?php } ?>
       <?php if(isset($ththird)) { ?> <td class="center"><?php echo $row->{$colthird} ; ?></td>  <?php } ?>  
        <?php if(isset($thfourth)) { ?> <td class="center"><?php echo $row->{$colfourth} ; ?></td>  <?php } ?>  
       	
        <td class="center">        
         <!--   <a class="btn btn-info" href="<?php echo base_url("admin/$filename/edit/{$row->id}"); ?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a> -->
             
            <a class="btn btn-danger" style ="font-size:<?php echo $font_size[0]->variable_value; ?>px;font-family:<?php echo $site_font[0]->variable_value; ?>;" href="<?php echo base_url("admin/$filename/delete/{$row->id}"); ?>" onclick=" return ConfirmDelete();">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                
            </a>
            
        </td>
        
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
   
 

    
    
