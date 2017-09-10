 <?php
/**
 * Upshot Theme: Shop sidebar
 * @package WordPress
 * @subpackage Upshot Theme
 * @since 1.0
 * TO BE INCLUDED ON SHOP PAGES
 */
 ?>


<?php 
if ( is_active_sidebar( 'shop-widgets' ) ) : ?>
<div class="vc_col-md-3 vc_col-sm-12 vc_col-xs-12" style="float:left;">
	<?php dynamic_sidebar('shop-widgets'); ?>
</div>
<?php endif;?>