<?php
/**
 * Admin View: Section - WP Safelink License Status
 *
 * @package WP Safelink
 * @since 5.2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get plugin data for header
$plugin_data = get_plugin_data( wpsafelink_plugin_file() );

// Determine license status
$is_active = $formatted_data['success'];
$license_key = '';
$license_display = '';

if ( $is_active && isset( $formatted_data['result']['license_key'] ) ) {
	$license_key = $formatted_data['result']['license_key'];
	// Mask license key for display
	if ( strlen( $license_key ) > 10 ) {
		$license_display = substr( $license_key, 0, 8 ) . '-' . str_repeat( '*', 32 );
	} else {
		$license_display = $license_key;
	}
}
?>


<!-- Status Table Container -->
<thead>
    <tr>
        <th colspan="3">
            <div class="wpsaf-status-header">
                <span class="wpsaf-status-title">WP Safelink License Status</span>
                <button type="button" class="wpsaf-status-toggle" id="wpsaf-status-toggle" title="Hide/Show Status">
                    <span class="dashicons dashicons-arrow-up-alt2" id="wpsaf-status-toggle-icon"></span>
                </button>
            </div>
        </th>
    </tr>
</thead>
<tbody id="wpsaf-status-body">
    <!-- License Management Section -->
    <tr class="wpsaf-license-management-row">
        <td colspan="3" class="wpsaf-license-management-cell">
            <div class="wpsaf-license-form-container">
                <form action="" method="POST" class="wpsaf-license-form" id="wpsaf-license-form">
                    <input type="hidden" name="action" value="license">

                    <div class="wpsaf-license-input-section">
                        <div class="wpsaf-license-field-group">
                            <label for="wpsafelink_license_input" class="wpsaf-license-label">
                                <span class="wpsaf-label-text">License Code</span>
                                <?php if ( $is_active ) : ?>
                                    <span class="wpsaf-license-status wpsaf-status-active">✓ Active</span>
                                <?php else : ?>
                                    <span class="wpsaf-license-status wpsaf-status-inactive">Inactive</span>
                                <?php endif; ?>
                            </label>

                            <div class="wpsaf-license-input-wrapper">
                                <?php if ( $is_active ) : ?>
                                    <input type="text"
                                            id="wpsafelink_license_input"
                                            class="wpsaf-license-input"
                                            value="<?php echo esc_attr( $license_display ); ?>"
                                            disabled
                                            autocomplete="off"
                                            placeholder="License hidden for security">

                                    <div class="wpsaf-license-actions">
                                        <button type="button"
                                                class="wpsaf-button wpsaf-button-secondary wpsaf-button-small wpsaf-change-btn"
                                                id="wpsaf-change-license-btn">
                                            <span class="dashicons dashicons-edit"></span>
                                            Deactivate
                                        </button>
                                        <input type="hidden" name="sub" id="wpsaf-change-input" value="">
                                    </div>
                                <?php else : ?>
                                    <input type="text"
                                            name="wpsafelink_license"
                                            id="wpsafelink_license_input"
                                            class="wpsaf-license-input"
                                            value=""
                                            autocomplete="off"
                                            placeholder="Enter your license key">

                                    <div class="wpsaf-license-actions">
                                        <button type="submit"
                                                class="wpsaf-button wpsaf-button-primary wpsaf-button-small">
                                            <span class="dashicons dashicons-yes"></span>
                                            Activate
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <p class="wpsaf-license-description">
                                <?php if ( $is_active ) : ?>
                                    License active and connected to Themeson servers.
                                    <a href="https://themeson.com/member/?utm_source=wp-admin&utm_medium=plugin&utm_campaign=wp-safelink&utm_content=status-table"
                                        target="_blank"
                                        class="wpsaf-account-link">Manage account →</a>
                                <?php else : ?>
                                    Enter your license key to activate premium features.
                                    <a href="https://themeson.com/wp-safelink/?utm_source=wp-admin&utm_medium=plugin&utm_campaign=wp-safelink&utm_content=get-license"
                                        target="_blank"
                                        class="wpsaf-account-link">Get license →</a>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </td>
    </tr>

    <!-- Status Information Row -->
    <?php if ( $is_active ) : ?>
        <?php
        // Display license details
        if ( isset( $formatted_data['result'] ) && is_array( $formatted_data['result'] ) ) :
            $row_count = 0;
            foreach ( $formatted_data['result'] as $title => $value ) :
                if ( $title == 'license_key' ) continue; // Skip license key as it's shown above

                $row_count++;
                $row_bg = ( $row_count % 2 == 0 ) ? '#f9f9f9' : '#fff';

                // Format title for display
                $display_title = str_replace( '_', ' ', $title );
                $display_title = ucwords( $display_title );

                // Special formatting for certain fields
                if ( $title == 'last_check' ) {
                    $display_title = 'Last Validation';
                } else if ( $title == 'response_time' ) {
                    $display_title = 'Response Time';
                } else if ( $title == 'status' ) {
                    $display_title = 'Status';
                }
                ?>
                <tr style="background: <?php echo $row_bg; ?>;">
                    <td style="width: 40%; padding: 10px 12px; font-weight: 600; color: #555; font-size: 13px;">
                        <?php echo esc_html( $display_title ); ?>
                    </td>
                    <td colspan="2" style="padding: 10px 12px; font-size: 13px;">
                        <?php if ( $title == 'status' && $value == 'active' ) : ?>
                            <mark class="yes" style="background: #7ad03a; color: #fff; padding: 4px 10px; border-radius: 3px; font-weight: 600; text-transform: uppercase; font-size: 11px;">
                                <?php echo esc_html( $value ); ?>
                            </mark>
                        <?php elseif ( $title == 'response_time' ) : ?>
                            <?php
                            $time_value = intval( str_replace( 'ms', '', $value ) );
                            $time_class = ( $time_value > 1000 ) ? 'slow' : 'fast';
                            $time_bg = ( $time_value > 1000 ) ? '#e74c3c' : '#7ad03a';
                            ?>
                            <mark class="<?php echo $time_class; ?>"
                                    style="background: <?php echo $time_bg; ?>; color: #fff; padding: 4px 10px; border-radius: 3px; font-weight: 600;">
                                <?php echo esc_html( $value ); ?>
                            </mark>
                        <?php else : ?>
                            <mark class="yes"><?php echo esc_html( $value ); ?></mark>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach;
        endif;
        ?>

    <?php else : ?>
        <!-- Inactive License Display -->
        <tr class="wpsaf-status-info-row">
            <td colspan="3" style="text-align: center; padding: 30px; background: #fff5f5;">
                <span class="dashicons dashicons-warning"
                        style="color: #dc3232; font-size: 48px; display: block; margin-bottom: 15px;"></span>
                <p style="color: #dc3232; font-size: 16px; margin-bottom: 20px; font-weight: 600;">
                    License Not Active
                </p>
                <p style="color: #666; margin-bottom: 20px;">
                    Activate your license to unlock all premium features and get support.
                </p>
                <a href="https://themeson.com/wp-safelink/?utm_source=wp-admin&utm_medium=plugin&utm_campaign=wp-safelink&utm_content=get-license-cta"
                    target="_blank"
                    class="button button-primary button-large">
                    Get Valid License Key
                </a>
            </td>
        </tr>
    <?php endif; ?>
</tbody>

<tfoot>
    <tr class="wpsaf-modification-compact">
        <td colspan="3">
            <div class="wpsaf-modification-inline">
                <span class="wpsaf-mod-text">
                    Need custom safelink features, advanced protection, or monetization options? Our developer team is ready to help!
                </span>
                <a href="https://themeson.com/support/?utm_source=wp-admin&utm_medium=plugin&utm_campaign=wp-safelink"
                    target="_blank"
                    class="wpsaf-mod-link">
                    Get Consultation →
                </a>
            </div>
        </td>
    </tr>
</tfoot>

<style>
/* Product Header */
.wpsaf-product-head {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 20px;
    padding: 20px;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

.wpsaf-description h1 {
    margin: 0 0 8px;
    font-size: 24px;
    color: #1e293b;
}

.wpsaf-description h1 small {
    font-size: 12px;
    color: #64748b;
    margin-left: 8px;
}

.wpsaf-description p {
    margin: 0;
    color: #475569;
    font-size: 14px;
}

.wpsaf-logo {
    flex-shrink: 0;
}

/* Status Table */
.wpsafelink_product_status_table {
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

.wpsaf-status-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 16px;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
}

.wpsaf-status-title {
    font-size: 14px;
    font-weight: 600;
    color: #1e293b;
}

.wpsaf-status-toggle {
    background: none;
    border: none;
    cursor: pointer;
    padding: 4px;
    color: #64748b;
    transition: all 0.2s ease;
}

.wpsaf-status-toggle:hover {
    color: #1e293b;
    transform: translateY(-1px);
}

/* License Management Section */
.wpsaf-license-management-row td {
    padding: 0 !important;
    background: #fafbfc;
}

.wpsaf-license-form-container {
    padding: 20px;
}

.wpsaf-license-field-group {
    margin: 0;
}

.wpsaf-license-label {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 8px;
}

.wpsaf-label-text {
    font-size: 13px;
    font-weight: 600;
    color: #374151;
}

.wpsaf-license-status {
    font-size: 11px;
    padding: 2px 8px;
    border-radius: 12px;
    font-weight: 600;
}

.wpsaf-license-status.wpsaf-status-active {
    background: #d1fae5;
    color: #065f46;
}

.wpsaf-license-status.wpsaf-status-inactive {
    background: #fee2e2;
    color: #991b1b;
}

.wpsaf-license-input-wrapper {
    display: flex;
    gap: 8px;
    align-items: center;
}

.wpsaf-license-input {
    flex: 1;
    padding: 8px 12px;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    font-size: 13px;
    background: #fff;
    transition: all 0.2s ease;
}

.wpsaf-license-input:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    outline: none;
}

