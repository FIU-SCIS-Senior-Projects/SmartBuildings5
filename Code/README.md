Directory Structure:

The webapp/app folder
CakePHP’s app folder is where you will do most of your application development.

	Config
		Holds the (few) configuration files CakePHP uses. Database connection details, bootstrapping, core configuration files and more should be stored here.		
	Console
		Contains the console commands and console tasks for your application. This directory can also contain a Templates directory to customize the output of bake. For more information see Shells, Tasks & Console Tools.		
	Controller
		Contains your application’s controllers and their components.
	Lib
		Contains libraries that do not come from 3rd parties or external vendors. This allows you to separate your organization’s internal libraries from vendor libraries.
	Locale
		Stores string files for internationalization.
	Model
		Contains your application’s models, behaviors, and datasources.
	Plugin
		Contains plugin packages.
	Test
		This directory contains all the test cases and test fixtures for your application. The Test/Case directory should mirror your application and contain one or more test cases per class in your application. For more information on test cases and test fixtures, refer to the Testing documentation.
	tmp
		This is where CakePHP stores temporary data. The actual data it stores depends on how you have CakePHP configured, but this folder is usually used to store model descriptions, logs, and sometimes session information.
	Vendor
		Any third-party classes or libraries should be placed here. Doing so makes them easy to access using the App::import(‘vendor’, ‘name’) function. Keen observers will note that this seems redundant, as there is also a vendors folder at the top level of our directory structure. We’ll get into the differences between the two when we discuss managing multiple applications and more complex system setups.
	View
		Presentational files are placed here: elements, error pages, helpers, layouts, and view files.
	webroot
		In a production setup, this folder should serve as the document root for your application. Folders here also serve as holding places for CSS stylesheets, images, and JavaScript files. 