<?php 
// Check if this is a PRO tab and user doesn't have PRO license
$show_pro_overlay = false;
if (isset($is_pro_tab) && $is_pro_tab === true && (!isset($has_pro_license) || $has_pro_license === false)) {
    $show_pro_overlay = true;
}

// Get feature description based on tab
$feature_descriptions = [
    'Second Safelink' => [
        'icon' => '🔗',
        'features' => [
            '🚀 Create multiple safelink chains across different websites',
            '💰 Double your revenue with dual-layer monetization',
            '🌐 Seamless integration with unlimited domains',
        ],
        'highlight' => '2X YOUR REVENUE',
        'description' => 'Chain multiple safelinks together and maximize earnings from every single click!'
    ],
    'Adlinkfly PRO' => [
        'icon' => '🚀',
        'features' => [
            '🤖 Automatic link shortening and monetization',
            '🔄 Real-time synchronization between platforms',
            '📱 Mobile-optimized redirect experience',
        ],
        'highlight' => 'PREMIUM INTEGRATION',
        'description' => 'Supercharge your links with the most powerful Adlinkfly integration available!'
    ],
    'Google Redirect' => [
        'icon' => '🌟',
        'features' => [
            '✅ Leverage Google\'s trusted domain authority',
            '📈 Boost SEO rankings and link trust scores',
            '🎯 3X higher click-through rates guaranteed',
        ],
        'highlight' => '3X MORE CLICKS',
        'description' => 'Use Google\'s domain trust to skyrocket your click rates and earnings!'
    ],
    'Multiple Pages' => [
        'icon' => '📚',
        'features' => [
            '💎 Show up to 10 monetized pages per link',
            '💰 10X your ad revenue per visitor',
            '🎨 Fully customizable page sequences',
            '📊 Detailed page-by-page conversion analytics',
        ],
        'highlight' => '10X MORE REVENUE',
        'description' => 'Transform every click into a revenue-generating journey through multiple pages!'
    ],
    'Pro Tools' => [
        'icon' => '🛠️',
        'features' => [
            '⚡ Bulk manage 10,000+ links instantly',
            '📤 Advanced Import/Export with CSV & JSON',
            '🔧 Custom API endpoints for developers'
        ],
        'highlight' => 'ENTERPRISE TOOLS',
        'description' => 'Professional-grade tools to manage your link empire like a pro!'
    ]
];

$current_feature = isset($pro_tab_name) ? $feature_descriptions[$pro_tab_name] ?? null : null;
?>

<?php if ($show_pro_overlay): ?>
<div class="wpsafelink-pro-overlay-wrapper">
    <!-- PRO Banner at the top -->
    <div class="wpsafelink-pro-banner">
        <div class="wpsafelink-pro-banner-content">
            <div class="wpsafelink-pro-banner-left">
                <div class="wpsafelink-pro-banner-header">
                    <span class="wpsafelink-pro-star">⭐</span>
                    <h2>🚀 Unlock Premium Features</h2>
                </div>
                <p class="wpsafelink-pro-banner-description">
                    You're currently using the <strong>Free version</strong>. Upgrade to <strong>PRO</strong> to access <?php echo esc_html($pro_tab_name ?? 'advanced'); ?> features and boost your link monetization!
                </p>
                <?php if ($current_feature && isset($current_feature['features'])): ?>
                <div class="wpsafelink-pro-features-inline">
                    <?php 
                    $icons = ['💎', '⚡', '🛡️', '📊', '🔧', '🚀'];
                    $feature_count = 0;
                    foreach (array_slice($current_feature['features'], 0, 6) as $feature): 
                    ?>
                    <span class="wpsafelink-pro-feature-pill">
                        <?php echo $icons[$feature_count % count($icons)]; ?> <?php echo esc_html(str_replace(['🚀', '💰', '🎯', '🌐', '📊', '🔒', '⚡', '🤖', '🔐', '🔄', '📱', '✅', '📈', '🛡️', '💎', '🎨', '🧠', '📤', '🔧', '📞'], '', $feature)); ?>
                    </span>
                    <?php 
                    $feature_count++;
                    endforeach; 
                    ?>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="wpsafelink-pro-banner-right">
                <a href="https://themeson.com/safelink/" target="_blank" class="wpsafelink-upgrade-btn-top">
                    ⬆️ UPGRADE TO PRO
                </a>
                <span class="wpsafelink-trial-text">Free trial 14 days</span>
            </div>
        </div>
    </div>
    
    <!-- Locked content with opacity -->
    <div class="wpsafelink-pro-content-locked">
