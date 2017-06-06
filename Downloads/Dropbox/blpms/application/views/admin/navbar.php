<?php if(isset($showheadercolor[0]->variable_value))
			{  ?>	
<div class="navbar navbar-default" role="navigation" style="background-color:<?php echo $showheadercolor[0]->variable_value ;?>;border-color:<?php echo $showheadercolor[0]->variable_value ; ?>;">
  <?php } else { ?>
  <div class="navbar navbar-default" role="navigation">
 <?php } ?>
        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
			<?php if(isset($showlogo[0]->variable_value))
			{	?>
			   <a class="navbar-brand" href="<?php echo base_url(); ?>admin/taskmanagement"> 
					<span>
			       <img src="<?php echo base_url(); ?><?php echo $showlogo[0]->variable_value;   ?>">
			    </span>  </a>   
            <?php } 
             elseif(isset($showtitle[0]->variable_value)) { ?> 
			   <a class="navbar-brand" href="<?php echo base_url(); ?>admin/taskmanagement" style="padding:15px;"> 
                  <span> <?php
					 echo $showtitle[0]->variable_value." admin panel"; 
					 ?> </span>  </a> <?php
             } 
             else { ?>
             <a class="navbar-brand" href="<?php echo base_url(); ?>admin/taskmanagement" style="padding:15px;"> 
                  <span>
             <?php echo "Your Admin Panel"; ?> </span></a> <?php  } 
                 
             ?>
            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> <?php echo $username; ?></span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    
                    <li><a href="<?=base_url();?>admin/profile/edit/1">Edit My Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="<?=base_url();?>admin/logout">Logout</a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->


          <!--  <ul class="collapse navbar-collapse nav navbar-nav top-menu">
                <li><a href="#" target="_blank"><i class="glyphicon glyphicon-globe"></i> Visit Site</a></li>
            </ul> -->

        </div>
    </div>
