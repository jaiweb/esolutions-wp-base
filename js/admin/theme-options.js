( function( $ ) {
	// jQuery powered scroll to top
	jQuery(document).ready( function() {
		jQuery('#tabs')
		.tabs({
			show: function(event, ui) {
				var _time = '5000';
					var lastOpenedPanel = jQuery(this).data("lastOpenedPanel");
					if (!jQuery(this).data("topPositionTab")) {
						jQuery(this).data("topPositionTab", jQuery(ui.panel).position().top)
					}
					jQuery(ui.panel).hide().fadeIn(_time);
					if (lastOpenedPanel) {
						lastOpenedPanel
							.toggleClass("ui-tabs-hide")
							.css("position", "absolute")
							.css("top", jQuery(this).data("topPositionTab") + "px")
							.fadeOut(_time, function() {
								jQuery(this)
								.css("position", "");
							});
					}
					//Saving the last tab has been opened
					jQuery(this).data("lastOpenedPanel", jQuery(ui.panel));
				},
			activate: function( event, ui ) {
					_esc_css_editor.refresh();
				}
		})
		.addClass('ui-tabs-vertical ui-helper-clearfix');
		
		var _esc_css_editor = CodeMirror.fromTextArea( document.getElementById( 'esc_custom_css' ), {lineNumbers: true, lineWrapping: true, autofocus:true} );
	});
} )( jQuery );