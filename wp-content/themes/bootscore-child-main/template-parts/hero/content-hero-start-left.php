<?php if ($args) { ?>
<header class="header hero-container hero-desktop text-overlay d-none d-md-block" data-type="<?php echo $args['type']; ?>" data-template="<?php echo $args['template']; ?>">
    <div
        class="page-header min-vh-75 relative"
        style="background-image: url(<?php echo $args['images']['background_image']; ?>)">
        <span class="mask bg-gradient-dark opacity-9"></span>
        <div class="container-fluid">
            <div class="row header-text-container mt-md-n6">
                <div class="col-md-5 col-lg-4 z-index-2">
<?php } ?>