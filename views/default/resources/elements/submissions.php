<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$job = get_entity($vars['job']->getGUID());
$options = array(
		'type' => 'object',
		'subtype' => 'job-candidates',
		'container_guid' => $job->guid,
                'limit' => 0,
	);

$newtest = elgg_get_entities($options);

echo elgg_view('job-board-manager/css');
?>

<h1 class="elgg-listing-summary-title-company">
<?php 
echo elgg_echo('job:board:submissions');

?>
</h1>
</br>
<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>
                #
            </th>
            
            <th>
                <?php echo elgg_echo('job:board:candidate_name');?>
            </th>
            
            <th>
                <?php echo elgg_echo('job:board:candidate_email');?>
            </th>
            
            <th>
                <?php echo elgg_echo('job:board:candidate_phone');?>
            </th>
            
            <th>
                <?php echo elgg_echo('job:board:candidate_resume');?>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $i=0;
            foreach ($newtest as $value) {
    $i = $i +1;
        ?>
        <tr>
            <td>
                <?php echo $i; ?>
            </td>
            
            <td>
                <?php echo $value->title; ?>
            </td>
            
            <td>
                <?php echo $value->candidate_email; ?>
            </td>
            
            <td>
                <?php echo $value->candidate_phone; ?>
            </td>
            
            <td>
                
                <?php
                    $featured = elgg_get_entities(array(
                    'type' => 'object',
                    'subtype' => 'resumes',
                    'container_guid' => $value->guid,
                    'limit' => 1,
                    'preload_owners' => true,
                    'preload_containers' => true,
                    'distinct' => false,
                    ));

                    foreach ($featured as $f) {
                        $file = get_entity($f->guid);

                    $download_url = elgg_get_download_url($file);

                             $link = elgg_view('output/url', array(
                    'encode_text' => true,
                    'href' => $download_url, 
                    'text' => $file->title, 
                    ));

                                // echo $link;

                    ?>
                
                    <a href="<?php echo $download_url;?>" style="color: white; text-decoration: none;">     
                        <div style="
                             background: #a066ff !important; 
                             margin: 0 5px 5px 0; 
                             padding: 8px 10px; border-radius: 3px; color: white; font-weight: 400;">
                        <span class="fa elgg-icon-briefcase fa-briefcase"></span>        

                        <?php  echo elgg_echo('job:board:view_resume');?>

                        </div>
                    </a>
                    <?php

                                }
                                ?>
            </td>
        </tr>
            <?php 
            }
            ?>
    </tbody>
</table>



<?php
    echo elgg_view('job-board-manager/datatables');
?>
    
  