<?php
    header("Content-type: text/css; charset: UTF-8");

   $query = $this->db->query('select variable_value from variables where variable_name = "hyperlinks" ') or die(mysql_error());
   $result = $query->result(); 
   
 ?>
tr>td>a {color :<?php echo $result[0]->variable_value ; ?> !important ;} 

.attachview a
{
	position :relative ;
	top:0px !important ;
	color :<?php echo $result[0]->variable_value ; ?> !important ;
}