<?php endif; ?>

<form action="" method="POST" class="wps-modern-form">
	<?php
	$section_open = false;
	foreach ( $options as $key => $line ) :
		$value = ( isset( $data[ $key ] ) ? $data[ $key ] : ( isset( $line['default'] ) ? $line['default'] : '' ) );

		// Start new section when encountering a 'title' item
		if ( isset( $line['type'] ) && $line['type'] === 'title' ) {
			// Close previous section if open
			if ( $section_open ) {
				echo '</tbody></table></div></div>';
				$section_open = false;
			}

			echo '<div class="wps-section-card">';
			echo '  <div class="wps-section-header">';
			echo '      <h3>' . esc_html( $line['title'] ) . '</h3>';
			if ( ! empty( $line['description'] ) ) {
				echo '      <p class="description">' . $line['description'] . '</p>';
			}
			echo '  </div>';
			echo '  <div class="wps-section-body">';
			echo '      <table class="form-table wps-modern"><tbody>';
			$section_open = true;
			continue;
		}

		// Render normal fields inside current section
		echo '<tr class="wrap-' . esc_attr( $key ) . '">';
		echo '  <th scope="row">';
		echo '      <label for="' . esc_attr( $key ) . '">' . esc_html( $line['title'] ) . '</label>';
		// Add help icon if help text is provided
		if ( ! empty( $line['help'] ) ) {
			$help_title = ! empty( $line['help_title'] ) ? esc_attr( $line['help_title'] ) : 'Help';
			echo '<span class="wpsafelink-help-icon" data-help="' . esc_attr( $line['help'] ) . '" data-help-title="' . $help_title . '"></span>';
		}
		echo '  </th>';
		echo '  <td>';

		if ( $line['type'] == 'custom' ) {
			require_once $line['path'];
		} elseif ( $line['type'] == 'select' ) {
			$opts = $line['options'];
			echo '<select class="auto-confirm-select select2" name="wpsafelink[' . esc_attr( $key ) . ']" id="' . esc_attr( $key ) . '">';
			foreach ( $opts as $opt_key => $option ) {
				echo '<option value="' . esc_attr( $opt_key ) . '" ' . selected( $value, $opt_key, false ) . '>' . esc_html( $option ) . '</option>';
			}
			echo '</select>';
		} elseif ( $line['type'] == 'color' ) {
			$hex = $value ?: '#000000';
			echo '<div class="wps-color-field">';
			echo '  <input name="wpsafelink[' . esc_attr( $key ) . ']" type="text" id="' . esc_attr( $key ) . '" value="' . esc_attr( (string) $value ) . '" class="regular-text wps-color-hex" placeholder="#111827" autocomplete="off">';
			echo '  <input type="color" class="wps-color-picker" value="' . esc_attr( $hex ) . '" aria-label="Pick color">';
			echo '  <span class="wps-color-preview" style="background:' . esc_attr( $hex ) . '"></span>';
			echo '</div>';
		} elseif ( $line['type'] == 'media' ) {
			echo '<div class="wps-media-field" data-target="#' . esc_attr( $key ) . '">';
			echo '  <input name="wpsafelink[' . esc_attr( $key ) . ']" type="text" id="' . esc_attr( $key ) . '" value="' . esc_attr( (string) $value ) . '" class="regular-text wps-media-url" autocomplete="off">';
			echo '  <button type="button" class="button wps-media-upload">Upload</button>';
			echo '  <button type="button" class="button wps-media-clear">Clear</button>';
			echo '  <div class="wps-media-preview" style="margin-top:8px;">';
			if ( ! empty( $value ) ) {
				echo '      <img src="' . esc_url( (string) $value ) . '" style="max-width:220px;height:auto;"/>';
			}
			echo '  </div>';
			echo '</div>';
		} elseif ( $line['type'] == 'checkbox' ) {
			echo '<input type="hidden" name="wpsafelink[' . esc_attr( $key ) . ']" value="no">';
			echo '<input name="wpsafelink[' . esc_attr( $key ) . ']" type="checkbox" id="' . esc_attr( $key ) . '" value="yes" ' . checked( $value, 'yes', false ) . ' />';
			if ( ! empty( $line['label'] ) ) {
				echo '<label for="' . esc_attr( $key ) . '"><span class="description">' . esc_html( $line['label'] ) . '</span></label>';
			}
		} elseif ( $line['type'] == 'textarea' ) {
			echo '<textarea name="wpsafelink[' . esc_attr( $key ) . ']" id="' . esc_attr( $key ) . '" class="regular-text ' . esc_attr( $line['id'] ) . '" autocomplete="off" rows="6" ' . ( isset( $line['disabled'] ) && $line['disabled'] ? 'disabled' : '' ) . '>' . esc_textarea( stripslashes( (string) $value ) ) . '</textarea>';
		} elseif ( $line['type'] == 'select2' ) {
			$value = empty( $value ) ? [] : $value;
			echo '<select class="select2" name="wpsafelink[' . esc_attr( $key ) . '][]" id="' . esc_attr( $key ) . '" multiple>';
			foreach ( $line['options'] as $opt_key => $option ) {
				$selected = in_array( $opt_key, $value ) ? 'selected' : '';
				echo '<option value="' . esc_attr( $opt_key ) . '" ' . $selected . '>' . esc_html( $option ) . '</option>';
			}
			echo '</select>';
		} elseif ( $line['type'] == 'multiple_input' ) {
			$value = is_array( $value ) ? $value : [ $value ];
			echo '<div class="multiple-input">';
			foreach ( $value as $k => $v ) {
				echo '<p class="multiple-input-wrapper">';
				echo '  <input name="wpsafelink[' . esc_attr( $key ) . '][]" type="text" value="' . esc_attr( $v ) . '" class="regular-text" autocomplete="off">';
				echo '  <button type="button" class="multiple-delete button button-secondary">Delete</button>';
				echo '</p>';
			}
			if ( ! $value ) {
				echo '<p class="multiple-input-wrapper">';
				echo '  <input name="wpsafelink[' . esc_attr( $key ) . '][]" type="text" value="" class="regular-text" autocomplete="off">';
				echo '  <button type="button" class="multiple-delete button button-secondary">Delete</button>';
				echo '</p>';
			}
			echo '</div>';
			echo '<p><button type="button" class="multiple-add button button-primary">Add</button></p>';
		} else {
			echo '<input name="wpsafelink[' . esc_attr( $key ) . ']" type="' . esc_attr( $line['type'] ) . '" id="' . esc_attr( $key ) . '" value="' . esc_attr( (string) $value ) . '" class="regular-text" ' . ( isset( $line['disabled'] ) && $line['disabled'] ? 'disabled' : '' ) . ' ' . ( isset( $line['readonly'] ) && $line['readonly'] ? 'readonly' : '' ) . ' autocomplete="off">';
		}

		$shortcode = [
			'[IMAGE_DATA]' => '<img src="' . esc_url( is_array( $value ) ? ( $value[0] ?? '' ) : $value ) . '" />'
		];
		echo '<p class="description">' . ( isset( $line['description'] ) ? str_replace( array_keys( $shortcode ), array_values( $shortcode ), $line['description'] ) : '' ) . '</p>';

		echo '  </td>';
		echo '</tr>';
	endforeach;

	// Close any open section
	if ( $section_open ) {
		echo '</tbody></table></div></div>';
	}
	?>
    <div class="wps-savebar">
        <input type="hidden" name="page" value="wpsafelink">
        <input type="hidden" name="action" value="save">
        <input type="hidden" name="tab" value="<?php echo $tab; ?>"/>
        <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
    </div>
