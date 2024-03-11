<?php if ($args) { ?>

    <?php
    $hero = $args;
    ?>

    <header class="header-2 test text-overlay">
        <div class="page-header min-vh-75 relative" style="background-image: url(<?php echo $hero['images']['background_image']; ?>)">
            <span class="mask bg-gradient-dark opacity-9"></span>
            <div class="container-fluid">

                <div class="row header-text-container mt-md-n6">
                    <div class="col-md-5 col-lg-4 z-index-3">

                        <?php
                        $heading = output_hero_heading($hero);
                        echo ($heading) ?: null;
                        ?>

                        <?php
                        $description = output_hero_description($hero);
                        echo ($description) ?: null;
                        ?>

                        <?php
                        $links = output_hero_links($hero);
                        echo ($links) ?: null;
                        ?>
                        
                    </div>
                    
                </div>
            </div>
            
            <?php if ($hero['wave'] === "wave") { ?>

                <div class="position-absolute w-100 z-index-1 bottom-0">
                    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
                        <defs>
                            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
                        </defs>
                        <g class="moving-waves">
                            <use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(255,255,255,0.40"></use>
                            <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.35)"></use>
                            <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.25)"></use>
                            <use xlink:href="#gentle-wave" x="48" y="8" fill="rgba(255,255,255,0.20)"></use>
                            <use xlink:href="#gentle-wave" x="48" y="13" fill="rgba(255,255,255,0.15)"></use>
                            <use xlink:href="#gentle-wave" x="48" y="16" fill="rgba(255,255,255,0.95"></use>
                        </g>
                    </svg>
                </div>

            <?php } ?>

        </div>
    </header>

<?php } ?>