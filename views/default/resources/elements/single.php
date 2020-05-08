<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$site_url = elgg_get_site_url();
$job = get_entity($vars['job']->getGUID());
$owner = get_entity($vars['owner']->getGUID());

$jobColor;
$jobDescription;

$jobType = $job->job_type;
 
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
 
 
 $jobDescription = elgg_view('output/longtext', array(
		'value' => $job->description,
		'class' => 'blog-post',
	));
 
  if ($job->status == 'published'){
      $jobStatus = 'Open';
      
      }
      
?>


<?php
echo elgg_view('job-board-manager/single_css');
?>

<div class="divTable">
<div class="divTableBody">
<div class="divTableRow">
    
    
    
<div class="divTableCell">
    <span class="elgg-icon job-elgg-icon fa elgg-icon-location fa-location-arrow"></span> <?php echo $job->company_location ?></div>
<div class="divTableCell"><span class="elgg-icon job-elgg-icon fa elgg-icon-users fa-users"></span> Vacancies: <?php echo $job->total_openings ?></div>
<div class="divTableCell"><span class="elgg-icon job-elgg-icon fa elgg-icon-bank fa-bank"></span> <?php echo $job->salary_currency ?><?php echo $job->fixed_salary ?></div>
<div class="divTableCell">&nbsp;</div>
</div>
</div>
</div>

<?php 
echo $jobDescription;

?>

<h1 class="elgg-listing-summary-title-company">
<?php 
echo elgg_echo('job:board:about_company');

?>
</h1>
<div class="listing-company-info">
<table >
<tbody>
<tr>
<td rowspan="3"><img src="<?php echo $owner->getIconURL('small');?>"></td>
<td>
        <h2 class="elgg-listing-summary-title">
           <span class="company-name"> <?php echo $job->company_name ?></span>
        </h2>
   </td>
</tr>
<tr>
<td>
    
    <ul class="elgg-tags">
			
			<li class="elgg-tag">
                            <span class="job-elgg-icon fa elgg-icon-location fa-location-arrow"></span>
                                <?php echo $job->company_address ?>
                            
                        </li>
                        
		</ul>
    </td>
    
</tr>
<tr>
<td>
    
    <ul class="elgg-tags">
			
			<li class="elgg-tag">
                            <span class="job-elgg-icon fa elgg-icon-external-link fa-globe"></span>
                            <a href="<?php echo $job->company_website ?>"
                               rel="tag" value="<?php echo $job->company_website ?>">
                                <?php echo $job->company_website ?>
                            </a>
                        </li>
                        
		</ul>
    </td>
    
</tr>
</tbody>
</table>
    </div>

<h1 class="elgg-listing-summary-title-company">
<?php 
echo elgg_echo('job:board:about_job');

?>
</h1>

<div class="about-job">
<div class="div-about-table">
<div class="div-about-row">
<div class="div-about-cell">
    <span class="job-elgg-icon fa elgg-icon-hourglass fa-hourglass-1"></span>
    <?php echo elgg_echo('job:board:status');?>: <?php echo $jobStatus;?>
</div>
<div class="div-about-cell">
    <span class="job-elgg-icon fa elgg-icon-users fa-user-plus"></span>
    <?php echo elgg_echo('job:board:total_openings');?>: <?php echo $job->total_openings;?>
</div>
</div>
<div class="div-about-row">
<div class="div-about-cell">
    <span class="job-elgg-icon fa elgg-icon-briefcase fa-briefcase"></span>
    <?php echo elgg_echo('job:board:type');?>: <?php echo $job->job_type;?>
</div>
<div class="div-about-cell">
    <span class="job-elgg-icon fa elgg-icon-users fa-users"></span>
    <?php echo elgg_echo('job:board:level');?>: <?php echo $job->job_level;?>
</div>
</div>
<div class="div-about-row">
<div class="div-about-cell">
    <span class="job-elgg-icon fa elgg-icon-bullseye fa-bullseye"></span>
    <?php echo elgg_echo('job:board:years_experience');?>: <?php echo $job->years_experience;?>
</div>
<div class="div-about-cell">
    <span class="job-elgg-icon fa elgg-icon-bank fa-bank"></span>
    <?php echo elgg_echo('job:board:fixed');?>: <?php echo $job->salary_currency;?><?php echo $job->fixed_salary;?>
</div>
</div>
<div class="div-about-row">
<div class="div-about-cell">
    <span class="job-elgg-icon fa elgg-icon-calendar fa-calendar-o"></span>
    <?php echo elgg_echo('job:board:published');?>: <?php 
    echo date(("F j, Y"), $job->time_created);
    //echo $job->time_created;
    
    ?>
</div>
<div class="div-about-cell">&nbsp;</div>
</div>
</div>
</div>  
 


<?php

$current_user = elgg_get_logged_in_user_guid();
if($current_user != $job->owner_guid)
    {
        $vars['entity'] = $job;
        $form_vars = array('enctype' => 'multipart/form-data');

        echo elgg_view_form('job-board-manager/candidate', $form_vars, $vars);
    }
    
if($current_user == $job->owner_guid)
    {
        echo elgg_view('resources/elements/submissions', array(
            'job' => $job,
        ));
    }





?>