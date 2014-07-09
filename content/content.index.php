<?php

	if(!defined("__IN_SYMPHONY__")) die("<h2>Error</h2><p>You cannot directly access this file</p>");

	require_once(TOOLKIT . '/class.administrationpage.php');

	/*
	Copyright: Deux Huit Huit 2014
	License: MIT, see the LICENCE file
	http://deuxhuithuit.mit-license.org/
	*/

	class contentExtensionBackend_PagesIndex extends AdministrationPage {
		
		/**
		 * Builds the content view
		 */
		public function __viewIndex() {
			$page = extension_backend_pages::$pages[$_REQUEST['page']];
			
			if (!$page) {
				throw new Exception('page not found');
			}
			
			$title = $page['title'];
			
			$this->setPageType('iframe');
			
			$this->setTitle(sprintf('%1$s: %2$s &ndash; %3$s', $title, extension_backend_pages::EXT_NAME, __('Symphony')));
			
			$this->appendSubheading(__($title));
			
			$css = new XMLElement('style');
			$css->setAllowEmptyAttributes(true);
			$css->setAttribute('scoped', '');
			$css->setAttribute('type', 'text/css');
			$css->setValue("
				#contents { min-height: 0; padding: 0; font-size:0 !important; }
			");
			
			$js = new XMLElement('script');
			$js->setValue("
				(function ($) {
						
					$(function () {
						
						var win = $(window);
						var iframe = $('form iframe');
						
						var resize = function () {
							var used = $('#header').height() + $('#nav').height() + $('#context').outerHeight(true);
							var available = win.height() - used;
							iframe.height(available - 1);
							$('#contents').height(available - 2);
						};
						
						win.load(resize).resize(resize);
					
					});
				})(jQuery);
			");
			
			$iframe = new XMLElement('iframe');
			$iframe->setSelfClosingTag(true);
			$iframe->setAttribute('src', $page['url']);
			$iframe->setAttribute('frameborder', '0');
			$iframe->setAttribute('width', '100%');
			$iframe->setAttribute('height', '100%');
			
			$this->Wrapper->prependChild($css);
			$this->Wrapper->prependChild($js);
			$this->Form->appendChild($iframe);
		}
		
	}	