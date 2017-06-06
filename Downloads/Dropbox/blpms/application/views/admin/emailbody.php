<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
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
                    <strong>Data updated successfully.</strong><?php //echo $filename ;?>.
                </div>
		<?php }else{  ?>	
			<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Something went wrong. Please try again.</strong><?php //echo $filename ; ?>.
                </div>
		<?php } } ?>
		
    <form role="form" method="post" name="email" enctype="multipart/form-data"  action="<?php echo base_url(); ?>admin/emailmanagement/update" >
    
					<?php
						
						foreach($client->result() as $rows)
						{
					?>
    
                    <fieldset><legend>To client</legend>
                    <div class="form-group">
                        <?php echo form_label('Subject ');?><span class="required">*</span>:
                        <?php echo form_input(array('id' => 'csubject', 'name' => 'c_subject', 'class' => 'form-control', 'value'=> $rows->subject )); ?>						
                    </div>
                    
                    <div class="form-group">
                        <?php echo form_label('Body ');?><span class="required">*</span>:
                        <?php
							$data = array('name' => 'c_body','id' => 'cbody','rows' => '4','cols' => '25','class' => 'form-control','value'=> $rows->body );

							echo form_textarea($data);
                
						?>						
                    </div>
                    
                    </fieldset>
                    <?php
						}
                    ?>
                    <?php
						
						foreach($worker->result() as $rows)
						{
					?>
					<fieldset><legend>To worker</legend>
                    <div class="form-group">
                        <?php echo form_label('Subject ');?><span class="required">*</span>:
                        <?php echo form_input(array('id' => 'wsubject', 'name' => 'w_subject', 'class' => 'form-control','value'=> $rows->subject )); ?>						
                    </div>
                    
                    <div class="form-group">
                        <?php echo form_label('Body ');?><span class="required">*</span>:
                        <?php
							$data = array('name' => 'w_body','id' => 'wbody','rows' => '4','cols' => '25','class' => 'form-control','value'=> $rows->body );

							echo form_textarea($data);
                
						?>						
                    </div>
                    
                    </fieldset>
                    <?php
					}
					?>
					<?php
						
						foreach($admin->result() as $rows)
						{
					?>
					
                    <fieldset><legend>To admin</legend>
                    <div class="form-group">
                        <?php echo form_label('Subject ');?><span class="required">*</span>:
                        <?php echo form_input(array('id' => 'asubject', 'name' => 'a_subject', 'class' => 'form-control','value'=> $rows->subject )); ?>						
                    </div>
                    
                    <div class="form-group">
                        <?php echo form_label('Body ');?><span class="required">*</span>:
                        <?php
							$data = array('name' => 'a_body','id' => 'abody','rows' => '4','cols' => '25','class' => 'form-control','value'=> $rows->body );

							echo form_textarea($data);
                
						?>							
                    </div>
                    
                    </fieldset>
                    <?php
					}
					?>
                   
                    <br>
                     <p>Available Variables: %USERNAME% , %TASK_NAME% , %OLD_STATUS , %NEW_STATUS% , %ADD_NOTE%</p>
                    <br>
                    <?php echo form_submit(array('id' => 'submit', 'value' => 'Submit', 'class' => 'btn btn-default', 'onclick' => 'return validation()'  )); ?>
               
                    
      </form>

    </div>
    </div>
    </div>
    <!--/span-->

    </div><!--/row-->
</div><!-- content -->
</div><!-- row  -->
<hr>  
 <script>
	
	function validation(){
	var csubject = document.forms["email"]["c_subject"].value;		
	var cbody = document.forms["email"]["c_body"].value;		
	var asubject = document.forms["email"]["a_subject"].value;
	var abody = document.forms["email"]["a_body"].value;		
	var wsubject = document.forms["email"]["w_subject"].value;		
	var wbody = document.forms["email"]["w_body"].value;		
	
	if(csubject == null||csubject=="")
	{
		alert('Subject is required ');
		document.getElementById("csubject").focus();
		return false;
	}
	if(cbody == null||cbody=="")
	{
		alert('Please insert some data in Body');
		document.getElementById("cbody").focus();
		return false;
	}
	if(asubject == null||asubject=="")
	{
		alert('Subject is required');
		document.getElementById("asubject").focus();
		return false;
		
	}
	if(abody == null||abody=="")
	{
		alert('Please insert some data in Body');
		document.getElementById("abody").focus();
		return false;
	}
	
	if(wsubject == null||wsubject=="")
	{
		alert('Subject is required');
		document.getElementById("wsubject").focus();
		return false;
	}
	if(wbody == null||wbody=="")
	{
		alert('Please insert some data in Body');
		document.getElementById("wbody").focus();
		return false;
	}	
}
	
 
 </script>
 
    
    
