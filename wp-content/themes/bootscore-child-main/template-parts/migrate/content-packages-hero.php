<?php 
$packages = get_posts([
	'post_type' => 'package',
	'posts_per_page' => -1
]);

foreach ($packages as $package) {
	$new_title = extractBeforePipe(get_the_title( $package->ID ));
	echo "<h5>" . $new_title . '</h5><hr/>';
}
 ?>