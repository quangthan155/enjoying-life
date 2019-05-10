<?php
/*
 * Template for component
 *
 * @package enjoying-life
 * @author HiepTT
 */

$data   = get_data_component( get_the_ID(), __FILE__ );
$prefix = $data['prefix'];

$banner_src = get_field( 'background', get_the_ID() );
$style      = ! empty( $banner_src ) ? 'style="background: url(' . $banner_src . ')"' : '';
?>
