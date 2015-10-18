(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global wp, jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,JSON,ajaxurl, */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peFieldGallery = {	
		conf: {
			api: false
		}
	};
	
	var thumbs = {
			max: 100,
			min: 5,
			shown: 0
		};
	
	var workflow = false;
	var controller = false;
	var library = false;
	var CustomGalleryEdit,CustomFrame;
	
	function customClasses() {
		var media = wp.media;
		var l10n = media.view.l10n;
		
		CustomGalleryEdit = wp.media.controller.GalleryEdit.extend({
			gallerySettings: function( browser ) {
				if ( ! this.get('displaySettings') ) {
					return;
				}

				var library = this.get('library');

				if ( ! library || ! browser ) {
					return;
				}

				browser.toolbar.set( 'reverse', {
					text:     l10n.reverseOrder,
					priority: 80,

					click: function() {
						library.reset( library.toArray().reverse() );
					}
				});
			}
		});
		
		CustomFrame = wp.media.view.MediaFrame.Post.extend({
			galleryMenu: function( view ) {
			},
			createStates: function() {
				var options = this.options;

				this.states.add([
					new CustomGalleryEdit({
						library: options.selection,
						editing: true,
						requires: { selection: false },
						menu:    'gallery'
					}),
					new media.controller.GalleryAdd()
				]);
			},
			galleryEditToolbar: function() {
				try {
					var updateGallery = l10n.updateGallery;
					// change the button label
					l10n.updateGallery = 'Save Gallery';
					// call parent method
					media.view.MediaFrame.Post.prototype.galleryEditToolbar.apply(this,arguments);
					// change the button behaviour so that it would allow us to save an empty gallery
					this.toolbar.get().options.items.insert.requires.library = false;
					l10n.updateGallery = updateGallery;
				} catch (x) {

				}
			}
		});
		
	}
	
	function getWorkFlow(selection) {
		var attributes = {
				state:      'gallery-edit',
				editing:    true,
				multiple:   true
			};
		
		if (typeof selection != 'undefined' && selection) {
			attributes.selection = selection;
		}
		return new CustomFrame(attributes);
	}
	
	function init() {
		if (window.wp && window.wp.media) {
			customClasses();
		}
	}
	
	$(init);
	
	function PeFieldGallery(target, conf) {
		
		var button,store,workflow,thumbnails,selection = false,values = false,inited = false;
		
		// init function
		function start() {
			if (getWorkFlow) {
				button = target.find('input.button');
				button.on('click',open);
				thumbnails = target.find('.thumbnails');
				thumbnails.on('click',open);
				store = target.find('.pe-data');
				var field = store.attr('data-images'); 
				if (values) {
					save();
				} else if (field && field != 'false') {
					values = store.attr('data-images').split(',');
					save();
				}
				fetch();
				inited = true;
			}			
		}
		
		function label() {
			if (values) {
				button.hide();
			} else {
				button.show();
			}
		}

		
		function fetch() {
			label();
			
			if (!values) {
				selection = [];
				return;
			} 
			
			var shortcode = new wp.shortcode({
					tag:    "gallery",
					attrs:   { ids: values.join(',') },
					type:   "single"
				});
			
			var attachments = wp.media.gallery.attachments( shortcode );
			
			selection = new wp.media.model.Selection( attachments.models, {
				props:    attachments.props.toJSON(),
				multiple: true
			});
			
			selection.gallery = attachments.gallery;
			selection.more().done( function() {
				// Break ties with the query.
				selection.props.set({ query: false });
				selection.unmirror();
				selection.props.unset("orderby");
				preview(selection.map(function(a){ return a.attributes.sizes.thumbnail.url;}));
			});
			
		}
		
		function preview(attachments) {
			thumbnails.empty();
			if (attachments && attachments.length > 0) {
				var i;
				var len = attachments.length;
				var dmax = Math.max(thumbs.max,thumbs.min);
				var max = Math.min(dmax,len);

				for (i=0;i<max;i++) {
					if (thumbs.shown >= thumbs.max) {
						max = Math.min(max,dmax);
					}
					thumbnails.append('<div class="pe-thumb"><div class="pe-media"><img src="%0" /></div></div>'.format(attachments[i]));
					thumbs.shown++;
				}
			}
		}

		
		function open() {
			if (!selection) {
				fetch();
			}
			
			if (workflow) {
				workflow.off('update',update);
				workflow.dispose();
			}
			
			workflow = getWorkFlow(selection);
			workflow.on('update',update);
			workflow.on("escape",fetch);
			workflow.open();
		}
		
		function save() {
			store.empty();
			
			if (values) {
				var i;
				var len = values.length;
				
				var name = store.attr('data-name');

				for (i=0;i<len;i++) {
					store.append('<input type="hidden" name="%0[]" value="%1" />'.format(name,values[i]));
				}
				
			}
		}
		
		function setData(data) {
			values = data;
			if (inited) {
				save();
				fetch();
			}
		}
		
		function getData(data) {
			return values;
		}
		
		function update() {
			var library = workflow.states.get('gallery-edit').get('library');
			values = library.pluck('id');
			
			if (values.length === 0) {
				values = false;
			}
			
			save();
			label();
			preview(library.map(function(a){ return a.attributes.sizes.thumbnail.url;}));
			selection = false;
		}
		
		$.extend(this, {
			// public API
			getData: getData,
			setData: setData,
			target: function () {
				return target;
			},
			destroy: function() {
				target.data("peFieldGallery", null);
				target = undefined;
			}
		});
		
		// initialize
		var self = this;
		$(start);
		
	}
	
	// jQuery plugin implementation
	$.fn.peFieldGallery = function(conf) {
		
		// return existing instance	
		var api = this.data("peFieldGallery");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peFieldGallery.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeFieldGallery(el, conf);
			el.data("peFieldGallery", api); 
		});
		
		return conf.api ? api: this;		 
	};
		
}(window.jqpe35 || jQuery));