.wpsaf-license-input:disabled {
    background: #f9fafb;
    color: #6b7280;
    cursor: not-allowed;
}

.wpsaf-license-actions {
    display: flex;
    gap: 6px;
}

.wpsaf-button {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 12px;
    border: none;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
}

.wpsaf-button-primary {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: #fff;
}

.wpsaf-button-primary:hover {
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25);
    transform: translateY(-1px);
}

.wpsaf-button-secondary {
    background: #fff;
    color: #6b7280;
    border: 1px solid #e5e7eb;
}

.wpsaf-button-secondary:hover {
    background: #f9fafb;
    border-color: #d1d5db;
}

.wpsaf-button-small {
    padding: 6px 10px;
    font-size: 11px;
}

.wpsaf-button .dashicons {
    font-size: 14px;
    width: 14px;
    height: 14px;
    line-height: 14px;
}

.wpsaf-license-description {
    margin: 8px 0 0;
    font-size: 12px;
    color: #6b7280;
}

.wpsaf-account-link {
    color: #3b82f6;
    text-decoration: none;
    font-weight: 500;
}

.wpsaf-account-link:hover {
    color: #2563eb;
    text-decoration: underline;
}

/* Status Info Row */
.wpsaf-status-info-row td {
    background: #f0f9ff;
    border-left: 4px solid #3b82f6;
}

