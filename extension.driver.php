<?php
	/*
	Copyright: Deux Huit Huit 2014
	License: MIT, see the LICENCE file
	http://deuxhuithuit.mit-license.org/
	*/

	if(!defined("__IN_SYMPHONY__")) die("<h2>Error</h2><p>You cannot directly access this file</p>");

	/**
	 *
	 * Backend Pages Extension
	 * @author nicolasbrassard
	 *
	 */
	class extension_backend_pages extends Extension {
		
		/**
		 * Name of the extension
		 * @var string
		 */
		const EXT_NAME = 'Backend Pages';
		
		const SETTING_GROUP = 'backend-pages';
		
		public static $pages = array();
		
		public function __construct() {
			self::$pages = array(
				'key' => array(
					'title' => '',
					'url' => ''
				)
			);
		}
		
		
		/**
		 * Delegate fired to add a link to the Banned IPs Administration page
		 */
		public function fetchNavigation() {
			
			$children = array();
			
			foreach (self::$pages as $key => $page) {
				$children[] = array(
					'name'	=> $page['title'],
					'link'	=> '/index/?page=' . $key
				);
			}
			
			return array(
					array (
						'location' => __(self::EXT_NAME),
						'name' => __(self::EXT_NAME),
						'limit' => null,
						'children' => $children
					)
				);
		}
		
		/**
		 *
		 * Delegate fired when the extension is install
		 */
		public function install() {
			return true;
		}
		
		/**
		 *
		 * Delegate fired when the extension is updated (when version changes)
		 * @param string $previousVersion
		 */
		public function update($previousVersion) {
			return true;
		}

		/**
		 *
		 * Delegate fired when the extension is uninstall
		 * Cleans settings and Database
		 */
		public function uninstall() {
			return true;
		}
		
	}