</form>

<?php if ($show_pro_overlay): ?>
    </div><!-- .wpsafelink-pro-content-locked -->
</div><!-- .wpsafelink-pro-overlay-wrapper -->
<?php endif; ?>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('select#template').change(function () {
            if ($(this).val() == 'template2' || $(this).val() == 'template3') {
                $('.template-warning').show();
            } else {
                $('.template-warning').hide();
            }
        });

        $('select#action_button').change(function () {
            var value = $(this).val();
            if (value == 'image') {
                $('.wrap-action_button_image_1').show();
                $('.wrap-action_button_image_2').show();
                $('.wrap-action_button_image_3').show();
                $('.wrap-action_button_image_4').show();

                $('.wrap-action_button_text_1').hide();
                $('.wrap-action_button_text_2').hide();
                $('.wrap-action_button_text_3').hide();
                $('.wrap-action_button_text_4').hide();
            } else {
                $('.wrap-action_button_image_1').hide();
                $('.wrap-action_button_image_2').hide();
                $('.wrap-action_button_image_3').hide();
                $('.wrap-action_button_image_4').hide();

                $('.wrap-action_button_text_1').show();
                $('.wrap-action_button_text_2').show();
                $('.wrap-action_button_text_3').show();
                $('.wrap-action_button_text_4').show();
            }
        });

        $('select#permalink').change(function () {
            var value = $(this).val();
            if (value != 3) {
                $('.wrap-permalink_parameter').show();
            } else {
                $('.wrap-permalink_parameter').hide();
            }
        });

        $('select#content_method').change(function () {
            var value = $(this).val();
            if (value == 'selected') {
                $('.wrap-content_ids').show();
            } else {
                $('.wrap-content_ids').hide();
            }
        });

        $('select#template').change(function () {
            var value = $(this).val();
            if (value == 'template3') {
                $('.wrap-skip_verification').show();
            } else {
                $('.wrap-skip_verification').hide();
            }

            if (value == 'template2') {
                $('.wrap-verification_homepage').show();
            } else {
                $('.wrap-verification_homepage').hide();
            }
        });

        // Timer style change handler
        $('select#timer_style').change(function () {
            var value = $(this).val();
            if (value == 'countdown') {
                // Show countdown-specific settings
                $('.wrap-countdown_color_start').show();
                $('.wrap-countdown_color_warning').show();
                $('.wrap-countdown_color_alert').show();
                $('.wrap-countdown_stroke_width').show();
                $('.wrap-countdown_size').show();
                $('.wrap-countdown_show_text').show();
                // Hide text-specific settings
                $('.wrap-time_delay_message').hide();
            } else {
                // Hide countdown-specific settings
                $('.wrap-countdown_color_start').hide();
                $('.wrap-countdown_color_warning').hide();
                $('.wrap-countdown_color_alert').hide();
                $('.wrap-countdown_stroke_width').hide();
                $('.wrap-countdown_size').hide();
                $('.wrap-countdown_show_text').hide();
                // Show text-specific settings
                $('.wrap-time_delay_message').show();
            }
        });

        setTimeout(function () {
            $('select').trigger('change');
        }, 1);

        $('.multiple-add').click(function () {
            var wrapper = $('.multiple-input').find('.multiple-input-wrapper').first().clone();
            wrapper.find('input').val('');
            $('.multiple-input').append(wrapper);
        });

        $(document).on('click', '.multiple-delete', function () {
            const count = $('.multiple-input').find('.multiple-input-wrapper').length;
            if (count <= 1) {
                alert('Cannot delete the last item');
                return;
            }

            if (confirm('Are you sure you want to delete this item?'))
                $(this).closest('.multiple-input-wrapper').remove();
        });

        // Media uploader (WordPress native)
        let wpsMediaFrame;
        $(document).on('click', '.wps-media-upload', function (e) {
            e.preventDefault();
            const wrapper = $(this).closest('.wps-media-field');
            const urlField = wrapper.find('.wps-media-url');
            const preview = wrapper.find('.wps-media-preview');

            if (typeof wp === 'undefined' || typeof wp.media === 'undefined') {
                alert('Media library is not available.');
                return;
            }

            wpsMediaFrame = wp.media({
                title: 'Select or Upload Media',
                button: {text: 'Use this media'},
                multiple: false
            });

            wpsMediaFrame.on('select', function () {
                const attachment = wpsMediaFrame.state().get('selection').first().toJSON();
                urlField.val(attachment.url);
                preview.html('<img src="' + attachment.url + '" style="max-width:220px;height:auto;"/>');
            });

            wpsMediaFrame.open();
        });

        $(document).on('click', '.wps-media-clear', function () {
            const wrapper = $(this).closest('.wps-media-field');
            wrapper.find('.wps-media-url').val('');
            wrapper.find('.wps-media-preview').empty();
        });

        // Color hex + picker sync
        function isValidHex(val) {
            return /^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/.test(val);
        }

        $(document).on('input change', '.wps-color-picker', function () {
            const wrapper = $(this).closest('.wps-color-field');
            const hex = $(this).val();
            wrapper.find('.wps-color-hex').val(hex);
            wrapper.find('.wps-color-preview').css('background', hex);
        });

        $(document).on('input change', '.wps-color-hex', function () {
            let val = $(this).val().trim();
            if (val && val[0] !== '#') val = '#' + val;
            // Auto uppercase normalization is optional; keep as typed
            if (isValidHex(val)) {
                $(this).val(val);
                const wrapper = $(this).closest('.wps-color-field');
                wrapper.find('.wps-color-picker').val(val);
                wrapper.find('.wps-color-preview').css('background', val);
            }
        });

    });
</script>
