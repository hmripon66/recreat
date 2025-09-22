<?php
$domain = str_replace(['https://', 'http://'], '', home_url());
?>
<form action="" method="POST">
    <input type="hidden" name="page" value="wpsafelink">
    <input type="hidden" name="action" value="license">
    <input type="hidden" name="tab" value="<?php echo $tab; ?>"/>

    <table class="form-table">
        <tbody>
        <tr>
            <th scope="row">
                <label for="wpsafelink_domain">Domain</label>
            </th>
            <td>
                <input name="wpsafelink_domain" type="text" id="wpsafelink_domain" value="<?php echo $domain; ?>"
                       class="regular-text" autocomplete="off" readonly>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="wpsafelink_license">License</label>
            </th>
            <td>
                <input name="wpsafelink_license" type="text" id="wpsafelink_license"
                       class="regular-text"
                       autocomplete="off" <?php if ( $check_license ) {
	                echo 'value="' . $wpsafelink_core->license( 'key' ) . '" readonly';
                } ?>>
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <th scope="row">
                <a href="http://themeson.com/license" target="_blank">Get License Key</a>
            </th>
            <td>
                <input type="submit" name="submit" id="submit" class="button button-primary"
                       value="Validate License" <?php echo $check_license ? 'disabled' : ''; ?>>

                <?php if ($check_license) : ?>
                    <input id="reset_license" name="sub" type="submit" class="button" value="Change License">
                <?php endif ?>
            </td>
        </tr>
        </tfoot>
    </table>
</form>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('#reset_license').click(function (e) {
            if (!confirm('Are you sure you want to change the license?')) {
                e.preventDefault();
                return false;
            }
            // Allow form submission if user confirms
            return true;
        });
    });
</script>