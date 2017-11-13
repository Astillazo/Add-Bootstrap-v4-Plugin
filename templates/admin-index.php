<div class="wrap">
<h2><?php echo AddBootstrap4::getH2Title() ?></h2>

<p>Welcome to admin for <strong><?php echo AddBootstrap4::getPluginName() ?></strong>. Here, you can change some parameters.</p>

<h3>Way to load CSS code:</h3>
<form method="post" action="options.php">
    <?php settings_fields(AddBootstrap4::getOptionsGroupValue()); ?>

    <input type="radio" name="<?php echo AddBootstrap4::getExternalOptionName(); ?>" value="0"<?php if (!get_option(AddBootstrap4::getExternalOptionName())) { ?> checked="checked" <?php } ?> /> As <i>style</i> label HTML in head
    <br />
    <input type="radio" name="<?php echo AddBootstrap4::getExternalOptionName(); ?>" value="1"<?php if (get_option(AddBootstrap4::getExternalOptionName())) { ?> checked="checked" <?php } ?> /> As external file (link in head)

    <p class="submit">
        <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>
    
</form>

</div>