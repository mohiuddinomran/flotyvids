<?php
function floatyvids_register_settings() {
    register_setting('floatyvids_settings_group', 'floatyvids_settings');

    add_settings_section('floatyvids_main', 'Floatyvids Settings', null, 'floatyvids');

    add_settings_field('enabled', 'Enable Video Bubble', function () {
        $options = get_option('floatyvids_settings');
        $checked = isset($options['enabled']) ? checked(1, $options['enabled'], false) : '';
        echo '<input type="checkbox" name="floatyvids_settings[enabled]" value="1" ' . $checked . '>';
    }, 'floatyvids', 'floatyvids_main');

    add_settings_field('show_close', 'Show Close Button', function () {
        $options = get_option('floatyvids_settings');
        $checked = isset($options['show_close']) ? checked(1, $options['show_close'], false) : '';
        echo '<input type="checkbox" name="floatyvids_settings[show_close]" value="1" ' . $checked . '>';
    }, 'floatyvids', 'floatyvids_main');
}
add_action('admin_init', 'floatyvids_register_settings');

function floatyvids_settings_menu() {
    add_options_page('Floatyvids Settings', 'Floatyvids', 'manage_options', 'floatyvids', 'floatyvids_settings_page');
}
add_action('admin_menu', 'floatyvids_settings_menu');

function floatyvids_settings_page() {
    ?>
    <div class="wrap">
        <h1>Floatyvids Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('floatyvids_settings_group');
            do_settings_sections('floatyvids');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}
