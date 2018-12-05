<?php
/**
 * Classic Editor Blueprint
 */

/** Download, unzip WordPress, and move the contents into root. */
ds_cli_exec( "wp core download --quiet" );

//** Install WordPress
ds_cli_exec( "wp core install --url=$siteName --title='Classic Editor Test' --admin_user=testadmin --admin_password=password --admin_email=pleaseupdate@$siteName" );

//** Change Permalink structure
ds_cli_exec( "wp rewrite structure '/%postname%' --quiet" );

//** Remove Default Themes (Except twentyseventeen)
ds_cli_exec( "wp theme delete twentyfifteen" );
ds_cli_exec( "wp theme delete twentysixteen" );

//** Update Akismet
ds_cli_exec( "wp plugin update akismet --quiet" );

//** Change the tagline
ds_cli_exec( "wp option update blogdescription 'The sites tagline'" );

//** Remove Plugins
ds_cli_exec( "wp plugin delete hello --quiet" );

//** Remove Default Post/Page
ds_cli_exec( "wp post delete 1 --force" ); // Hello World!
ds_cli_exec( "wp post delete 2 --force" ); // Sample Page

//** Discourage search engines from indexing this site
ds_cli_exec( "wp option update blog_public 'on'" );

//** Add and activate Classic editor
ds_cli_exec( "wp plugin install classic-editor" );
ds_cli_exec( "wp plugin activate classic-editor" );

//** Add and activate WPSiteSync for Content
ds_cli_exec( "wp plugin install wpsitesynccontent" );
ds_cli_exec( "wp plugin activate wpsitesynccontent" );

//** Delete First Comment
ds_cli_exec( "wp comment delete 1" );

//** Check if index.php unpacked okay
if ( is_file( "index.php" ) ) {

	//** Cleanup the empty folder, download, and this script.
	ds_cli_exec( "rm blueprint.php" );
	ds_cli_exec( "rm index.htm" );
}
