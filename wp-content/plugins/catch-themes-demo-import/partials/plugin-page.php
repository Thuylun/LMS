<?php
/**
 * The plugin page view - the "settings" page of the plugin.
 *
 * @package ctdi
 */

namespace CTDI;

$predefined_themes = $this->import_files;

if ( ! empty( $this->import_files ) && isset( $_GET['import-mode'] ) && 'manual' === $_GET['import-mode'] ) {
	$predefined_themes = array();
}

?>

<div class="ctdi  wrap  about-wrap">

	<?php

	// Display warrning if PHP safe mode is enabled, since we wont be able to change the max_execution_time.
	if ( ini_get( 'safe_mode' ) ) {
		printf(
			esc_html__( '%sWarning: your server is using %sPHP safe mode%s. This means that you might experience server timeout errors.%s', 'catch-themes-demo-import' ),
			'<div class="notice  notice-warning  is-dismissible"><p>',
			'<strong>',
			'</strong>',
			'</p></div>'
		);
	}

	// Start output buffer for displaying the plugin intro text.
	ob_start();
	?>

	<div class="ctdi__intro-notice  notice  notice-warning  is-dismissible">
		<p><?php esc_html_e( 'Before you begin, make sure all the required plugins are activated.', 'catch-themes-demo-import' ); ?></p>
	</div>

	<div class="ctdi__intro-text">
		<p class="about-description">
			<?php esc_html_e( 'Importing demo data (post, pages, images, theme settings, ...) is the easiest way to setup your theme.', 'catch-themes-demo-import' ); ?>
			<?php esc_html_e( 'It will allow you to quickly edit everything instead of creating content from scratch.', 'catch-themes-demo-import' ); ?>
		</p>

		<hr>

		<p><?php esc_html_e( 'When you import the data, the following things might happen:', 'catch-themes-demo-import' ); ?></p>

		<ul>
			<li><?php esc_html_e( 'No existing posts, pages, categories, images, custom post types or any other data will be deleted or modified.', 'catch-themes-demo-import' ); ?></li>
			<li><?php esc_html_e( 'Posts, pages, images, widgets, menus and other theme settings will get imported.', 'catch-themes-demo-import' ); ?></li>
			<li><?php esc_html_e( 'Please click on the Import button only once and wait, it can take a couple of minutes.', 'catch-themes-demo-import' ); ?></li>
		</ul>

		<?php if ( ! empty( $this->import_files ) ) : ?>
			<?php if ( empty( $_GET['import-mode'] ) || 'manual' !== $_GET['import-mode'] ) : ?>
				<a href="<?php echo esc_url( add_query_arg( array( 'page' => $this->plugin_page_setup['menu_slug'], 'import-mode' => 'manual' ), admin_url( $this->plugin_page_setup['parent_slug'] ) ) ); ?>" class="ctdi__import-mode-switch"><?php esc_html_e( 'Switch to manual import!', 'catch-themes-demo-import' ); ?></a>
			<?php else : ?>
				<a href="<?php echo esc_url( add_query_arg( array( 'page' => $this->plugin_page_setup['menu_slug'] ), admin_url( $this->plugin_page_setup['parent_slug'] ) ) ); ?>" class="ctdi__import-mode-switch"><?php esc_html_e( 'Switch back to theme predefined imports!', 'catch-themes-demo-import' ); ?></a>
			<?php endif; ?>
		<?php endif; ?>

		<hr>
	</div>

	<?php
	$plugin_intro_text = ob_get_clean();

	// Display the plugin intro text (can be replaced with custom text through the filter below).
	echo wp_kses_post( apply_filters( 'cp-ctdi/plugin_intro_text', $plugin_intro_text ) );
	?>

	<?php if ( empty( $this->import_files ) ) : ?>
		<div class="notice  notice-info  is-dismissible">
			<p><?php esc_html_e( 'There are no predefined import files available in this theme. Please upload the import files manually!', 'catch-themes-demo-import' ); ?></p>
		</div>
	<?php endif; ?>

	<?php if ( empty( $predefined_themes ) ) : ?>

		<div class="ctdi__file-upload-container">
			<h2><?php esc_html_e( 'Manual demo files upload', 'catch-themes-demo-import' ); ?></h2>

			<div class="ctdi__file-upload">
				<h3><label for="content-file-upload"><?php esc_html_e( 'Choose a XML file for content import:', 'catch-themes-demo-import' ); ?></label></h3>
				<input id="ctdi__content-file-upload" type="file" name="content-file-upload">
			</div>

			<div class="ctdi__file-upload">
				<h3><label for="widget-file-upload"><?php esc_html_e( 'Choose a WIE or JSON file for widget import:', 'catch-themes-demo-import' ); ?></label></h3>
				<input id="ctdi__widget-file-upload" type="file" name="widget-file-upload">
			</div>

			<div class="ctdi__file-upload">
				<h3><label for="customizer-file-upload"><?php esc_html_e( 'Choose a DAT file for customizer import:', 'catch-themes-demo-import' ); ?></label></h3>
				<input id="ctdi__customizer-file-upload" type="file" name="customizer-file-upload">
			</div>

			<?php if ( class_exists( 'ReduxFramework' ) ) : ?>
			<div class="ctdi__file-upload">
				<h3><label for="redux-file-upload"><?php esc_html_e( 'Choose a JSON file for Redux import:', 'catch-themes-demo-import' ); ?></label></h3>
				<input id="ctdi__redux-file-upload" type="file" name="redux-file-upload">
				<div>
					<label for="redux-option-name" class="ctdi__redux-option-name-label"><?php esc_html_e( 'Enter the Redux option name:', 'catch-themes-demo-import' ); ?></label>
					<input id="ctdi__redux-option-name" type="text" name="redux-option-name">
				</div>
			</div>
			<?php endif; ?>
		</div>

		<p class="ctdi__button-container">
			<button class="ctdi__button  button  button-hero  button-primary  js-ctdi-import-data"><?php esc_html_e( 'Import Demo Data', 'catch-themes-demo-import' ); ?></button>
		</p>

	<?php elseif ( 1 === count( $predefined_themes ) ) : ?>

		<div class="ctdi__demo-import-notice  js-ctdi-demo-import-notice"><?php
			if ( is_array( $predefined_themes ) && ! empty( $predefined_themes[0]['import_notice'] ) ) {
				echo wp_kses_post( $predefined_themes[0]['import_notice'] );
			}
		?></div>

		<p class="ctdi__button-container">
			<button class="ctdi__button  button  button-hero  button-primary  js-ctdi-import-data"><?php esc_html_e( 'Import Demo Data', 'catch-themes-demo-import' ); ?></button>
		</p>

	<?php else : ?>

		<!-- CTDI grid layout -->
		<div class="ctdi__gl  js-ctdi-gl">
		<?php
			// Prepare navigation data.
			$categories = Helpers::get_all_demo_import_categories( $predefined_themes );
		?>
			<?php if ( ! empty( $categories ) ) : ?>
				<div class="ctdi__gl-header  js-ctdi-gl-header">
					<nav class="ctdi__gl-navigation">
						<ul>
							<li class="active"><a href="#all" class="ctdi__gl-navigation-link  js-ctdi-nav-link"><?php esc_html_e( 'All', 'catch-themes-demo-import' ); ?></a></li>
							<?php foreach ( $categories as $key => $name ) : ?>
								<li><a href="#<?php echo esc_attr( $key ); ?>" class="ctdi__gl-navigation-link  js-ctdi-nav-link"><?php echo esc_html( $name ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					</nav>
					<div clas="ctdi__gl-search">
						<input type="search" class="ctdi__gl-search-input  js-ctdi-gl-search" name="ctdi-gl-search" value="" placeholder="<?php esc_html_e( 'Search demos...', 'catch-themes-demo-import' ); ?>">
					</div>
				</div>
			<?php endif; ?>
			<div class="ctdi__gl-item-container  wp-clearfix  js-ctdi-gl-item-container">

				<?php
				foreach ( $predefined_themes as $index => $import_file ) : ?>
					<?php
						// Prepare import item display data.
						$img_src = isset( $import_file['import_preview_image_url'] ) ? $import_file['import_preview_image_url'] : '';
						
						// Default to the theme screenshot, if a custom preview image is not defined.
						$theme = wp_get_theme();
						
						if ( empty( $img_src ) ) {
							$img_src = $theme->get_screenshot();
						}
					?>
					<div class="ctdi__gl-item js-ctdi-gl-item" data-categories="<?php echo esc_attr( Helpers::get_demo_import_item_categories( $import_file ) ); ?>" data-name="<?php echo esc_attr( strtolower( $import_file['import_file_name'] ) ); ?>">
						<div class="ctdi__gl-item-image-container">
							<?php if ( ! empty( $img_src ) ) : ?>
								<img class="ctdi__gl-item-image" src="<?php echo esc_url( $img_src ) ?>">
							<?php else : ?>
								<div class="ctdi__gl-item-image  ctdi__gl-item-image--no-image"><?php esc_html_e( 'No preview image.', 'catch-themes-demo-import' ); ?></div>
							<?php endif; ?>
						</div>
						<div class="ctdi__gl-item-footer<?php echo ! empty( $import_file['preview_url'] ) ? '  ctdi__gl-item-footer--with-preview' : ''; ?>">
							<h4 class="ctdi__gl-item-title" title="<?php echo esc_attr( $import_file['import_file_name'] ); ?>"><?php echo esc_html( $import_file['import_file_name'] ); ?></h4>
							
							<?php 
							// Add But url for themes whose author is Catch Themes && the import array is not for free && is not pro theme.
							if ( 'Catch Themes' === $theme->get( 'Author' ) && false === strpos( $import_file['import_file_name'], 'Free' ) && false === strpos( $theme->get( 'TextDomain' ), '-pro' ) && 'cleanportfoliopro' !== $theme->get( 'TextDomain' ) ) : 
								$pro_theme_url = "https://catchthemes.com/themes/" . $theme->get( 'TextDomain' ) . "-pro";
								?>
								<a class="ctdi__gl-item-button buy-now  button" href="<?php echo esc_url( $pro_theme_url ); ?>" target="_blank"><?php esc_html_e( 'Buy Now', 'catch-themes-demo-import' ); ?></a>
							<?php else : ?>
								<button class="ctdi__gl-item-button  button  button-primary  js-ctdi-gl-import-data" value="<?php echo esc_attr( $index ); ?>"><?php esc_html_e( 'Import', 'catch-themes-demo-import' ); ?></button>
							<?php endif; ?>
							
							<?php if ( ! empty( $import_file['preview_url'] ) ) : ?>
								<a class="ctdi__gl-item-button  button" href="<?php echo esc_url( $import_file['preview_url'] ); ?>" target="_blank"><?php esc_html_e( 'Preview', 'catch-themes-demo-import' ); ?></a>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<div id="js-ctdi-modal-content"></div>

	<?php endif; ?>

	<p class="ctdi__ajax-loader  js-ctdi-ajax-loader">
		<span class="spinner"></span> <?php esc_html_e( 'Importing, please wait!', 'catch-themes-demo-import' ); ?>
	</p>

	<div class="ctdi__response  js-ctdi-ajax-response"></div>
</div>
