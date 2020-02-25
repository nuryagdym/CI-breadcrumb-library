<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//you can define more than one format for breadcrumbs. one for example for you admin dashboard and other for your user's dashboard/website
$config['make_bread_default'] = array(
  //sub_url will be added before all urls. for example, if /users path is added and sub_url = admin then breadcrumb URL will be https://example.com/admin/users and so on.
	'sub_url' => '',
  
  //The format of the home (the first crumb) crumb. If you leave it blank it will not put homepage as first crumb
	'home_format' => '<li class="m-nav__item m-nav__item--home"><a href="%s" class="m-nav__link m-nav__link--icon"><i class="m-nav__link-icon la la-home"></i></a></li>',
  
  //the divider you want between the crumbs. Leave blank if you don't want a divider;
	'divider' => '<li class="m-nav__separator">-</li>',
  
  //the opening tag of the breadcrumb container
	'container_open' => '<ol itemscope itemtype="https://schema.org/BreadcrumbList" class="m-subheader__breadcrumbs m-nav m-nav--inline">',
  
  //the closing tag of the breadcrumb container
	'container_close' => '</ol>',
  
  //the opening tag of the crumb container
	'crumb_open' => '<li class="m-nav__item">',
  
  //the closing tag of the crumb container
	'crumb_close' => '</li>',
  
  //format of the anchor tags.
	'anchor_format' => '<a itemprop="item" href="%s" class="m-nav__link">
                    <span itemprop="name" class="m-nav__link-text">%s</span></a>
                    <meta itemprop="position" content="%d" />'
);
