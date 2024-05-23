<?php if (isset($args)) { ?>

	<?php for ($i = 0; $i < count($args) && $i < 3; $i++) { ?>

		<div class="col-xl-3 col-md-4 py-md-5 py-3 d-flex">
			<div class="p-3 text-start bg-white border-radius-lg shadow-lg flex-grow-1 d-flex flex-column">
				<?php if ($args[$i]['icon']) { ?>
					<div class="icon icon-shape bg-gradient-info shadow text-center">
						<i class="<?php echo $args[$i]['icon']; ?> fa-xl opacity-100"></i>
					</div>
				<?php } ?>
				<h5 class="mt-3 fw-bolder"><?php echo $args[$i]['callout']; ?></h5>
				<p><?php echo $args[$i]['description']; ?></p>
			</div>
		</div>
		
	<?php } ?>

<?php } ?>