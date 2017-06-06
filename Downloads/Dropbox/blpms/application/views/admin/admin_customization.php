<?php if(isset($user_type)) 
{ 
	if($user_type != 1 ) 
	{ 
		redirect('admin/dashboard','refresh');
	}
}
//print_r($variable_data);
?>
<!DOCTYPE html>
<html>
<head>
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/validate.js'></script> 
	<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
</head>
<body>
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
                    <strong>Data updated successfully.</strong>
                </div>
		<?php } 
			else if($error == 2)
			{ ?>
				<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong><?php echo form_error('admin_email'),form_error('sender_email_address'),form_error('smtp_port'),form_error('header_bar_color'),form_error('hyperlinks'); ?></strong>
                </div>
		<?php }
		} ?>

		<?php
		$attributes = array('name' => 'admin_cust', 'id' => 'form', 'onsubmit' => 'return admin_customization()');
		echo form_open('admin/admincustomization_new',$attributes);?>
		<div class="form-group">
            <?php echo form_label('Admin Email','admin_email'); ?><span class="required">*</span>
			<?php echo form_input(array('class' => 'form-control','name' => 'admin_email','placeholder' => 'Admin Email',
			'id' => 'admin_email','value' => $variable_data['admin_email'])); ?>
		</div>
		
		<div class="form-group">
            <?php echo form_label('Favicon','favicon'); ?>
			<?php echo form_input(array('class' => 'form-control', 'name' => 'favicon','placeholder' => 'Favicon',
			'id' => 'favicon','value' => $variable_data['favicon'])); ?>
		</div>
		
		<div class="form-group">
            <?php echo form_label('Font Size','font_size'); ?>
			<?php echo form_input(array('class' => 'form-control', 'name' => 'font_size','placeholder' => 'Font Size',
			'id' => 'font_size','value' => $variable_data['font_size'])); ?>
		</div>
		
		<div class="form-group">
            <?php echo form_label('Header Bar Color','header_bar_color');?>
			<?php echo form_input(array('class' => 'form-control picker', 'name' => 'header_bar_color','placeholder' => 'Header Bar Color','id' => 'header_bar_color','value' => $variable_data['header_bar_color']));?>
		</div>
		
		<div class="form-group">
            <?php echo form_label('Hyperlinks Color','hyperlinks'); ?>
			<?php echo form_input(array('class' => 'form-control picker', 'name' => 'hyperlinks','placeholder' => 'Hyperlinks Color','id' => 'hyperlinks','value' => $variable_data['hyperlinks'])); ?>
		</div>
		
		<div class="form-group">
            <?php echo form_label('Logo','logo'); ?>
			<?php echo form_input(array('class' => 'form-control', 'name' => 'logo','placeholder' => 'Logo',
			'id' => 'logo','value' => $variable_data['logo'])); ?>
		</div>
		
		<div class="form-group">
			<?php echo form_label('Site Font','site_font'); ?>
			<?php echo form_input(array('class' => 'form-control', 'name' => 'site_font','placeholder' => 'Site Font',
			'id' => 'site_font','value' => $variable_data['site_font'])); ?>
		</div>
		
		<div class="form-group">
			<?php echo form_label('Site Name','site_name'); ?>
			<?php echo form_input(array('class' => 'form-control', 'name' => 'site_name','placeholder' => 'Site Name',
			'id' => 'site_name','value' => $variable_data['site_name'])); ?>
		</div>
		
		<div class="form-group">
            <?php echo form_label('Site Title','site_title'); ?>
			<?php echo form_input(array('class' => 'form-control', 'name' => 'site_title','placeholder' => 'Site Title',
			'id' => 'site_title','value' => $variable_data['site_title'])); ?>
		</div>

		<div class="form-group">
            <?php echo form_label('SMTP Server','smtp_server'); ?>
			<?php echo form_input(array('class' => 'form-control', 'name' => 'smtp_server','placeholder' => 'SMTP Server',
			'id' => 'smtp_server','value' => $variable_data['smtp_server'])); ?>
		</div>		

		<div class="form-group">
            <?php echo form_label('SMTP Port','smtp_port'); ?>
			<?php echo form_input(array('class' => 'form-control', 'name' => 'smtp_port','placeholder' => 'SMTP Port',
			'id' => 'smtp_port','value' => $variable_data['smtp_port'])); ?>
		</div>
		
		<div class="form-group">
            <?php echo form_label('Sender Email Address','sender_email_address'); ?><span class="required">*</span>
			<?php echo form_input(array('class' => 'form-control', 'name' => 'sender_email_address','placeholder' => 'Sender Email Address','id' => 'sender_email_address','value' => $variable_data['sender_email_address'])); ?>
		</div>
		
		<div class="form-group">
            <?php echo form_label('Records per page','records_per_page'); ?>
			<?php echo form_input(array('class' => 'form-control', 'name' => 'records_per_page','placeholder' => 'Records per page',
			'id' => 'records_per_page','value' => $variable_data['records_per_page'])); ?>
		</div>
		
		<?php
			echo form_submit(array('name' => 'update', 'value' => 'Update','class' => 'btn btn-default'));
			echo form_close();
		?>
    </div>
    </div>
    </div>
    </div>
</div>
</div>
<hr>  
</body>
</html>
