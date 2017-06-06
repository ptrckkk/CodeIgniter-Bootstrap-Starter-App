# CodeIgniter Bootstrap Starter App

This repository provides a starter _CodeIgniter 3 with Bootstrap 3_ application. For this, it makes
use of kenjis' CodeIgniter composer installer (see [1]). As a result, you can easily update the
CodeIgniter core.

This application enhances the default CodeIgniter installation in the following ways:
- It provides basic user management, i. e., users can be created and they can login / logout
- This application is configured to support migrations (and uses them to setup the database)
- Support of themes; this starter application ships with the default Bootstrap 3 theme (several
  themes can be present at the same time and easily switched)
- Some other minor things, such as, 1) storing sessions in a database and 2) support for captchas
  is already built-in (and used)

## Requirements

- PHP 5.3.7 or later
- `composer` command (see composer installation in [2]) (composer is required if you which to
   update the application core with composer)
   
## Getting Started

Perform the following installation steps:
1. Download this repository
2. Run ``composer update`` in the root directory of the project in order to update everything; in
   case Bootstrap 3 or jQuery related files are updated they have to be manually copied to the
   _application/assets/[css or js]_ folders in order for these updates to become effective (maybe
   someone has an idea how to automatize this?)
3. Set the ``base_url`` array item in _application/config/config.php_ (as with kenjis' CodeIgniter
   installation your webserver should be configured to point at the _this-app/public_ directory)
4. Set ``hostname, username, password, database`` in _application/config/database.php_
5. Run the migrations (by browsing to the ``migrate`` controller; afterwards, set
   ``migration_enabled`` in _application/config/migration.php_ to ``false`` if you no longer which
   to use / support migrations or for productive use!)
6. Set ``sess_driver`` to ``database`` in _application/config/config.php_ (in order for the
  just-described migration run to work this has to be set to ``files`` in the first place)
7. Optional: Create a first user by browsing to the action ``user/create``

<hr>

[1] https://github.com/kenjis/codeigniter-composer-installer  
[2] https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx