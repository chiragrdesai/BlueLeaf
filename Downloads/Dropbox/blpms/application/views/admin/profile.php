<?php 
if ((time() - $this->session->userdata('EXPIRES')) > 7200 ) 
	{
		$this->session->sess_destroy();
		redirect(base_url('admin/c_login'), 'refresh');
	}
		
       //$this->session->userdata('EXPIRES') 
?>

<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="<?php echo base_url("admin/dashboard"); ?>">Home</a></li>
			<li><a href="<?php echo base_url("admin/{$filename}"); ?>"><?php echo $title ?></a></li>
		</ul>
	</div> 
    
    <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="<?php echo $icon; ?>"></i> <?php echo $title ?></h2>

        <div class="box-icon">
            
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="<?php echo base_url("admin/dashboard"); ?>" class="btn btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
	
	<?php if(isset($error)) 
	{
		if($error == 1)
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
    
    <table class="table table-striped table-bordered bootstrap-datatable  responsive">
    <thead>
    <tr>
        
        <th><?php echo $thfirst;  ?></th>
    <?php if(isset($thsecond)) { ?>   <th><?php echo $thsecond;  ?></th> <?php } ?>
    <?php if(isset($ththird)) { ?>    <th><?php echo $ththird;  ?></th> <?php } ?>
        <th>Actions</th>
    </tr>
    </thead>
 
    <tbody>
		<?php
		
	       
        foreach($tablerow as $row){
			
			?>

		
    <tr>
        <td><?php echo $row->{$colfirst} ; ?></td>
      <?php if(isset($thsecond)) { ?>  <td class="center"><?php echo $row->{$colsecond} ; ?></td> <?php } ?>
       <?php if(isset($ththird)) { ?> <td class="center"><?php echo $row->{$colthird} ; ?></td>  <?php } ?>  
        <td class="center">        
            <a class="btn btn-info" href="<?php echo base_url("admin/$filename/edit/{$row->id}"); ?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a>
           
        </td>
    </tr>
        <?php
	}
        ?>
        
    </tbody>
    </table>
    </div>
    </div>
    </div>
    <!--/span-->

    </div><!--/row-->
</div><!-- content -->
</div><!-- row  -->
<hr>  
    
 

    
    
