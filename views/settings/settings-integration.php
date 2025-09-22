<div class="wpsafelink-integration-wrapper">
    <div class="wpsafelink-integration-main">
        <form action="" method="POST">
            <div class="integration-api-section">
                <h3>WP Safelink Integration Settings</h3>
                <p>Use the Integration Key below to connect other WP Safelink extension plugins with this installation.
                    This allows seamless integration between your main WP Safelink and extension plugins.</p>

                <div class="api-key-wrapper">
                    <input type="text"
                           id="integration-api-key"
                           class="api-key-field"
                           value="<?php echo esc_attr( $options['api_key']['default'] ); ?>"
                           readonly>
                    <button type="button"
                            class="copy-api-btn"
                            onclick="copyApiKey()">
                        Copy Key
                    </button>
                </div>

                <p class="description" style="margin-top: 10px;">
                    <strong>How to use:</strong> Install the extension plugin on your other WordPress sites and enter
                    this Integration Key in their settings.
                </p>
            </div>
        </form>
    </div>

    <div class="wpsafelink-integration-plugins">
        <div class="integration-plugin-box">
            <h3>WP Safelink Auto Convert Link</h3>
            <p class="description">Automatically converts external links on your WordPress site to safelinks. Perfect
                for monetizing outbound links without manual intervention.</p>

            <div class="features">
                <strong>Features:</strong>
                <ul>
                    <li>Automatic link conversion based on domain rules</li>
                    <li>Include/Exclude domain lists</li>
                    <li>Custom link patterns</li>
                    <li>Real-time conversion</li>
                    <li>Easy integration with main plugin</li>
                </ul>
            </div>

            <a href="https://themeson.com/member/content/Download+Plugins.1"
               target="_blank"
               class="download-plugin-btn">
                Download Plugin
            </a>
        </div>

        <div class="integration-plugin-box">
            <h3>WP Safelink Adlinkfly Integrator</h3>
            <p class="description">Connect your WP Safelink with Adlinkfly services for enhanced monetization options
                and advanced link management.</p>

            <div class="features">
                <strong>Features:</strong>
                <ul>
                    <li>Seamless Adlinkfly integration</li>
                    <li>Advanced analytics and reporting</li>
                    <li>Multiple ad formats support</li>
                    <li>Higher revenue potential</li>
                    <li>Synchronized link management</li>
                </ul>
            </div>

            <a href="https://themeson.com/member/content/Download+Plugins.1"
               target="_blank"
               class="download-plugin-btn">
                Download Plugin
            </a>
        </div>
    </div>
</div>

<script>
    function copyApiKey() {
        const apiKeyField = document.getElementById('integration-api-key');
        const copyBtn = document.querySelector('.copy-api-btn');

        // Select and copy the text
        apiKeyField.select();
        apiKeyField.setSelectionRange(0, 99999); // For mobile devices

        try {
            document.execCommand('copy');

            // Change button text temporarily
            const originalText = copyBtn.textContent;
            copyBtn.textContent = 'Copied!';
            copyBtn.style.background = '#46b450';

            setTimeout(() => {
                copyBtn.textContent = originalText;
                copyBtn.style.background = '';
            }, 2000);
        } catch (err) {
            alert('Failed to copy API key. Please copy it manually.');
        }

        // Deselect the text
        window.getSelection().removeAllRanges();
    }
</script>
