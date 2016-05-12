<?php
return array(
	/**
	 * Settings driver to be used
	 *
	 * json|database
	 */
	'driver' => 'database',

	/**
	 * Full path to json file (only if 'json' is set as driver above)
	 */
	'path' => storage_path().'/settings.json',

	/**
	 * Database table (only if 'database' is set as driver above)
	 */
	'table' => 'settings',
);
