jQuery( function ( $ ) {
	'use strict';

	/**
	 * ---------------------------------------
	 * ------------- Events ------------------
	 * ---------------------------------------
	 */

	/**
	 * No or Single predefined demo import button click.
	 */
	$( '.js-ctdi-import-data' ).on( 'click', function () {

		// Reset response div content.
		$( '.js-ctdi-ajax-response' ).empty();

		// Prepare data for the AJAX call
		var data = new FormData();
		data.append( 'action', 'ctdi_import_demo_data' );
		data.append( 'security', ctdi.ajax_nonce );
		data.append( 'selected', $( '#ctdi__demo-import-files' ).val() );
		if ( $('#ctdi__content-file-upload').length ) {
			data.append( 'content_file', $('#ctdi__content-file-upload')[0].files[0] );
		}
		if ( $('#ctdi__widget-file-upload').length ) {
			data.append( 'widget_file', $('#ctdi__widget-file-upload')[0].files[0] );
		}
		if ( $('#ctdi__customizer-file-upload').length ) {
			data.append( 'customizer_file', $('#ctdi__customizer-file-upload')[0].files[0] );
		}
		if ( $('#ctdi__redux-file-upload').length ) {
			data.append( 'redux_file', $('#ctdi__redux-file-upload')[0].files[0] );
			data.append( 'redux_option_name', $('#ctdi__redux-option-name').val() );
		}

		// AJAX call to import everything (content, widgets, before/after setup)
		ajaxCall( data );

	});


	/**
	 * Grid Layout import button click.
	 */
	$( '.js-ctdi-gl-import-data' ).on( 'click', function () {
		var selectedImportID = $( this ).val();
		var $itemContainer   = $( this ).closest( '.js-ctdi-gl-item' );

		// If the import confirmation is enabled, then do that, else import straight away.
		if ( ctdi.import_popup ) {
			displayConfirmationPopup( selectedImportID, $itemContainer );
		}
		else {
			gridLayoutImport( selectedImportID, $itemContainer );
		}
	});


	/**
	 * Grid Layout categories navigation.
	 */
	(function () {
		// Cache selector to all items
		var $items = $( '.js-ctdi-gl-item-container' ).find( '.js-ctdi-gl-item' ),
			fadeoutClass = 'ctdi-is-fadeout',
			fadeinClass = 'ctdi-is-fadein',
			animationDuration = 200;

		// Hide all items.
		var fadeOut = function () {
			var dfd = jQuery.Deferred();

			$items
				.addClass( fadeoutClass );

			setTimeout( function() {
				$items
					.removeClass( fadeoutClass )
					.hide();

				dfd.resolve();
			}, animationDuration );

			return dfd.promise();
		};

		var fadeIn = function ( category, dfd ) {
			var filter = category ? '[data-categories*="' + category + '"]' : 'div';

			if ( 'all' === category ) {
				filter = 'div';
			}

			$items
				.filter( filter )
				.show()
				.addClass( 'ctdi-is-fadein' );

			setTimeout( function() {
				$items
					.removeClass( fadeinClass );

				dfd.resolve();
			}, animationDuration );
		};

		var animate = function ( category ) {
			var dfd = jQuery.Deferred();

			var promise = fadeOut();

			promise.done( function () {
				fadeIn( category, dfd );
			} );

			return dfd;
		};

		$( '.js-ctdi-nav-link' ).on( 'click', function( event ) {
			event.preventDefault();

			// Remove 'active' class from the previous nav list items.
			$( this ).parent().siblings().removeClass( 'active' );

			// Add the 'active' class to this nav list item.
			$( this ).parent().addClass( 'active' );

			var category = this.hash.slice(1);

			// show/hide the right items, based on category selected
			var $container = $( '.js-ctdi-gl-item-container' );
			$container.css( 'min-width', $container.outerHeight() );

			var promise = animate( category );

			promise.done( function () {
				$container.removeAttr( 'style' );
			} );
		} );
	}());


	/**
	 * Grid Layout search functionality.
	 */
	$( '.js-ctdi-gl-search' ).on( 'keyup', function( event ) {
		if ( 0 < $(this).val().length ) {
			// Hide all items.
			$( '.js-ctdi-gl-item-container' ).find( '.js-ctdi-gl-item' ).hide();

			// Show just the ones that have a match on the import name.
			$( '.js-ctdi-gl-item-container' ).find( '.js-ctdi-gl-item[data-name*="' + $(this).val().toLowerCase() + '"]' ).show();
		}
		else {
			$( '.js-ctdi-gl-item-container' ).find( '.js-ctdi-gl-item' ).show();
		}
	} );

	/**
	 * ---------------------------------------
	 * --------Helper functions --------------
	 * ---------------------------------------
	 */

	/**
	 * Prepare grid layout import data and execute the AJAX call.
	 *
	 * @param int selectedImportID The selected import ID.
	 * @param obj $itemContainer The jQuery selected item container object.
	 */
	function gridLayoutImport( selectedImportID, $itemContainer ) {
		// Reset response div content.
		$( '.js-ctdi-ajax-response' ).empty();

		// Hide all other import items.
		$itemContainer.siblings( '.js-ctdi-gl-item' ).fadeOut( 500 );

		$itemContainer.animate({
			opacity: 0
		}, 500, 'swing', function () {
			$itemContainer.animate({
				opacity: 1
			}, 500 )
		});

		// Hide the header with category navigation and search box.
		$itemContainer.closest( '.js-ctdi-gl' ).find( '.js-ctdi-gl-header' ).fadeOut( 500 );

		// Append a title for the selected demo import.
		$itemContainer.parent().prepend( '<h3>' + ctdi.texts.selected_import_title + '</h3>' );

		// Remove the import button of the selected item.
		$itemContainer.find( '.js-ctdi-gl-import-data' ).remove();

		// Prepare data for the AJAX call
		var data = new FormData();
		data.append( 'action', 'ctdi_import_demo_data' );
		data.append( 'security', ctdi.ajax_nonce );
		data.append( 'selected', selectedImportID );

		// AJAX call to import everything (content, widgets, before/after setup)
		ajaxCall( data );
	}

	/**
	 * Display the confirmation popup.
	 *
	 * @param int selectedImportID The selected import ID.
	 * @param obj $itemContainer The jQuery selected item container object.
	 */
	function displayConfirmationPopup( selectedImportID, $itemContainer ) {
		var $dialogContiner         = $( '#js-ctdi-modal-content' );
		var currentFilePreviewImage = ctdi.import_files[ selectedImportID ]['import_preview_image_url'] || ctdi.theme_screenshot;
		var previewImageContent     = '';
		var importNotice            = ctdi.import_files[ selectedImportID ]['import_notice'] || '';
		var importNoticeContent     = '';
		var dialogOptions           = $.extend(
			{
				'dialogClass': 'wp-dialog',
				'resizable':   false,
				'height':      'auto',
				'modal':       true
			},
			ctdi.dialog_options,
			{
				'buttons':
				[
					{
						text: ctdi.texts.dialog_no,
						click: function() {
							$(this).dialog('close');
						}
					},
					{
						text: ctdi.texts.dialog_yes,
						class: 'button  button-primary',
						click: function() {
							$(this).dialog('close');
							gridLayoutImport( selectedImportID, $itemContainer );
						}
					}
				]
			});

		if ( '' === currentFilePreviewImage ) {
			previewImageContent = '<p>' + ctdi.texts.missing_preview_image + '</p>';
		}
		else {
			previewImageContent = '<div class="ctdi__modal-image-container"><img src="' + currentFilePreviewImage + '" alt="' + ctdi.import_files[ selectedImportID ]['import_file_name'] + '"></div>'
		}

		// Prepare notice output.
		if( '' !== importNotice ) {
			importNoticeContent = '<div class="ctdi__modal-notice  ctdi__demo-import-notice">' + importNotice + '</div>';
		}

		// Populate the dialog content.
		$dialogContiner.prop( 'title', ctdi.texts.dialog_title );
		$dialogContiner.html(
			'<p class="ctdi__modal-item-title">' + ctdi.import_files[ selectedImportID ]['import_file_name'] + '</p>' +
			previewImageContent +
			importNoticeContent
		);

		// Display the confirmation popup.
		$dialogContiner.dialog( dialogOptions );
	}

	/**
	 * The main AJAX call, which executes the import process.
	 *
	 * @param FormData data The data to be passed to the AJAX call.
	 */
	function ajaxCall( data ) {
		$.ajax({
			method:      'POST',
			url:         ctdi.ajax_url,
			data:        data,
			contentType: false,
			processData: false,
			beforeSend:  function() {
				$( '.js-ctdi-ajax-loader' ).show();
			}
		})
		.done( function( response ) {
			if ( 'undefined' !== typeof response.status && 'newAJAX' === response.status ) {
				ajaxCall( data );
			}
			else if ( 'undefined' !== typeof response.status && 'customizerAJAX' === response.status ) {
				// Fix for data.set and data.delete, which they are not supported in some browsers.
				var newData = new FormData();
				newData.append( 'action', 'ctdi_import_customizer_data' );
				newData.append( 'security', ctdi.ajax_nonce );

				// Set the wp_customize=on only if the plugin filter is set to true.
				if ( true === ctdi.wp_customize_on ) {
					newData.append( 'wp_customize', 'on' );
				}

				ajaxCall( newData );
			}
			else if ( 'undefined' !== typeof response.status && 'afterAllImportAJAX' === response.status ) {
				// Fix for data.set and data.delete, which they are not supported in some browsers.
				var newData = new FormData();
				newData.append( 'action', 'ctdi_after_import_data' );
				newData.append( 'security', ctdi.ajax_nonce );
				ajaxCall( newData );
			}
			else if ( 'undefined' !== typeof response.message ) {
				$( '.js-ctdi-ajax-response' ).append( '<p>' + response.message + '</p>' );
				$( '.js-ctdi-ajax-loader' ).hide();

				// Trigger custom event, when CTDI import is complete.
				$( document ).trigger( 'ctdiImportComplete' );
			}
			else {
				$( '.js-ctdi-ajax-response' ).append( '<div class="notice  notice-error  is-dismissible"><p>' + response + '</p></div>' );
				$( '.js-ctdi-ajax-loader' ).hide();
			}
		})
		.fail( function( error ) {
			$( '.js-ctdi-ajax-response' ).append( '<div class="notice  notice-error  is-dismissible"><p>Error: ' + error.statusText + ' (' + error.status + ')' + '</p></div>' );
			$( '.js-ctdi-ajax-loader' ).hide();
		});
	}
} );
