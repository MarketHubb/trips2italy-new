<?php if ($args) { ?>
<!-- <header class="header hero-container hero-desktop text-overlay d-none d-md-block" data-type="<?php echo $args['type']; ?>" data-template="<?php echo $args['template']; ?>"> -->
<header class="header hero-container hero-desktop text-overlay hidden md:flex md:flex-col md:w-full" data-type="<?php echo $args['type']; ?>" data-template="<?php echo $args['template']; ?>">
    <div
        class="page-header relative"
        style="background-image: url(<?php echo $args['images']['background_image']; ?>)">
        <span class="mask bg-gradient-dark opacity-9"></span>
        <div class="container-fluid">
            <!-- <div class="row header-text-container mt-md-n6"> -->
            <div class="row inline-flex pt-28 pb-36 ">
                <div class="col-md-5 col-lg-5 col-xl-6 z-index-2">
<?php } ?>