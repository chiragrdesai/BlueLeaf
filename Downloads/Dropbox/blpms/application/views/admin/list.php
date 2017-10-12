
<?php if(isset($user_type)) { 
					if($user_type != 1 ) { 
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
            
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="<?php echo base_url("admin/dashboard"); ?>" class="btn btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content other">
		
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
    
   
   <a class="btn btn-success"  style ="font-size:<?php echo $font_size[0]->variable_value; ?>px;font-family:<?php echo $site_font[0]->variable_value; ?>;" href="<?php echo base_url("admin/$filename/add"); ?>"><i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;<?php echo $addnew;  ?></a><br/><br/>
   
    
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        
        <th><?php echo $thfirst;  ?></th>
    <?php if(isset($thsecond)) { ?>   <th><?php echo $thsecond;  ?></th> <?php } ?>
    <?php if(isset($ththird)) { ?>    <th><?php echo $ththird;  ?></th> <?php } ?>
    <?php if(isset($thfourth)) { ?>    <th><?php echo $thfourth;  ?></th> <?php } ?>
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
        <?php if(isset($thfourth)) { ?> <td class="center"><?php echo $row->{$colfourth} ; ?></td>  <?php } ?>  
        <td class="center"> 
        	       
            <a class="btn btn-info" href="<?php echo base_url("admin/$filename/edit/{$row->id}"); ?>" style="font-size:<?php echo $font_size[0]->variable_value; ?>px;font-family:<?php echo $site_font[0]->variable_value; ?>;">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a>
            <a class="btn btn-danger"  href="<?php echo base_url("admin/$filename/delete/{$row->id}"); ?> " onclick=" return ConfirmDelete();" style = "font-size:<?php echo $font_size[0]->variable_value; ?>px;font-family:<?php echo $site_font[0]->variable_value; ?>;">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                Delete
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
   
 

    
    
