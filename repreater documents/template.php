<?php
/**
Template Name:  
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

get_header();
echo '<div class="w-page clearfix pt-3 pb-3 pl-2 pr-2">';
if (have_posts()) {
    while (have_posts()) {
        the_post();
        echo '<h1 class="pagetitle">' . get_the_title() . '</h1>';
        the_content();
        wp_reset_postdata();

        // Rating Agency Reports
        $rating_agency_reports = get_field('rating_agency_reports', 'options');
        if ($rating_agency_reports) {
            echo '<h3>Rating Agency Reports</h3>';
            echo '<div class="pt-2 pb-2"><ul class="columns x2 w-100 align-m"><li><select class="w-100"><option value="">select document</option>';
            foreach ($rating_agency_reports as $rating_agency_report) {
                echo inspect($rating_agency_report);
                $document = $rating_agency_report['document'];
                $label = $rating_agency_report['label'];
                echo "<option value='$document'>$label</option>";
            }
            echo '</select></li><li class="pl-3"><a href="" download class="hidden">download</a></li><ul></div>';
        }

        // MHHEFA Board Incumbency Certificate
        $mhhefa_board_incumbency_certificate = get_field('mhhefa_board_incumbency_certificate', 'options');
        if ($mhhefa_board_incumbency_certificate) {
            echo '<div class="pt-2"><a href="' . $mhhefa_board_incumbency_certificate . '" download>MHHEFA Board Incumbency Certificate</a></div>';
        }
    }
}
echo '</div>';
?>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('select').on('change',function(){
            $file=$(this).val();
            $parent=$(this).closest('ul.columns');
            $anchor=$('a',$parent);
            if($file.length>0){
                $anchor.attr('href',$file).show();
            }else{
                $anchor.hide();
            }

        });
    });
</script>

<?php
get_footer();
