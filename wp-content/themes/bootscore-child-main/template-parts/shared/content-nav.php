<!-- Navbar Light -->
<?php $home_url = get_home_url(); ?>
<nav

    class="navbar navbar-expand-xl navbar-light bg-white z-index-3 py-2 fixed-top z-index-3">
    <div class="container">
        <a class="navbar-brand pt-1 pb-2" href="<?php echo get_home_url(); ?>" rel="tooltip" title="Custom Italian Vacations" data-placement="bottom">
            <img src="<?php echo home_url() . '/wp-content/uploads/2023/01/Logo-No-Shadow.svg' ?>" alt="">
        </a>
        <button data-type="Form" data-target="form" class="btn btn-sm d-inline-block d-md-none bg-orange text-white btn-round mb-0 me-1" role="button">Plan My Trip</a>
        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon mt-2">
        <span class="navbar-toggler-bar bar1"></span>
        <span class="navbar-toggler-bar bar2"></span>
        <span class="navbar-toggler-bar bar3"></span>
      </span>
        </button>
        <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0" id="navigation">

            <ul class="navbar-nav navbar-nav-hover mx-auto mb-3">
                
                <?php 
                $id = get_the_id();
                if( have_rows('primary_nav', 'option') ):
                    $nav = '';
                    while ( have_rows('primary_nav', 'option') ) : the_row();
                        $page = get_sub_field('page', 'option');
                        $active_class = (isset($id) && $id === $page->ID) ? 'active ' : '';
                        $nav .= '<li class="nav-item px-md-4">';
                        $nav .= '<a href="' .  get_permalink($page) . '" ';
                        $nav .= 'class="' . $active_class . 'nav-link ps-md-2 d-flex flex-column justify-content-between cursor-pointer align-items-center" role="button">';
                        $nav .= '<img src="' . get_sub_field('icon', 'option') . '" class="nav-icons" />';
                        $nav .= get_sub_field('link_text', 'option');
                        $nav .= '</a></li>';
                    endwhile;
                    echo $nav;
                endif;
                
                ?>
            </ul>

            <ul class="navbar-nav d-lg-block d-none">
                <li class="nav-item">
                    <button data-type="Form" data-target="form" class="btn btn-sm bg-orange text-white btn-round mb-0 me-1" role="button">Plan My Trip</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->

