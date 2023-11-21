<?php 
/**
 * CT Theme Options Setup
 * 
 * @package CT_Custom
 * 
 * 
 * Adding theme setup page
 * 
 */
 function ct_theme_setup() {
    add_menu_page(
        'CT Theme Options',
        'CT Theme Options',
        'manage_options',
        'ct_theme_options',
        'ct_theme_options_page',
        'dashicons-image-filter',
        58
    );
}
add_action( 'admin_menu', 'ct_theme_setup' );

function ct_theme_options_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    if ( isset( $_GET['settings-updated'] ) ) {
        
        add_settings_error(
            'ct_options_mesages',
            'ct_options_message',
            esc_html__( 'Settings Saved', 'ct-custom' ),
            'updated'
        );
    }

    


   /* if ( isset($_POST['upload_file']) ) {
        $upload = wp_upload_bits($_FILES['file']['name'], null, $_FILES['file']['tmp_name']);
        // save into database $upload['url]
    }*/

    settings_errors( 'ct_options_mesages' );
    ?>  
   
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post" enctype="multipart/form-data">
            <?php
                settings_fields( 'ct_options_group' );
                do_settings_sections( 'ct_options' );
                submit_button( 'Save Settings' );
            ?>
        </form>
    </div>
    <?php
}

function ct_register_settings() {
    // register_setting( 'ct_options_group', 'ct_options' );
    register_setting( 'ct_options_group', 'ct_options', [
	    'sanitize_callback' => 'ct_options_sanitize_fields',
	    'default'           => []
	] );

    add_settings_section(
        'ct_options_sections',
        false,
        false,
        'ct_options'
    );

    add_settings_field(
        'ct_option_logo',
        esc_html__( 'Upload Website Logo', 'ct-custom' ),
        'render_ct_theme_logo',
        'ct_options',
        'ct_options_sections',
        [
            'label_for' => 'ct_option_logo',
        ]
    );
    add_settings_field(
        'ct_option_phone',
        esc_html__( 'Phone Number', 'ct-custom' ),
        'render_ct_theme_phone',
        'ct_options',
        'ct_options_sections',
        [
            'label_for' => 'ct_option_phone',
        ]
    );
    add_settings_field(
        'ct_option_fax',
        esc_html__( 'Fax Number', 'ct-custom' ),
        'render_ct_theme_fax',
        'ct_options',
        'ct_options_sections',
        [
            'label_for' => 'ct_option_fax',
        ]
    );
    add_settings_field(
        'ct_option_address',
        esc_html__( 'Address', 'ct-custom' ),
        'render_ct_theme_address',
        'ct_options',
        'ct_options_sections',
        [
            'label_for' => 'ct_option_address',
        ]
    );
    add_settings_field(
        'ct_option_facebook_url',
        esc_html__( 'Facebook', 'ct-custom' ),
        'render_ct_theme_fb_url',
        'ct_options',
        'ct_options_sections',
        [
            'label_for' => 'ct_option_facebook_url',
        ]
    );
    add_settings_field(
        'ct_option_twitter_url',
        esc_html__( 'Twitter', 'ct-custom' ),
        'render_ct_theme_twitter_url',
        'ct_options',
        'ct_options_sections',
        [
            'label_for' => 'ct_option_twitter_url',
        ]
    );
    add_settings_field(
        'ct_option_linkedin_url',
        esc_html__( 'Linkedin', 'ct-custom' ),
        'render_ct_theme_linkedin_url',
        'ct_options',
        'ct_options_sections',
        [
            'label_for' => 'ct_option_linkedin_url',
        ]
    );
    add_settings_field(
        'ct_option_pinterest_url',
        esc_html__( 'Pinterest', 'ct-custom' ),
        'render_ct_theme_pinterest_url',
        'ct_options',
        'ct_options_sections',
        [
            'label_for' => 'ct_option_pinterest_url',
        ]
    );
}
add_action( 'admin_init', 'ct_register_settings' );
add_action( 'rest_api_init', 'ct_register_settings' );

/**
 * Sanitize fields.
 */