/* Modification Footer */
.wpsaf-modification-compact td {
    padding: 0 !important;
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    border-top: 1px solid #f59e0b;
}

.wpsaf-modification-inline {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 16px;
    gap: 12px;
}

.wpsaf-mod-text {
    flex: 1;
    font-size: 12px;
    color: #92400e;
    line-height: 1.4;
}

.wpsaf-mod-link {
    flex-shrink: 0;
    padding: 6px 12px;
    background: #fff;
    color: #92400e;
    border-radius: 6px;
    text-decoration: none;
    font-size: 12px;
    font-weight: 600;
    transition: all 0.2s ease;
    border: 1px solid rgba(146, 64, 14, 0.2);
}

.wpsaf-mod-link:hover {
    background: #92400e;
    color: #fff;
    transform: translateX(2px);
}

/* Modal Styles */
.wpsaf-license-modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 999999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.wpsaf-modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(2px);
}

.wpsaf-modal-container {
    position: relative;
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    max-width: 480px;
    width: 100%;
    max-height: 90vh;
    overflow: hidden;
    animation: modalSlideUp 0.3s ease-out;
}

@keyframes modalSlideUp {
    from {
        opacity: 0;
        transform: translateY(20px) scale(0.98);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.wpsaf-modal-header {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 16px 20px;
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    border-bottom: 1px solid #f59e0b;
}

.wpsaf-modal-icon {
    font-size: 20px;
    flex-shrink: 0;
}

.wpsaf-modal-header h3 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
    color: #92400e;
    flex: 1;
}

.wpsaf-modal-close {
    background: none;
    border: none;
    color: #92400e;
    cursor: pointer;
    padding: 4px;
    border-radius: 3px;
    transition: all 0.2s ease;
}

.wpsaf-modal-close:hover {
    background: rgba(146, 64, 14, 0.1);
}

.wpsaf-modal-body {
    padding: 20px;
    overflow-y: auto;
    max-height: 60vh;
}

.wpsaf-warning-title {
    margin: 0 0 12px;
    font-size: 15px;
    font-weight: 600;
    color: #1f2937;
}

.wpsaf-warning-description {
    margin: 0 0 16px;
    font-size: 13px;
    color: #6b7280;
    line-height: 1.5;
}

.wpsaf-impact-list {
    margin: 16px 0;
}

.wpsaf-impact-item {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    margin-bottom: 8px;
    font-size: 12px;
    color: #374151;
    line-height: 1.4;
}

.wpsaf-impact-icon {
    font-size: 14px;
    flex-shrink: 0;
    margin-top: 1px;
}

.wpsaf-reactivation-note {
    background: #f0f9ff;
    border: 1px solid #e0f2fe;
    border-radius: 6px;
    padding: 10px;
    margin-top: 16px;
}

.wpsaf-reactivation-note p {
    margin: 0;
    font-size: 12px;
    color: #0369a1;
    line-height: 1.4;
}

.wpsaf-modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 8px;
    padding: 16px 20px;
    background: #f9fafb;
    border-top: 1px solid #e5e7eb;
}

/* Responsive */
@media (max-width: 768px) {
    .wpsaf-product-head {
        flex-direction: column;
        gap: 16px;
    }

    .wpsaf-modification-inline {
        flex-direction: column;
        text-align: center;
    }
}

@media (max-width: 520px) {
    .wpsaf-license-input-wrapper {
        flex-direction: column;
    }

    .wpsaf-license-actions {
        width: 100%;
    }

    .wpsaf-button {
        width: 100%;
        justify-content: center;
    }
}
</style>