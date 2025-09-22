<?php
/**
 * Welcome step template
 *
 * @package WP_Safelink
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="wpsafelink-wizard-step wpsafelink-wizard-welcome">
    <div class="wpsafelink-wizard-hero">
        <h1><?php esc_html_e('Welcome to WP Safelink', 'wp-safelink'); ?></h1>
        <p class="wpsafelink-wizard-tagline">
            <?php esc_html_e('Protect Your Download Links & Monetize Your Content', 'wp-safelink'); ?>
        </p>
    </div>

    <div class="wpsafelink-wizard-benefits">
        <div class="wpsafelink-wizard-benefit">
            <div class="wpsafelink-wizard-benefit-icon">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"></path>
                    <path d="M9 12l2 2 4-4"></path>
                </svg>
            </div>
            <h3><?php esc_html_e('Advanced Protection', 'wp-safelink'); ?></h3>
            <p><?php esc_html_e('Secure your download links with encryption, CAPTCHA verification, and anti-bot protection.', 'wp-safelink'); ?></p>
        </div>

        <div class="wpsafelink-wizard-benefit">
            <div class="wpsafelink-wizard-benefit-icon">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="9" y1="9" x2="15" y2="9"></line>
                    <line x1="9" y1="13" x2="15" y2="13"></line>
                    <line x1="9" y1="17" x2="11" y2="17"></line>
                </svg>
            </div>
            <h3><?php esc_html_e('Monetization Options', 'wp-safelink'); ?></h3>
            <p><?php esc_html_e('Display ads on safelink pages with countdown timers to generate revenue from your downloads.', 'wp-safelink'); ?></p>
        </div>

        <div class="wpsafelink-wizard-benefit">
            <div class="wpsafelink-wizard-benefit-icon">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                </svg>
            </div>
            <h3><?php esc_html_e('Analytics & Tracking', 'wp-safelink'); ?></h3>
            <p><?php esc_html_e('Track views, clicks, and conversions with detailed statistics for each protected link.', 'wp-safelink'); ?></p>
        </div>
    </div>

    <div class="wpsafelink-wizard-actions">
        <a href="<?php echo esc_url($wizard->get_next_step_link()); ?>" class="wpsafelink-button wpsafelink-button-primary wpsafelink-button-hero">
            <?php esc_html_e('Let\'s Get Started', 'wp-safelink'); ?>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </a>
        <p class="wpsafelink-wizard-skip">
            <?php esc_html_e('Setup will take less than 2 minutes.', 'wp-safelink'); ?><br>
        </p>
    </div>
</div>