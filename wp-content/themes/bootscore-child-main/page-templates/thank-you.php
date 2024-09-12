<?php
/* Template Name: Confirmation */
get_header('confirmation'); ?>

<?php
$personal = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : "for your submission";
$confirmation_fields = get_field('confirmation', 'option');
$bg_images_array = $confirmation_fields['background_images'];
?>

<section class="block relative">
    <div class="w-screen h-screen relative">
        <?php if (!empty($bg_images_array[0])) { ?>
            <?php 
            $figure_base_classes = ' w-[150px] h-[180px]  md:w-[336px] md:h-[403px] bg-[#eaeaea] px-[9px] pt-[9px] pb-[30px] md:px-[19px] md:pt-[19px] md:pb-[85px] shadow-md shadow-black/50 absolute '; 
            $figcaption_base_classes = 'stylized text-gray-900 text-sm pt-1 sm:text-2xl lg:text-4xl text-center';
            ?>
            <figure class="<?php echo $figure_base_classes; ?> left-0 -top-10 rotate-[8deg]">
                <img src="<?php echo $bg_images_array[0]['image']['url']; ?>" class="w-full h-auto" alt="">
                <figcaption class="<?php echo $figcaption_base_classes; ?>"><?php echo $bg_images_array[0]['callout'] ?></figcaption>
            </figure>
        <?php } ?>

        <?php if (!empty($bg_images_array[1])) { ?>
            <figure class="<?php echo $figure_base_classes; ?> -right-6 -mr-6 md:right-0 -bottom-2 md:-bottom-8 -rotate-[10deg]">
                <img src="<?php echo $bg_images_array[1]['image']['url']; ?>" class="w-full h-auto" alt="">
                <figcaption class="<?php echo $figcaption_base_classes; ?>"><?php echo $bg_images_array[1]['callout'] ?></figcaption>
            </figure>
        <?php } ?>

        <div class="grid justify-center items-center content-center max-w-2xl h-full mx-auto px-8 sm:px-0 text-center">

            <img src="<?php echo $confirmation_fields['logo']['url']; ?>" class="w-16 h-16 inline-block mx-auto" alt="">
            <h1 class="stylized text-xl sm:text-2xl md:text-3xl lg:text-4xl text-brand-500 text-center tracking-normal">
                <?php echo $confirmation_fields['tagline']; ?>
            </h1>
            <h2 class="text-3xl sm:text-5xl font-base lg:text-8xl font-semibold leading-normal text-center text-brand-950 mb-3 ">
                <?php echo $confirmation_fields['heading']; ?> <span class=" block"><?php echo $personal; ?>!</span>
            </h2>
            <p class="to-gray-700 text-base sm:text-lg">
                <?php echo $confirmation_fields['description']; ?>
            </p>
            <p class="py-2">
                <a class="font-base text-gray-800 font-semibold" href="tel:+1-866-464-8259" title="" target="_self">1-866-464-8259</a>
            </p>
        </div>
    </div>
</section>

<?php get_footer('itinerary'); ?>