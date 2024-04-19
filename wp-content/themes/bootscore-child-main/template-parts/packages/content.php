<section class="pt-7 pb-0">
    <div class="container">
        <div class="row">

            <?php
$packages = get_posts(array(
	'post_type' => 'package',
	'posts_per_page' => 42,
	'post__not_in' => [27976, 27963, 27952, 27946, 27944, 27945, 27939, 27933, 27936],
));

$p = '';
foreach ($packages as $package) {
	$image = get_field('featured_image', $package->ID);
	if ($image) {
		$p .= '<div class="col-lg-4 col-md-6 my-3">';
		$p .= '<div class="card card-blog card-plain h-100 package-cards p-4 rounded">';
		$p .= '<div class="position-relative">';
		$p .= '<img src="' . $image['url'] . '" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">';
		$p .= '</div>';
		$p .= '<div class="card-body d-grid px-1 pt-3">';
		$p .= '<div class="">';
		$p .= '<p class=" text-dark mb-2 text-sm">';
		$p .= 'Starting at: ' . get_field('price', $package->ID) . '</p>';
		$p .= '<h5>' . get_the_title($package->ID) . '</h5></a>';
		$p .= '<p class="clamp-4">' . get_field('description', $package->ID) . '</p>';
		$p .= '</div>';
		$p .= '<div class="mt-auto pt-2">';
		$p .= '<a href="' . get_permalink($package->ID) . '" type="button" class="btn btn-outline-primary btn-sm d-block mb-0 stretched-link">';
		$p .= 'View Package Details</a>';
		$p .= '</div></div></div></div>';
	}

}

echo $p;

?>


        </div>
    </div>
</section>
