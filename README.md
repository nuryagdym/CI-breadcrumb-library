CI-breadcrumb-library
=====================
config/make_bread.php
loaded automatically by Codeigniter if the library name (Make_bread.php) and config file name (make_bread.php) is the same.

You can define more than one templates in config file:
```
$config['make_bread_default'] = array(
//configs
);
$config['make_bread_admin'] = array(
//configs
);
```
Switch between configs
```
$this->make_bread->switch_config('make_bread_admin');
```
Reset Bread crumbs
```
$this->make_bread->reset_bread_crumbs();
```
