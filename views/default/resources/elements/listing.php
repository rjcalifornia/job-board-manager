<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$site_url = elgg_get_site_url();
$blog = get_entity($vars['job']->getGUID());
$owner = get_entity($vars['owner']->getGUID());
 
 $jobType = $blog->job_type;
 $jobColor;
 switch ($jobType) {
     case 'Internship':
         $jobColor = '#a066ff';         
         break;
     
     case 'Full Time':
         $jobColor = '#2ec274';         
         break;
     
     case 'Freelance':
         $jobColor = '#46a6ff';
         break;
     
     case 'Part Time':
         $jobColor = '#ffc24d';
         break;


     default:
         $jobColor = '#9f9f9f';
         break;
 }
?>


</br>
<style>
    td
{
    padding:0 6px;
}

.divTable{
	display: table;
	
}
.divTableRow {
	display: table-row;
}
.divTableHeading {
	background-color: #EEE;
	display: table-header-group;
}
.divTableCell, .divTableHead {
	display: table-cell;
	padding: 3px 10px;
}
.divTableHeading {
	background-color: #EEE;
	display: table-header-group;
	font-weight: bold;
}
.divTableFoot {
	background-color: #EEE;
	display: table-footer-group;
	font-weight: bold;
}
.divTableBody {
	display: table-row-group;
}
</style>

<table >
<tbody>
<tr>
<td rowspan="2"><img src="<?php echo $owner->getIconURL('small');?>"></td>
<td>
        <h3 class="elgg-listing-summary-title">
            <a href="<?php echo $blog->getURL(); ?>"><?php echo $blog->title ?> </a>
        </h3>
   </td>
</tr>
<tr>
<td>
    
    <ul class="elgg-tags">
			
			<li class="elgg-tag">
                            <a href="<?php echo $site_url ?>search?q=<?php echo $blog->company_name ?>&search_type=all"
                               rel="tag" value="<?php echo $blog->company_name ?>">
                                <?php echo $blog->company_name ?>
                            </a>
                        </li>
		</ul>
    </td>
</tr>
</tbody>
</table>
 

    
    <div class="divTable">
<div class="divTableBody">
<div class="divTableRow">
    
    <div class="divTableCell">
        <div style="background: <?php echo $jobColor;?> !important; margin: 0 5px 5px 0; padding: 8px 10px; border-radius: 3px; color: white; font-weight: 400;">
        <span class="fa elgg-icon-briefcase fa-briefcase">
            
        </span> <?php echo $blog->job_type ?>
            </div>
    </div>
    
<div class="divTableCell">
    <span class="elgg-icon fa elgg-icon-location fa-location-arrow"></span> <?php echo $blog->company_location ?></div>
<div class="divTableCell"><span class="elgg-icon fa elgg-icon-users fa-users"></span> Vacancies: <?php echo $blog->total_openings ?></div>
<div class="divTableCell"><span class="elgg-icon fa elgg-icon-bank fa-bank"></span> <?php echo $blog->salary_currency ?><?php echo $blog->fixed_salary ?></div>
<div class="divTableCell">&nbsp;</div>
</div>
</div>
</div>
    
    </br>