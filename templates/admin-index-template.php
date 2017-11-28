<div class="wrap">
<h2><?php echo Add_Bootstrap_4::get_h2_title() ?></h2>

<p>Welcome to admin for <strong><?php echo Add_Bootstrap_4::get_plugin_name() ?></strong>. Here, you can change some parameters.</p>

<h3>Way to load CSS code:</h3>
<form method="post" action="options.php">
	<?php settings_fields( Add_Bootstrap_4::get_options_group_value() ); ?>

	<input type="radio" name="<?php echo Add_Bootstrap_4::get_external_option_name(); ?>" value="0"<?php if ( ! get_option( Add_Bootstrap_4::get_external_option_name() ) ): ?> checked="checked" <?php endif; ?> /> As <i>style</i> label HTML in head
	<br />
	<input type="radio" name="<?php echo Add_Bootstrap_4::get_external_option_name(); ?>" value="1"<?php if ( get_option( Add_Bootstrap_4::get_external_option_name() ) ): ?> checked="checked" <?php endif; ?> /> As external file (link in head)

	<p class="submit">
		<input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ) ?>" />
	</p>
	
</form>

</div>