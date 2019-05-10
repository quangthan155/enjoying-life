<?php
/*
 * Template name: Component Template
 *
 * @package enjoying-life
 * @author HiepTT
 */

get_header();
?>

<div class="main__content" data-template="component-page">
    <?php load_template_components( get_the_ID() ); ?>
</div>

<?php
get_footer();