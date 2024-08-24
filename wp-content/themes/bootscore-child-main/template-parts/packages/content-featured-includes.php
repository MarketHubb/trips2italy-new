<?php if (isset($args)) { ?>

	<?php for ($i = 0; $i < count($args) && $i < 3; $i++) { ?>

		<div class="col-xl-3 col-md-4 py-md-5 p-3 d-flex">
			<div class="p-6 text-start bg-white border-radius-lg shadow-lg flex-grow-1 d-flex flex-column">
				<?php if (isset($args[$i]['icon'])) { ?>
					<div class="icon icon-shape bg-gradient-info shadow text-center relative bottom-12 -mb-8">
						<i class="<?php echo $args[$i]['icon']; ?> fa-xl opacity-100"></i>
					</div>
				<?php } ?>
				<h5 class="stylized font-normal text-2xl lg:text-4xl text-orange my-2"><?php echo $args[$i]['callout']; ?></h5>
				<p class="font-heading text-lg lg:text-2xl text-blueGray"><?php echo $args[$i]['description']; ?></p>
			</div>
		</div>
		
	<?php } ?>

<?php } ?>