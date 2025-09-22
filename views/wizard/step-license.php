<?php
/**
 * License step template
 *
 * @package WP_Safelink
 */

if (!defined('ABSPATH')) {
    exit;
}

$error = get_transient('wpsafelink_wizard_license_error');
$domain = str_replace(['https://', 'http://'], '', home_url());
?>

<div class="wpsafelink-wizard-step wpsafelink-wizard-license">
    <h2><?php esc_html_e('Buy WP Safelink and Full Version', 'wp-safelink'); ?></h2>
    <p class="wpsafelink-wizard-subtitle">
        <?php esc_html_e('Choose your plan and unlock powerful features for your website.', 'wp-safelink'); ?>
    </p>

    <?php if ($error) : ?>
        <div class="wpsafelink-wizard-notice wpsafelink-wizard-notice-error">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
            <?php echo esc_html($error); ?>
        </div>
        <?php delete_transient('wpsafelink_wizard_license_error'); ?>
    <?php endif; ?>

    <!-- Pricing Cards -->
    <div class="wpsafelink-pricing-container">
        <!-- FULL Version Card -->
        <div class="wpsafelink-pricing-card">
            <div class="wpsafelink-pricing-header">
                <h3 class="wpsafelink-pricing-title">FULL Version</h3>
                <div class="wpsafelink-pricing-price">
                    <span class="wpsafelink-price-original">$20</span>
                    <span class="wpsafelink-price-current">$15</span>
                    <span class="wpsafelink-price-period">/Year</span>
                </div>
            </div>
            <ul class="wpsafelink-pricing-features">
                <li><span class="wpsafelink-feature-icon">✅</span> Adlinkfly Integration</li>
                <li><span class="wpsafelink-feature-icon">✅</span> Auto & Manual Safelink</li>
                <li><span class="wpsafelink-feature-icon">✅</span> Encrypted Links</li>
                <li><span class="wpsafelink-feature-icon">✅</span> Anti-Adblock</li>
                <li><span class="wpsafelink-feature-icon">✅</span> Client Version</li>
                <li><span class="wpsafelink-feature-icon">✅</span> Theme Integration</li>
                <li><span class="wpsafelink-feature-icon">✅</span> Captcha Support</li>
                <li><span class="wpsafelink-feature-icon">✅</span> 24/7 Support</li>
            </ul>
            <a href="https://themeson.com/wp-safelink/?utm_source=wp-admin&utm_medium=plugin&utm_campaign=wp-safelink&utm_content=wizard-full" target="_blank" class="wpsafelink-pricing-button">
                <?php esc_html_e('Get FULL Version', 'wp-safelink'); ?>
            </a>
        </div>

        <!-- PRO Version Card -->
        <div class="wpsafelink-pricing-card wpsafelink-pricing-featured">
            <div class="wpsafelink-pricing-badge">RECOMMENDED</div>
            <div class="wpsafelink-pricing-header">
                <h3 class="wpsafelink-pricing-title">PRO Version</h3>
                <div class="wpsafelink-pricing-price">
                    <span class="wpsafelink-price-original">$40</span>
                    <span class="wpsafelink-price-current">$30</span>
                    <span class="wpsafelink-price-period">/Year</span>
                </div>
            </div>
            <ul class="wpsafelink-pricing-features">
                <li class="wpsafelink-feature-highlight"><span class="wpsafelink-feature-icon">⭐</span> Everything in FULL, PLUS:</li>
                <li><span class="wpsafelink-feature-icon">⭐</span> Google Redirect Technology</li>
                <li><span class="wpsafelink-feature-icon">⭐</span> Multiple Pages System</li>
                <li><span class="wpsafelink-feature-icon">⭐</span> Anti-Bot Protection</li>
                <li><span class="wpsafelink-feature-icon">⭐</span> Advanced API Access</li>
                <li><span class="wpsafelink-feature-icon">⭐</span> Priority Support</li>
                <li><span class="wpsafelink-feature-icon">⭐</span> Future PRO Features</li>
            </ul>
            <a href="https://themeson.com/wp-safelink/?utm_source=wp-admin&utm_medium=plugin&utm_campaign=wp-safelink&utm_content=wizard-pro" target="_blank" class="wpsafelink-pricing-button wpsafelink-pricing-button-pro">
                <?php esc_html_e('Get PRO Version', 'wp-safelink'); ?>
            </a>
        </div>
    </div>

    <!-- License Activation Form -->
    <div class="wpsafelink-wizard-form wpsafelink-license-form">
        <h3 class="wpsafelink-form-title"><?php esc_html_e('Already have a license?', 'wp-safelink'); ?></h3>

        <div class="wpsafelink-wizard-field-group">
            <label for="domain" class="wpsafelink-wizard-label">
                <?php esc_html_e('Domain', 'wp-safelink'); ?>
            </label>
            <input type="text" id="domain" name="domain" class="wpsafelink-wizard-input" value="<?php echo esc_attr($domain); ?>" readonly />
        </div>

        <div class="wpsafelink-wizard-field-group">
            <label for="license_key" class="wpsafelink-wizard-label">
                <?php esc_html_e('License Key', 'wp-safelink'); ?>
                <span class="wpsafelink-wizard-required">*</span>
            </label>
            <div class="wpsafelink-wizard-license-input-wrapper">
                <input type="text"
                       id="license_key"
                       name="license_key"
                       class="wpsafelink-wizard-input wpsafelink-wizard-license-input"
                       placeholder="Enter your license key here"
                       autocomplete="off"
                       required />
            </div>
        </div>

        <div class="wpsafelink-wizard-license-status" id="license-status" style="display: none;">
            <div class="wpsafelink-wizard-license-status-content">
                <svg class="wpsafelink-wizard-license-status-icon success" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: none;">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <svg class="wpsafelink-wizard-license-status-icon error" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: none;">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <div class="wpsafelink-wizard-license-status-message">
                    <span class="status-text"></span>
                </div>
            </div>
        </div>
    </div>

    <style>
    /* Pricing Cards Styles */
    .wpsafelink-pricing-container {
        display: flex;
        gap: 24px;
        margin: 40px 0;
        justify-content: center;
        flex-wrap: wrap;
    }

    .wpsafelink-pricing-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 32px 24px;
        flex: 1;
        min-width: 280px;
        max-width: 320px;
        position: relative;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .wpsafelink-pricing-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    .wpsafelink-pricing-featured {
        border-color: #4F46E5;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
    }

    .wpsafelink-pricing-badge {
        position: absolute;
        top: -12px;
        left: 50%;
        transform: translateX(-50%);
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 4px 16px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .wpsafelink-pricing-header {
        text-align: center;
        padding-bottom: 24px;
        border-bottom: 1px solid #f3f4f6;
        margin-bottom: 24px;
    }

    .wpsafelink-pricing-title {
        font-size: 20px;
        font-weight: 600;
        color: #111827;
        margin: 0 0 16px;
        letter-spacing: -0.5px;
    }

    .wpsafelink-pricing-price {
        display: flex;
        align-items: baseline;
        justify-content: center;
        gap: 8px;
    }

    .wpsafelink-price-original {
        font-size: 20px;
        color: #9ca3af;
        text-decoration: line-through;
        font-weight: 300;
    }

    .wpsafelink-price-current {
        font-size: 36px;
        font-weight: 700;
        color: #111827;
        letter-spacing: -1px;
    }

    .wpsafelink-price-period {
        font-size: 16px;
        color: #6b7280;
        font-weight: 400;
    }

    .wpsafelink-pricing-features {
        list-style: none;
        padding: 0;
        margin: 0 0 32px;
    }

    .wpsafelink-pricing-features li {
        padding: 10px 0;
        font-size: 14px;
        color: #4b5563;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 400;
        letter-spacing: 0.2px;
    }

    .wpsafelink-feature-icon {
        font-size: 16px;
        flex-shrink: 0;
    }

    .wpsafelink-feature-highlight {
        font-weight: 600 !important;
        color: #111827 !important;
        padding-bottom: 8px !important;
        margin-bottom: 8px;
        border-bottom: 1px solid #f3f4f6;
    }

    .wpsafelink-pricing-button {
        display: block;
        padding: 12px 24px;
        background: #fff;
        color: #4F46E5;
        border: 2px solid #4F46E5;
        border-radius: 8px;
        text-align: center;
        font-weight: 600;
        font-size: 15px;
        text-decoration: none;
        transition: all 0.2s;
        letter-spacing: 0.3px;
    }

    .wpsafelink-pricing-button:hover {
        background: #4F46E5;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
    }

    .wpsafelink-pricing-button-pro {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
    }

    .wpsafelink-pricing-button-pro:hover {
        background: linear-gradient(135deg, #5a6fd8 0%, #6c4196 100%);
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    /* License Form Styles */
    .wpsafelink-license-form {
        padding: 32px;
        background: #f9fafb;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
    }

    .wpsafelink-form-title {
        font-size: 18px;
        font-weight: 600;
        color: #111827;
        margin: 0 0 24px;
        text-align: center;
        letter-spacing: -0.3px;
    }

    .wpsafelink-wizard-label {
        font-weight: 500;
        font-size: 14px;
        color: #374151;
        letter-spacing: 0.2px;
    }

    .wpsafelink-wizard-input {
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-weight: 400;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .wpsafelink-wizard-input:focus {
        border-color: #4F46E5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .wpsafelink-pricing-container {
            flex-direction: column;
            align-items: center;
        }

        .wpsafelink-pricing-card {
            max-width: 100%;
        }
    }
    </style>

    <div class="wpsafelink-wizard-actions">
        <button type="submit" name="save_step" class="wpsafelink-button wpsafelink-button-primary wpsafelink-button-large" id="activate-license">
            <?php esc_html_e('Activate License', 'wp-safelink'); ?>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </button>
    </div>
</div>