function ct_options_sanitize_fields( $value ) {
    $value = (array) $value;
    if ( ! empty( $value['ct_option_phone'] ) ) {
        $value['ct_option_phone'] = sanitize_text_field( $value['ct_option_phone'] );
    }
    if ( ! empty( $value['ct_option_address'] ) ) {
    	
        $str = $value['ct_option_address'];
		$arr = array( 'br' => array(), 'br /' => array(), 'p' => array(), 'strong' => array() );
		$value['ct_option_address'] = wp_kses( $str, $arr );
    }
    if ( ! empty( $value['ct_option_fax'] ) ) {
        $value['ct_option_fax'] = sanitize_text_field( $value['ct_option_fax'] );
    }
    if ( ! empty( $value['ct_option_facebook_url'] ) ) {
        $value['ct_option_facebook_url'] = sanitize_text_field( $value['ct_option_facebook_url'] );
    }
    if ( ! empty( $value['ct_option_twitter_url'] ) ) {
        $value['ct_option_twitter_url'] = sanitize_text_field( $value['ct_option_twitter_url'] );
    }
    if ( ! empty( $value['ct_option_linkedin_url'] ) ) {
        $value['ct_option_linkedin_url'] = sanitize_text_field( $value['ct_option_linkedin_url'] );
    }
    if ( ! empty( $value['ct_option_pinterest_url'] ) ) {
        $value['ct_option_pinterest_url'] = sanitize_text_field( $value['ct_option_pinterest_url'] );
    }
    return $value;
}


function render_ct_theme_logo( $args ) {
    $value = get_option( 'ct_options' )[$args['label_for']] ?? '';
    ?>

    <form method="post" enctype="multipart/form-data">
    	<input type="text" name="file" value="<?php $value ?>" required />
    	<!-- <input type="submit" name="upload_file" value="Upload" /> -->
	</form>
    <?php
}
function render_ct_theme_phone( $args ) {
    $value = get_option( 'ct_options' )[$args['label_for']] ?? '';
    ?>
    
    <input
        type="tel"
        id="<?php echo esc_attr( $args['label_for'] ); ?>"
        name="ct_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
        value="<?php echo esc_attr( $value ); ?>"
        size="50">
    <p class="description"><?php esc_html_e( 'Enter the phone number.', 'ct-custom' ); ?></p>
    <?php
}
function render_ct_theme_fax( $args ) {
    $value = get_option( 'ct_options' )[$args['label_for']] ?? '';
    ?>
    <input
        type="tel"
        id="<?php echo esc_attr( $args['label_for'] ); ?>"
        name="ct_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
        value="<?php echo esc_attr( $value ); ?>"
        size="50">
    <p class="description"><?php esc_html_e( 'Enter the fax number.', 'ct-custom' ); ?></p>
    <?php
}
function render_ct_theme_fb_url( $args ) {
    $value = get_option( 'ct_options' )[$args['label_for']] ?? '';
    ?>
    <input
        type="url"
        id="<?php echo esc_attr( $args['label_for'] ); ?>"
        name="ct_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
        value="<?php echo esc_url( $value ); ?>"
        size="50">
    <p class="description"><?php esc_html_e( 'Enter the Facebook link.', 'ct-custom' ); ?></p>
    <?php
}
function render_ct_theme_twitter_url( $args ) {
    $value = get_option( 'ct_options' )[$args['label_for']] ?? '';
    ?>
    <input
        type="url"
        id="<?php echo esc_attr( $args['label_for'] ); ?>"
        name="ct_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
        value="<?php echo esc_url( $value ); ?>"
        size="50">
    <p class="description"><?php esc_html_e( 'Enter the Twitter link.', 'ct-custom' ); ?></p>
    <?php
}
function render_ct_theme_linkedin_url( $args ) {
    $value = get_option( 'ct_options' )[$args['label_for']] ?? '';
    ?>
    <input
        type="url"
        id="<?php echo esc_attr( $args['label_for'] ); ?>"
        name="ct_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
        value="<?php echo esc_url( $value ); ?>"
        size="50">
    <p class="description"><?php esc_html_e( 'Enter the Linkedin link.', 'ct-custom' ); ?></p>
    <?php
}
function render_ct_theme_pinterest_url( $args ) {
    $value = get_option( 'ct_options' )[$args['label_for']] ?? '';
    ?>
    <input
        type="url"
        id="<?php echo esc_attr( $args['label_for'] ); ?>"
        name="ct_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
        value="<?php echo esc_url( $value ); ?>"
        size="50">
    <p class="description"><?php esc_html_e( 'Enter the Pinterest link.', 'ct-custom' ); ?></p>
    <?php
}
function render_ct_theme_address( $args ) {
    $value = get_option( 'ct_options' )[$args['label_for']] ?? '';
    ?>
    <textarea 
    id="<?php echo esc_attr( $args['label_for'] ); ?>" 
    name="ct_options[<?php echo esc_attr( $args['label_for'] ); ?>]"  
    rows="4" 
    cols="53">
    	<?php echo esc_attr( $value ); ?>
    </textarea>
    <p class="description"><?php esc_html_e( 'Enter your address.', 'ct-custom' ); ?></p>
    <?php
}
