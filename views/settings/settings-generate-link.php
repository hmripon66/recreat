<form action="" method="POST">
    <table class="form-table">
        <tbody>
        <tr>
            <td style="width: 200px">
                <input name="wpsafelink_link" type="text" id="wpsafelink_link" class="regular-text"
                       autocomplete="off" placeholder="https://themeson.com" required>
            </td>
            <td>
                <input type="submit" name="submit" id="submit" class="button button-primary" value="Generate">
            </td>
        </tr>
        </tbody>
    </table>
    <input type="hidden" name="page" value="wpsafelink">
    <input type="hidden" name="action" value="generate_link">
    <input type="hidden" name="tab" value="<?php echo $tab; ?>"/>
</form>

<div style="width:auto;padding:15px;margin:10px 0;background:#fff;overflow-y: scroll;">
    <table id="safe_lists" class="display">
        <thead>
        <tr>
            <th style="width: 15%">Date Added</th>
            <th style="width: 20%">Safelink (short)</th>
            <th style="width: 20%">Target URL</th>
            <th style="width: 5%">View</th>
            <th style="width: 5%">Click</th>
            <th style="width: 1%"></th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<link href="https://cdn.datatables.net/v/dt/dt-2.0.8/datatables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/v/dt/dt-2.0.8/datatables.min.js"></script>
<script>
    jQuery(document).ready(function ($) {
        $('#safe_lists').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[0, "desc"]],
            "autoWidth": true,
            'ajax': '<?php echo admin_url('admin-ajax.php'); ?>?action=wpsafelink_revamp_generate_link&_wpnonce=<?php echo wp_create_nonce('wpsafelink_revamp_nonce'); ?>'
        });
    });
</script>
