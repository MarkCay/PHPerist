# PHPerist
PHPerist is a simple and lightweight component-based PHP framework made by <a href="https://techieguy.web.app/" target="_blank">Mark Cay</a>. The framework is far from fully developed, but any help or collaboration is appreciated.

[![Stargazers repo roster for @MarkCay/PHPerist](https://reporoster.com/stars/MarkCay/PHPerist)](https://github.com/MarkCay/PHPerist/stargazers)
## Installation
After downloading the repository, do the following:
1. Open your project's folder on CLI and enter `composer install`.
2. Update the config settings in `config/config.php` with the necessary credentials
3. Create a folder named "app" in the project's root folder. Put your PHP files in that folder and you can now access it on the web! PHPerist already takes care of the routing.

## Routing
You can create your custom routing by configuring `$routes` on `config/config.php` file.

Here are some guides when configuring your custom routes:
 * Always start your route key with a `"/"`.
 * Always end your route key with a `".php"`
 * You can always set a route key of whatever the `$path_info`'s final value will be on config/routes.php
 * `$routes[$key]['title']` will set the HTML document title
 * `$routes[$key]['file']` will load the file if the given path exists in the `app/` folder
 * `$routes[$key]['content']` will set the HTML content of your template
 * If `$routes[$key]['file']` doesn't exist, PHPerist will look for the `$routes[$key]['content']`.

## Templates
PHPerist allows you to create multiple templates in your project.

To create a template,
1. Create your folder inside the `templates/` with your template name.
2. Add the `index.php` which must `echo` the a.) `$data['title']` into the HTML's document title, and b.) `$data['content']`` into the HTML's document body.
3. At the very top of your `index.php` file, add this:
```
<?php
defined("BASE_PATH") OR exit('No direct script access allowed');
?>
```
This will prevent unwanted access of your template.
4. Go to `config/config.php` and update the `DEFAULT_TEMPLATE` to your new template folder's name.

### Template Example 
```
<?php
defined("BASE_PATH") OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
<title><?=$data['title']?></title>
</head>
<body><?=$data['content']?></body>
</html>
```

That's it, you have already created your own template. You can be very creative with your custom templates, remember, this project is built with flexible PHP. 😉

## Components
Components are like reusable functions that do certain functionality and are expected to return an HTML view.
PHP Templates are components for defining a layout and design for our project, and most importantly, our HTML document's title and content.

You can create your custom components for your every project's need. In fact, your project can all be built with bunches of components.
* Header
* Nav
* Body
* Footer
* Buttons
* Input elements
* Forms
and the list goes on...

Once you have created your own component, you can load the component into your project by calling the function `load_component()` which has the following parameters:
* string $component_path (required) : The component file's path without the `.php` extension
* $data (optional) : The component file's data that will be need for it to do its job

E.g. `load_component("error", ['title' => 'Error 404', 'message' => 'Page not found']);`

Future development of this framework mainly includes improvement of the components workflow for easier development. Again, any help or collaboration is very much appreciated!

## Constants
Constants are defined in `config/constants.php`, you can add your own constant there. Make sure to follow this code to avoid making a duplicate variable name:

`defined('YOUR_CONSTANT_HERE') OR define("YOUR_CONSTANT_HERE", "YOUR_VALUE_HERE");`

Once you have already defined your constant, you are now able to access it on any of your project's PHP files.

## Functions
Functions are defined in `config/functions.php`, you can add your own function there.

E.g.
```
function greet(string $name) {
  echo "Hello, $name!";
}
```

Now, your `greet()` function is accessible in `app/**` folder of the project.

There are some functions that I have already added into it:
1. `base_url()` which returns the BASE URL of the project (But remember to configure it in `config/functions.php`). You an also pass an optional parameter to it which will append the parameter to its Base URL. I added it in here because I see other frameworks use it a lot of the time.
2. `redirect()` which redirects you to other page. The function has two parameters:
* <b>string $link (required)</b> : will redirect you to the link you pass on. For example, `redirect('login')` will redirect you to your web's `/login` route
* <b>bool $base (optional, default = TRUE)</b> : The default is `TRUE`, which will redirect you to your `$link` appended to the Base URL's value (See the function for more clarity). Turning `$base`'s value to `FALSE` will redirect you to an absolute external link. For example, `redirect('https://www.facebook.com', FALSE)` will redirect you to Facebook's official website.

For now, the functions I wrote are in the same file, but in future development, functions are grouped related on its functionalities.

## Database Configuration
Enter your database credentials in `application/config/config.php`.
Make sure that you enter the right credentials for the database connection to work.

Once connected to the database, `$qbf` is now available throughout the `app/` for making queries. Checkout the query builder's documentation here: <a href='https://github.com/requtize/query-builder' target='_blank'>https://github.com/requtize/query-builder</a>

## Few more words
Again, this framework is built using PHP, so you can do all these customization for your project's need. So if you want to add some missing config files, you can add it in `config/` folder then load it in `index.php` file via the `require_once()` function. 😉
* If you are having problems, feel free to post in the <a href='https://github.com/MarkCay/PHPerist/issues' target='_blank'>issues</a>.
* You can also share your feedbacks, comments, support, and suggestions via <a href='https://github.com/MarkCay/PHPerist/issues' target='_blank'>Issues</a> or via my e-mail address: <a href='mailto:markgabrieller@gmail.com' target='_blank'>markgabrieller@gmail.com</a>

Please let me know what you think with this first PHP framework I built. Thank you!
