(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery,setTimeout,clearTimeout,location,setInterval,YT,clearInterval,pixelentity,THREE */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.pe360 = {	
		conf: {
			api: false
		} 
	};
	
	//return;
	function Pe360(target, conf) {
		
		var container,image,camera,scene,mesh,renderer,parent,w,h,active = true,timer, scrolling = false;
		var lon = 0, lat = 0, phi = 0, theta = 0,loni = 0.1,lati = 0;
		var jwin = $(window);
		
		function init() {
			parent = target.parent();
			image = target.attr("data-image360");
			if (image && !$.pixelentity.browser.mobile && $.support.webgl) {
				init3D();
				resize();
				animate();
			} else {
				fallback();
				resize();
			}
		}
		
		function init3D() {
			camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 1, 1100 );
            camera.target = new THREE.Vector3( 0, 0, 0 );

            scene = new THREE.Scene();

            var geometry = new THREE.SphereGeometry( 500, 60, 40 );
            geometry.applyMatrix( new THREE.Matrix4().makeScale( -1, 1, 1 ) );
			
            var material = new THREE.MeshBasicMaterial({
                    map: THREE.ImageUtils.loadTexture(image)
                });

            mesh = new THREE.Mesh( geometry, material );

            scene.add( mesh );
			
			renderer = new THREE.WebGLRenderer();
            target.append(renderer.domElement);
			if (target.hasClass("pe-need-resize")) {
				target.on("resize",resize);
			} else {
				if ($.pixelentity.wresize) {
					$.pixelentity.wresize(resize);
				} else {
					$(window).on("resize",resize);
				}
			}
			target.on("mousemove",rotation);
			jwin.on("scroll",scroll);
			setInterval(viewport,500);
		}
		
		function noscrolling() {
			scrolling = false;
			viewport();
		}
		
		function scroll() {
			active = false;
			scrolling = true;
			clearTimeout(timer);
			timer = setTimeout(noscrolling,100);
		}

		function fallback() {
			image = target.attr("data-fallback") || target.attr("data-image360");
			if (image) {
				target.css({
					"background-image" : 'url(%0)'.format(image),
					"background-position" : "50% 50%"
				});	
			}
		}
		
		function viewport() {
			var old = active;
			active = !scrolling && h+target.offset().top > jwin.scrollTop();
			if (active && active != old) {
				animate();
			}
		}
		
		function rotation(e) {
			var x = w/2-e.pageX;
			var y = h/2-e.pageY;
			loni = x > 0 ? -0.05 : 0.05;
			lati = y > 0 ? 0.05 : -0.05;
			if (Math.abs(y) < 100) {
				lati = 0;
			}
		}
		
		function resize() {
			var nw = parent.width();
			var nh = parent.height();
			if (nw != w || nh != h) {
				w = nw;
				h = nh;
			}
			if (camera) {
				camera.aspect = w / h;
				camera.updateProjectionMatrix();
				renderer.setSize( w, h );
			} else {
				target.width(w).height(h);
			}
        }
		
		function animate() {
			if (active) {
				window.requestAnimationFrame(animate);
				update();
			}
		}
		
		function update() {
			if (!active) {
				return;
			}
			lon += loni;
			lat += lati;
            lat = Math.max( - 15, Math.min( 15, lat ) );
            phi = THREE.Math.degToRad( 90 - lat );
            theta = THREE.Math.degToRad( lon );

            camera.target.x = 500 * Math.sin( phi ) * Math.cos( theta );
            camera.target.y = 500 * Math.cos( phi );
            camera.target.z = 500 * Math.sin( phi ) * Math.sin( theta );

            camera.lookAt( camera.target );
            renderer.render( scene, camera );
		}
		
		// init function
		function start() {
			init();
		}
		
		$.extend(this, {
			// plublic API
			destroy: function() {
				target.data("pe360", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.pe360 = function(conf) {
		
		// return existing instance	
		var api = this.data("pe360");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.pe360.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new Pe360(el, conf);
			el.data("pe360", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));