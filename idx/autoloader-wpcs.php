<?php
namespace IDX;

//Class Autoloader for WPCS Compliance
spl_autoload_register(function ( $class ) {
	// Project-specific namespace prefix
	$namespace_prefix = 'IDX\\';

	// All WordPress class files must begin with 'class-'
	$filename_prefix = 'class-';

	// Base directory for the namespace prefix
	$base_dir = __DIR__ . DIRECTORY_SEPARATOR;

	// Does the class use the namespace prefix?
	$len = strlen( $namespace_prefix );

	if ( strncmp( $namespace_prefix, $class, $len ) !== 0 ) {
		// No, move to the next registered autoloader
		return;
	}

	// Get the relative class name
	$relative_class = substr( $class, $len );
	$relative_class = str_replace( '_', '-', $relative_class );

	// Class name string position
	$class_name_pos = strrpos( $relative_class, '\\' ) + 1;

	// Prepend filename prefix to classname
	$relative_class = substr_replace( $relative_class, $filename_prefix, $class_name_pos, 0 );

	// Replace the namespace prefix with the base directory, replace namespace
	// separators with directory separators in the relative class name, append
	// with .php
	$file = $base_dir . strtolower( str_replace( '\\', DIRECTORY_SEPARATOR, $relative_class ) ) . '.php';

	// If the file exists, require it
	if ( file_exists( $file ) ) {
		require_once( $file );
	}
});
