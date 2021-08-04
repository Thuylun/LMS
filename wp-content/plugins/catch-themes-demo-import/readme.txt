=== Catch Themes Demo Import ===
Contributors: catchplugins, catchthemes, sakinshrestha, pratikshrestha, maheshmaharjan, dreamsapana
Donate link: https://catchplugins.com/plugins/catch-themes-demo-import/
Tags: import, content, demo, data, widgets, settings, redux, theme options
Requires at least: 5.1
Requires PHP: 5.6
Tested up to: 5.7
Stable tag: trunk
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.txt

Catch Themes Demo Import is a simple and easy-to-use demo importer WordPress plugin that allows you to import the theme demo data (design and content placement) you desire in just a single click.

Based on One Click Demo Import https://wordpress.org/plugins/one-click-demo-import/

== Description ==

Catch Themes Demo Import is a free demo importer WordPress plugin that lets you import the demo you desire in just a single click. The plugin works out of the box; all you have to do is install and activate the plugin and all the demos available on your currently used theme will be on your fingertips (visit **Appearance=> Import Demo Data**). If the theme doesn’t have any predefined import files, you’ll have to upload three files – a demo content XML file for content import, a WIE/JSON file for widget import, and a DAT file for customizer import. With the plugin activated, whether you have predefined demo files available or not, you’ll be able to import demos on your website without any hesitancy. Download Catch Themes Demo Import today and start importing theme demos to your website without affecting your wallet!

> **Are you a theme author?**
>
> Setup Catch Themes Demo Import for your theme and your users will thank you for it!

This plugin will create a submenu page under Appearance with the title **Import demo data**.

