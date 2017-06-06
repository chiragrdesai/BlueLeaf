<div class="col-sm-2 col-lg-2">
	<div class="sidebar-nav">
		<div class="nav-canvas">
			<div class="nav-sm nav nav-stacked"></div>
			<ul class="nav nav-pills nav-stacked main-menu">
				<li class="nav-header">Main</li>
			<!--	<li><a class="ajax-link" href="<?=base_url();?>admin/dashboard"><i class="glyphicon glyphicon-home"></i><span> Dashboard</span></a></li> -->
				<?php if(isset($user_type)) { 
					if($user_type == 1 ) {
					?>
				<li><a class="" href="<?=base_url();?>admin/usermanagement"><i class="glyphicon glyphicon-user"></i><span> User Management</span></a></li>
				<li><a class="" href="<?=base_url();?>admin/admincustomization_new"><i class="glyphicon glyphicon-globe"></i><span> Admin Customization</span></a></li>
			    <li><a class="" href="<?=base_url();?>admin/logsmanagement"><i class="glyphicon glyphicon-calendar"></i><span> Activity Log</span></a></li>
			   <li><a class="" href="<?=base_url();?>admin/emailmanagement"><i class="glyphicon glyphicon-envelope"></i><span> Email Management</span></a></li>
			    <?php } } ?> 
				<li><a class="" href="<?=base_url();?>admin/taskmanagement"><i class="glyphicon glyphicon-check"></i><span> Task Management</span></a></li>			    
				
			</ul>
		</div>
	</div>
</div>
<script>
	jQuery("a").each(function() {
   var $li = jQuery(this);
   $li.css("color", "<?php $this->db->select("variable_value");
		$this->db->from('variables');
		$this->db->WHERE('id',187);
		$query = $this->db->get();
		$value = $query->row()->variable_value;

		echo $value;
		?>");       
	});
</script>
