</div>
<footer class="row">
        <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <?php if(isset($showsitename[0]->variable_value)) { echo $showsitename[0]->variable_value; } else { echo "TriCore InfoTech"; } ?>  <?php echo Date("Y"); ?> - <?php echo Date("Y") + 1; ?></p>

    <!--    <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Developed by: <a
                href="http://usman.it/free-responsive-admin-template">TriCore InfoTech Pvt Ltd</a></p> -->
    </footer>

<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- library for cookie management -->
<script src="<?php echo base_url(); ?>assets/js/jquery.cookie.js"></script>
<!-- calender plugin -->
<script src='<?php echo base_url(); ?>assets/bower_components/moment/min/moment.min.js'></script>
<script src='<?php echo base_url(); ?>assets/bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
<!-- data table plugin -->
<script src='<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js'></script>
<!-- select or dropdown enhancer -->
<script src="<?php echo base_url(); ?>assets/bower_components/chosen/chosen.jquery.min.js"></script>
<!-- plugin for gallery image view -->
<script src="<?php echo base_url(); ?>assets/bower_components/colorbox/jquery.colorbox-min.js"></script>
<!-- notification plugin -->
<script src="<?php echo base_url(); ?>assets/js/jquery.noty.js"></script>
<!-- library for making tables responsive -->
<script src="<?php echo base_url(); ?>assets/bower_components/responsive-tables/responsive-tables.js"></script>
<!-- tour plugin -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<!-- star rating plugin -->
<script src="<?php echo base_url(); ?>assets/js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="<?php echo base_url(); ?>assets/js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="<?php echo base_url(); ?>assets/js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="<?php echo base_url(); ?>assets/js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="<?php echo base_url(); ?>assets/js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="<?php echo base_url(); ?>assets/js/charisma.js"></script>



<script src="<?php echo base_url(); ?>assets/js/colpick.js"></script>




<script>
$('.picker').colpick({
	layout:'hex',
	submit:0,
	colorScheme:'dark',
	onChange:function(hsb,hex,rgb,el,bySetColor) {
		$(el).css('border-color','#'+hex);
		// Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
		if(!bySetColor) $(el).val('#'+hex);
	}
}).keyup(function(){
	$(this).colpickSetColor(this.value);
});

$("#varname").each(function () {
	    $(".picker").css('display','none'); 
	    var end1 = this.value;
	    if(end1 == 'header_bar_color' || end1 == 'hyperlinks')
        {
			$(".picker").css('display','block');
			$("#picker1").css('display','none');
        }
        
        $("#varname").change(function ()
        {
        var end = this.value;
        
        if(end == 'header_bar_color' || end == 'hyperlinks')
        {
			$(".picker").css('display','block');
			$("#picker1").css('display','none');
        }
        else
        {
			$(".picker").css('display','none');
			$("#picker1").css('display','block');
		}
	});
                 
   });     



function ConfirmDelete()
{   
  if (confirm("Are you sure want to delete item ?"))
      return true;
  else
    return false;
}

function validate()
       {
           var chks = document.getElementsByName('check_list[]');
           var hasChecked = false;
           for (var i = 0; i < chks.length; i++)
           {
             if (chks[i].checked)
             {
                 hasChecked = true;
                 break;
             }
           }
           if (hasChecked == false)
           {
               alert("No item selected.");
               return false;
           }
           else
           {
			   if(confirm("Are you sure  want to delete selected items?"))
				{
				//window.location.href='deletemessage.php';
				return true;
				}
				else
				{
					var aa= document.getElementById('frm1');
					for (var i =0; i < aa.elements.length; i++)
					{ aa.elements[i].checked =false;}	
				//window.location.href='usermanagement';
				return false;
				}
		   }
		}
		checked=false;
	function checkedAll (frm1) {var aa= document.getElementById('frm1'); if (checked == false)
		{
			checked = true
		}
		else
		{
			checked = false
		}for (var i =0; i < aa.elements.length; i++)
		{ aa.elements[i].checked = checked;}
	}

</script>




</body>
</html>