If the theme you are using does not have any predefined import files, then you will be presented with three file upload inputs. First one is required and you will have to upload a demo content XML file, for the actual demo import. The second one is optional and will ask you for a WIE or JSON file for widgets import. You create that file using the [Widget Importer & Exporter](https://wordpress.org/plugins/widget-importer-exporter/) plugin. The third one is also optional and will import the customizer settings, select the DAT file which you can generate from [Catch Import Export](https://wordpress.org/plugins/catch-import-export/) plugin (the customizer settings will be imported only if the export file was created from the same theme). The final one is optional as well and will import your Redux framework settings. You can generate the export json file with the [Redux framework](https://wordpress.org/plugins/redux-framework/) plugin.

This plugin is using the improved WP import 2.0 that is still in development and can be found here: https://github.com/humanmade/WordPress-Importer.

All progress of this plugin's work is logged in a log file in the default WP upload directory, together with the demo import files used in the importing process.

NOTE: There is no setting to "connect" authors from the demo import file to the existing users in your WP site (like there is in the original WP Importer plugin). All demo content will be imported under the current user.

== Screenshots ==

1. Example of multiple predefined demo imports.
2. Example of how manual import page looks like.

== Installation ==

The easy way (via Dashboard) :

* Go to Plugins > Add New
* Type in the **Catch Themes Demo Import** in Search Plugins box
* Click Install Now to install the plugin
* After Installation click activate to start using the **Catch Themes Demo Import**
* Go to **Catch Themes Demo Import** from Dashboard -> Appearance -> Import Demo Data menu

Not so easy way (via FTP) :

* Download the **Catch Themes Demo Import**
* Unarchive **Catch Themes Demo Import** plugin
* Copy folder with catch-themes-demo-import.zip
* Open the ftp \wp-content\plugins\
* Paste the plug-ins folder in the folder
* Go to admin panel => open item "Plugins" => activate **Catch Themes Demo Import**
* Go to **Catch Themes Demo Import** from Dashboard -> Appearance -> Import Demo Data menu

== Frequently Asked Questions ==

= I have activated the plugin. Where is the "Import Demo Data" page? =

You will find the import page in *wp-admin -> Appearance -> Catch Themes Demo Import*.

= Where are the demo import files and the log files saved? =

The files used in the demo import will be saved to the default WordPress uploads directory. An example of that directory would be: `../wp-content/uploads/2016/03/`.

The log file will also be registered in the *wp-admin -> Media* section, so you can access it easily.

= How to predefine demo imports? =

This question is for theme authors. To predefine demo imports, you just have to add the following code structure, with your own values to your theme (using the `cp-ctdi/import_files` filter):

`
function ctdi_import_files() {
	return array(
		array(
			'import_file_name'           => 'Demo Import 1',
			'categories'                 => array( 'Category 1', 'Category 2' ),
			'import_file_url'            => 'http://www.your_domain.com/ctdi/demo-content.xml',
			'import_widget_file_url'     => 'http://www.your_domain.com/ctdi/widgets.json',
			'import_customizer_file_url' => 'http://www.your_domain.com/ctdi/customizer.dat',
			'import_redux'               => array(
				array(
					'file_url'    => 'http://www.your_domain.com/ctdi/redux.json',
					'option_name' => 'redux_option_name',
				),
			),
			'import_preview_image_url'   => 'http://www.your_domain.com/ctdi/preview_import_image1.jpg',
			'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'your-textdomain' ),
			'preview_url'                => 'http://www.your_domain.com/my-demo-1',
		),
		array(
			'import_file_name'           => 'Demo Import 2',
			'categories'                 => array( 'New category', 'Old category' ),
			'import_file_url'            => 'http://www.your_domain.com/ctdi/demo-content2.xml',
			'import_widget_file_url'     => 'http://www.your_domain.com/ctdi/widgets2.json',
			'import_customizer_file_url' => 'http://www.your_domain.com/ctdi/customizer2.dat',
			'import_redux'               => array(
				array(
					'file_url'    => 'http://www.your_domain.com/ctdi/redux.json',
					'option_name' => 'redux_option_name',
				),
				array(
					'file_url'    => 'http://www.your_domain.com/ctdi/redux2.json',
					'option_name' => 'redux_option_name_2',
				),
			),
			'import_preview_image_url'   => 'http://www.your_domain.com/ctdi/preview_import_image2.jpg',
			'import_notice'              => __( 'A special note for this import.', 'your-textdomain' ),
			'preview_url'                => 'http://www.your_domain.com/my-demo-2',
		),
	);
}
add_filter( 'cp-ctdi/import_files', 'ctdi_import_files' );
`

You can set content import, widgets, customizer and Redux framework import files. You can also define a preview image, which will be used only when multiple demo imports are defined, so that the user will see the difference between imports. Categories can be assigned to each demo import, so that they can be filtered easily. The preview URL will display the "Preview" button in the predefined demo item, which will open this URL in a new tab and user can view how the demo site looks like.

= How to automatically assign "Front page", "Posts page" and menu locations after the importer is done? =

You can do that, with the `cp-ctdi/after_import` action hook. The code would look something like this:

`
function ctdi_after_import_setup() {
	// Assign menus to their locations.
	$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'main-menu' => $main_menu->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Home' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'cp-ctdi/after_import', 'ctdi_after_import_setup' );
`

= What about using local import files (from theme folder)? =

You have to use the same filter as in above example, but with a slightly different array keys: `local_*`. The values have to be absolute paths (not URLs) to your import files. To use local import files, that reside in your theme folder, please use the below code. Note: make sure your import files are readable!

`
function ctdi_import_files() {
	return array(
		array(
			'import_file_name'             => 'Demo Import 1',
			'categories'                   => array( 'Category 1', 'Category 2' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'ctdi/demo-content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'ctdi/widgets.json',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'ctdi/customizer.dat',
			'local_import_redux'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'ctdi/redux.json',
					'option_name' => 'redux_option_name',
				),
			),
			'import_preview_image_url'     => 'http://www.your_domain.com/ctdi/preview_import_image1.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'your-textdomain' ),
			'preview_url'                  => 'http://www.your_domain.com/my-demo-1',
		),
		array(
			'import_file_name'             => 'Demo Import 2',
			'categories'                   => array( 'New category', 'Old category' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'ctdi/demo-content2.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'ctdi/widgets2.json',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'ctdi/customizer2.dat',
			'local_import_redux'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'ctdi/redux.json',
					'option_name' => 'redux_option_name',
				),
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'ctdi/redux2.json',
					'option_name' => 'redux_option_name_2',
				),
			),
			'import_preview_image_url'     => 'http://www.your_domain.com/ctdi/preview_import_image2.jpg',
			'import_notice'                => __( 'A special note for this import.', 'your-textdomain' ),
			'preview_url'                  => 'http://www.your_domain.com/my-demo-2',
		),
	);
}
add_filter( 'cp-ctdi/import_files', 'ctdi_import_files' );
`

= How to handle different "after import setups" depending on which predefined import was selected? =

This question might be asked by a theme author wanting to implement different after import setups for multiple predefined demo imports. Lets say we have predefined two demo imports with the following names: 'Demo Import 1' and 'Demo Import 2', the code for after import setup would be (using the `cp-ctdi/after_import` filter):

`
function ctdi_after_import( $selected_import ) {
	echo "This will be displayed on all after imports!";

	if ( 'Demo Import 1' === $selected_import['import_file_name'] ) {
		echo "This will be displayed only on after import if user selects Demo Import 1";

		// Set logo in customizer
		set_theme_mod( 'logo_img', get_template_directory_uri() . '/assets/images/logo1.png' );
	}
	elseif ( 'Demo Import 2' === $selected_import['import_file_name'] ) {
		echo "This will be displayed only on after import if user selects Demo Import 2";

		// Set logo in customizer
		set_theme_mod( 'logo_img', get_template_directory_uri() . '/assets/images/logo2.png' );
	}
}
add_action( 'cp-ctdi/after_import', 'ctdi_after_import' );
`

= Can I add some code before the widgets get imported? =

Of course you can, use the `cp-ctdi/before_widgets_import` action. You can also target different predefined demo imports like in the example above. Here is a simple example code of the `cp-ctdi/before_widgets_import` action:

`
function ctdi_before_widgets_import( $selected_import ) {
	echo "Add your code here that will be executed before the widgets get imported!";
}
add_action( 'cp-ctdi/before_widgets_import', 'ctdi_before_widgets_import' );
`

= How can I import via the WP-CLI? =

In the 2.4.0 version of this pugin we added two WP-CLI commands:

* `wp ctdi list` - Which will list any predefined demo imports currently active theme might have,
* `wp ctdi import` - which has a few options that you can use to import the things you want (content/widgets/customizer/predefined demos). Let's look at these options below.

`wp ctdi import` options:

`wp ctdi import [--content=<file>] [--widgets=<file>] [--customizer=<file>] [--predefined=<index>]`

* `--content=<file>` - will run the content import with the WP import file specified in the `<file>` parameter,
* `--widgets=<file>` - will run the widgets import with the widgets import file specified in the `<file>` parameter,
* `--customizer=<file>` - will run the customizer settings import with the customizer import file specified in the `<file>` parameter,
* `--predefined=<index>` - will run the theme predefined import with the index of the predefined import in the `<index>` parameter (you can use the `wp ctdi list` command to check which index is used for each predefined demo import)

The content, widgets and customizer options can be mixed and used at the same time. If the `predefined` option is set, then it will ignore all other options and import the predefined demo data.

= I'm a theme author and I want to change the plugin intro text, how can I do that? =

You can change the plugin intro text by using the `cp-ctdi/plugin_intro_text` filter:

`
function ctdi_plugin_intro_text( $default_text ) {
	$default_text .= '<div class="ctdi__intro-text">This is a custom text added to this plugin intro text.</div>';

	return $default_text;
}
add_filter( 'cp-ctdi/plugin_intro_text', 'ctdi_plugin_intro_text' );
`

To add some text in a separate "box", you should wrap your text in a div with a class of 'ctdi__intro-text', like in the code example above.

= How to disable generation of smaller images (thumbnails) during the content import =

This will greatly improve the time needed to import the content (images), but only the original sized images will be imported. You can disable it with a filter, so just add this code to your theme function.php file:

`add_filter( 'cp-ctdi/regenerate_thumbnails_in_content_import', '__return_false' );`

= How to change the location, title and other parameters of the plugin page? =

As a theme author you do not like the location of the "Import Demo Data" plugin page in *Appearance -> Import Demo Data*? You can change that with the filter below. Apart from the location, you can also change the title or the page/menu and some other parameters as well.

`
function ctdi_plugin_page_setup( $default_settings ) {
	$default_settings['parent_slug'] = 'themes.php';
	$default_settings['page_title']  = esc_html__( 'Catch Themes Demo Import' , 'catch-themes-demo-import' );
	$default_settings['menu_title']  = esc_html__( 'Catch Themes Demo Import' , 'catch-themes-demo-import' );
	$default_settings['capability']  = 'import';
	$default_settings['menu_slug']   = 'catch-themes-demo-import';

	return $default_settings;
}
add_filter( 'cp-ctdi/plugin_page_setup', 'ctdi_plugin_page_setup' );
`

= How to do something before the content import executes? =

In version 2.0.0 there is a new action hook: `cp-ctdi/before_content_import`, which will let you hook before the content import starts. An example of the code would look like this:

`
function ctdi_before_content_import( $selected_import ) {
	if ( 'Demo Import 1' === $selected_import['import_file_name'] ) {
		// Here you can do stuff for the "Demo Import 1" before the content import starts.
		echo "before import 1";
	}
	else {
		// Here you can do stuff for all other imports before the content import starts.
		echo "before import 2";
	}
}
add_action( 'cp-ctdi/before_content_import', 'ctdi_before_content_import' );
`

= How can I enable the `customize_save*` wp action hooks in the customizer import? =

It's easy, just add this to your theme:

`add_action( 'cp-ctdi/enable_wp_customize_save_hooks', '__return_true' );`

This will enable the following WP hooks when importing the customizer data: `customize_save`, `customize_save_*`, `customize_save_after`.


= How to configure the multi grid layout import popup confirmation? =

If you want to disable the popup confirmation modal window, use this filter:

`add_filter( 'cp-ctdi/enable_grid_layout_import_popup_confirmation', '__return_false' );`

If you want to just change some options for the jQuery modal window we use for the popup confirmation, then use this filter:

`
function my_theme_ctdi_confirmation_dialog_options ( $options ) {
	return array_merge( $options, array(
		'width'       => 300,
		'dialogClass' => 'wp-dialog',
		'resizable'   => false,
		'height'      => 'auto',
		'modal'       => true,
	) );
}
add_filter( 'cp-ctdi/confirmation_dialog_options', 'my_theme_ctdi_confirmation_dialog_options', 10, 1 );
`

== Changelog ==

= 1.4.9 (Released: March 31, 2021) =
* Bug Fixed: Localize variable initial value set to empty array

= 1.4.8 (Released: March 07, 2021) =
* Compatibility check up to version 5.7

= 1.4.7 (Released: February 25, 2021) =
* Bug Fixed: Issue with function scope in PHP 8

= 1.4.6 (Released: August 19, 2020) =
* Bug Fixed: Support for Clean Portfolio Pro theme
* Bug Fixed: Issue in add new theme page

= 1.4.5 (Released: June 23, 2020) =
* Removed: Unnecessary codes
* Updated: Composer autoload for includes
* Updated: Import array content delivery for themes from CatchThemes

= 1.4.4 (Released: April 27, 2020) =
* Added: Support pre-defined demo for child themes

= 1.4.3 (Released: March 25, 2020) =
* Bug Fixed: Issue on TGM plugin activation
* Bug Fixed: Function name changed to avoid function already exists issue

= 1.4.2 (Released: March 12, 2020) =
* Compatibility check up to version 5.4
* Updated: ECT activated dialogue box

= 1.4.1 (Released: February 10, 2020) =
* Bug Fixed: JS error on admin
* Bug Fixed: Minor CSS issue

= 1.4 (Released: January 08, 2020) =
* Bug Fixed: Sort themes only if array given

= 1.3 (Released: January 07, 2020) =
* Bug Fixed: Error if demo cannot be fetched
* Update: Transient clear set to 1 day

= 1.2 (Released: October 19, 2019) =
* Added: Flush transient on theme switch
* Bug Fixed: Warning: Invalid argument supplied for foreach()
* Compatibility check up to version 5.3
* Updated: Code optimization

= 1.1 (Released: September 11, 2019) =
* Added: Include demo for Themes by Catch Themes
* Added: Option to turn off Catch Themes and Catch Plugins tabs
* Added: Redirect to demo import page after activation
* Bug Fixed: Import page Design Issue
* Compatibility check up to version 5.2
* Updated: Changed menu item name to Catch Themes Demo Import

= 1.0.1 (Released: March 27, 2019) =
* Removed: Unnecessary codes
* Updated: Code Optimizaion
* Updated: Catch Themes and Catch Plugins tabs displaying code

= 1.0.0 (Released: February 28, 2019) =
* Initial release
