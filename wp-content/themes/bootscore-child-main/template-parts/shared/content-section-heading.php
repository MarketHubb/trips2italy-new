<?php 
if (isset($args) && is_numeric($args)) { 
     $section = get_field('section_heading', $args); ?>
        
        <div class="col-lg-6">
            <h2 class=" mb-0 mt-2"><?php echo $section['heading']; ?></h2>
            <h2 class="text-gradient text-primary"><?php echo $section['subheading']; ?></h2>
            <p><?php echo $section['description']; ?></p>
    <!--        <a href="javascript:;" class="text-primary text-gradient icon-move-right fw-bold">More about what we do-->
    <!--            <i class="fas fa-arrow-right text-sm ms-1"></i>-->
    <!--        </a>-->
        </div>
<?php } ?>
