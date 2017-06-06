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
				<a href="#">Home</a>
			</li>
			<li>
				<a href="#">Dashboard</a>
			</li>
		</ul>
    
    </div>
    
    <div class=" row">
    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="" class="well top-block" href="<?php echo base_url("admin/dashboard"); ?>">
            <i class="glyphicon glyphicon-home"></i>
            <div>Dashboard</div>
            <div></div>
        </a>
    </div>

    <?php if(isset($user_type)) { 
					if($user_type == 1 ) {
					?> 

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="" class="well top-block" href="<?php echo base_url("admin/adminmanagment"); ?>">
            <i class="glyphicon glyphicon-user"></i>

            <div>User Management</div>
            <div> </div>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="" class="well top-block" href="admincustomization">
            <i class="glyphicon glyphicon-globe"></i>

            <div>Admin Customization</div>
            <div></div>
        </a>
    </div>
    
    <?php } } ?> 

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="" class="well top-block" href="taskmanagement">
            <i class="glyphicon glyphicon-check"></i>

            <div>Task Management</div>
            <div></div>
   
        </a>
    </div>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> Introduction</h2>

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content row">
                <div class="col-lg-7 col-md-12">
                    <h1>admin panel <br>
                        <small>This is a fully featured admin panel to manage all the data of site.</small>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>

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
