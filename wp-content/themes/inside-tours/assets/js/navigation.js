/* global inside_toursScreenReaderText */
/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 */

jQuery(function($){
	"use strict";
	jQuery('.main-menu-navigation > ul').superfish({
		delay: 500,                            
		animation: {opacity:'show',height:'show'},  
		speed: 'fast'                        
	});
});

function inside_tours_open() {
	window.inside_tours_mobileMenu=true;
	jQuery(".sidenav").addClass('show');
}
function inside_tours_close() {
	window.inside_tours_mobileMenu=false;
	jQuery(".sidenav").removeClass('show');
}

window.inside_tours_currentfocus=null;
inside_tours_checkfocusdElement();
var inside_tours_body = document.querySelector('body');
inside_tours_body.addEventListener('keyup', inside_tours_check_tab_press);
var inside_tours_gotoHome = false;
var inside_tours_gotoClose = false;
window.inside_tours_mobileMenu=false;
function inside_tours_checkfocusdElement(){
 	if(window.inside_tours_currentfocus=document.activeElement.className){
	 	window.inside_tours_currentfocus=document.activeElement.className;
 	}
}
function inside_tours_check_tab_press(e) {
	"use strict";
	// pick passed event or global event object if passed one is empty
	e = e || event;
	var activeElement;

	if(window.innerWidth < 999){
		if (e.keyCode == 9) {
			if(window.inside_tours_mobileMenu){
				if (!e.shiftKey) {
					if(inside_tours_gotoHome) {
						jQuery( ".main-menu-navigation ul:first li:first a:first-child" ).focus();
					}
				}
				if (jQuery("a.closebtn.responsive-menu").is(":focus")) {
					inside_tours_gotoHome = true;
				} else {
					inside_tours_gotoHome = false;
				}
			}else{
				if(window.inside_tours_currentfocus=="mobiletoggle"){
					jQuery( "" ).focus();
				}
			}
		}
	}
	if (e.shiftKey && e.keyCode == 9) {
		if(window.innerWidth < 999){
			if(window.inside_tours_currentfocus=="header-search"){
				jQuery(".mobiletoggle").focus();
			}else{
				if(window.inside_tours_mobileMenu){
					if(inside_tours_gotoClose){
						jQuery("a.closebtn.responsive-menu").focus();
					}
					if (jQuery( ".main-menu-navigation ul:first li:first a:first-child" ).is(":focus")) {
						inside_tours_gotoClose = true;
					} else {
						inside_tours_gotoClose = false;
					}
				
				}else{
					if(window.inside_tours_mobileMenu){
					}
				}
			}
		}
	}
 	inside_tours_checkfocusdElement();
}