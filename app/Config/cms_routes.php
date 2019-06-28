<?php
/**
 * FP Platform
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    FPPlatform
 * @subpackage Core
 * @author     Agriya <info@agriya.com>
 * @copyright  2018 Agriya Infoway Private Ltd
 * @license    http://www.agriya.com/ Agriya Infoway Licence
 * @link       http://www.agriya.com
 */
/* SVN FILE: $Id: routes.php 173 2009-01-31 12:51:40Z rajesh_04ag02 $ */
/**
 * Short description for file.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision: 7820 $
 * @modifiedby    $LastChangedBy: renan.saddam $
 * @lastmodified  $Date: 2008-11-03 23:57:56 +0530 (Mon, 03 Nov 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
CakePlugin::routes();
Router::parseExtensions('rss', 'csv', 'json', 'txt', 'pdf', 'kml', 'xml', 'mobile', 'js');
// REST support controllers
Router::mapResources(array(
    'deals'
));
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
$site_name = Cache::read('site.name', 'long') ;
if (Cache::read('site.city_url', 'long') == 'prefix') {
    CmsRouter::Connect('/img/:size/*', array(
        'controller' => 'images',
        'action' => 'view'
    ) , array(
        'size' => '(?:[a-zA-Z_]*)*'
    ));
    CmsRouter::Connect('/img/*', array(
        'controller' => 'images',
        'action' => 'view',
        'size' => 'original'
    ));
    CmsRouter::Connect('/js/*', array(
        'controller' => 'devs',
        'action' => 'asset_js'
    ));
    CmsRouter::Connect('/css/*', array(
        'controller' => 'devs',
        'action' => 'asset_css'
    ));
    $controllers = Cache::read('controllers_list', 'default');
    if ($controllers === false) {
        $controllers = App::objects('controller');
        foreach($controllers as &$value) {
            $value = Inflector::underscore($value);
        }
        array_push($controllers, 'company', 'deal', 'page', 'user', 'admin', 'deal_user', 'contactus', 'sitemap', 'robots', 'sitemap.xml', 'robots.txt','welcome_to_'.$site_name);
        $controllers = implode('|', $controllers);
        Cache::write('controllers_list', $controllers);
    }
	if (stripos(getenv('HTTP_HOST') , 'touch.') !== false) {
		CmsRouter::Connect('/', array(
			'controller' => 'pages',
			'action' => 'display',
			'main-menu'
		) , array(
			'city' => '(?!' . $controllers . ')[^\/]*'
		));
	} else{
		CmsRouter::Connect('/', array(
			'controller' => 'deals',
			'action' => 'index'
		) , array(
			'city' => '(?!' . $controllers . ')[^\/]*'
		));
	}
	CmsRouter::Connect('/live', array(
		'controller' => 'deals',
		'action' => 'live',
	) , array(
		'city' => '(?!' . $controllers . ')[^\/]*'
	));	
	CmsRouter::Connect('/:city/live', array(
		'controller' => 'deals',
		'action' => 'live',
	) , array(
		'city' => '(?!' . $controllers . ')[^\/]*'
	));
	CmsRouter::Connect('/:city', array(
		'controller' => 'deals',
		'action' => 'index'
	) , array(
		'city' => '(?!' . $controllers . ')[^\/]*'
	));
    CmsRouter::Connect('/:city/users/facebook/login', array(
			'controller' => 'users',
			'action' => 'login',
			'type' => 'facebook'
    ) , array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
    CmsRouter::Connect('/:city/users/twitter/login', array(
        'controller' => 'users',
        'action' => 'login',
        'type' => 'twitter'
    ) , array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
    CmsRouter::Connect('/:city/users/yahoo/login', array(
		'controller' => 'users',
		'action' => 'login',
		'type' => 'yahoo'
	), array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
    CmsRouter::Connect('/:city/users/gmail/login', array(
		'controller' => 'users',
		'action' => 'login',
		'type' => 'gmail'
	), array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
    CmsRouter::Connect('/:city/users/openid/login', array(
		'controller' => 'users',
		'action' => 'login',
		'type' => 'openid'
	), array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
    CmsRouter::Connect('/:city/users/foursquare/login', array(
		'controller' => 'users',
		'action' => 'login',
		'type' => 'foursquare'
	), array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));

    CmsRouter::Connect('/:city/company/facebook/login', array(
			'controller' => 'users',
			'action' => 'login',
			'type' => 'facebook',
			'user_type' => 'company'
    ) , array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
    CmsRouter::Connect('/:city/company/twitter/login', array(
        'controller' => 'users',
        'action' => 'login',
        'type' => 'twitter',
        'user_type' => 'company'
    ) , array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
    CmsRouter::Connect('/:city/company/yahoo/login', array(
		'controller' => 'users',
		'action' => 'login',
		'type' => 'yahoo',
		'user_type' => 'company'
	), array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
    CmsRouter::Connect('/:city/company/gmail/login', array(
		'controller' => 'users',
		'action' => 'login',
		'type' => 'gmail',
		'user_type' => 'company'
	), array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
    CmsRouter::Connect('/:city/company/openid/login', array(
		'controller' => 'users',
		'action' => 'login',
		'type' => 'openid',
		'user_type' => 'company'
	), array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
    CmsRouter::Connect('/:city/company/foursquare/login', array(
		'controller' => 'users',
		'action' => 'login',
		'type' => 'foursquare',
		'user_type' => 'company'
	), array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));

    CmsRouter::Connect('/:city/pages/*', array(
        'controller' => 'pages',
        'action' => 'display'
    ) , array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
    CmsRouter::Connect('/pages/*', array(
        'controller' => 'pages',
        'action' => 'display'
    ));

    CmsRouter::Connect('/:city/company/user/register/*', array(
        'controller' => 'users',
        'action' => 'company_register'
    ) , array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
    CmsRouter::Connect('/:city/contactus', array(
        'controller' => 'contacts',
        'action' => 'add'
    ) , array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
	CmsRouter::Connect('/cron/update_deal', array(
        'controller' => 'crons',
        'action' => 'update_deal'
    ) , array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
    CmsRouter::Connect('/:city/deals/recent', array(
        'controller' => 'deals',
        'action' => 'index',
        'type' => 'recent'
    ) , array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
	CmsRouter::Connect('/:city/deals/near', array(
        'controller' => 'deals',
        'action' => 'index',
        'type' => 'near'
    ) , array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
	CmsRouter::Connect('/:city/deals/main', array(
        'controller' => 'deals',
        'action' => 'index',
        'type' => 'main'
    ) , array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
	CmsRouter::Connect('/:city/deals/side', array(
        'controller' => 'deals',
        'action' => 'index',
        'type' => 'side'
    ) , array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
    CmsRouter::Connect('/:city/deals/company/:company', array(
        'controller' => 'deals',
        'action' => 'index',
    ) , array(
        'company' => '[^\/]*',
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
    CmsRouter::Connect('/:city/deals/company/:company/:view', array(
        'controller' => 'deals',
        'action' => 'index',
    ) , array(
        'company' => '[^\/]*',
		'city' => '(?!' . $controllers . ')[^\/]*',
		'view' => 'live',
		
    ));
	CmsRouter::Connect('/:city/deals/company/:company/:type', array(
        'controller' => 'deals',
        'action' => 'index',
    ) , array(
        'company' => '[^\/]*',
		'type' => '[^\/]*',
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
	CmsRouter::Connect('/:city/deals/company/:company/:type/:view', array(
        'controller' => 'deals',
        'action' => 'index',
    ) , array(
        'company' => '[^\/]*',
		'type' => '[^\/]*',
		'view' => 'live',
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
    CmsRouter::Connect('/:city/city_suggestions/new', array(
        'controller' => 'city_suggestions',
        'action' => 'add',
    ) , array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
    CmsRouter::Connect('/:city/subscribe', array(
        'controller' => 'subscriptions',
        'action' => 'add',
    ) , array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
    CmsRouter::Connect('/:city/admin' , array(
        'controller' => 'users',
        'action' => 'stats',
        'prefix' => 'admin',
        'admin' => true
    ) , array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
    CmsRouter::Connect('/:city/robots', array(
        'controller' => 'devs',
        'action' => 'robots',
        'ext' => 'txt'
    ) , array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
    CmsRouter::Connect('/:city/sitemap', array(
        'controller' => 'devs',
        'action' => 'sitemap',
        'ext' => 'xml'
    ) , array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
    CmsRouter::Connect('/files/*', array(
        'controller' => 'images',
        'action' => 'view',
        'size' => 'original'
    ));
    CmsRouter::Connect('/admin/:controller/:action/*', array(
        'admin' => true
    ) , array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
    CmsRouter::Connect('/:city/admin/:controller/:action/*', array(
        'admin' => true
    ) , array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
    CmsRouter::Connect('/:city/admin/:controller/*', array(
		'action' => 'index',
        'admin' => true
    ) , array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
    CmsRouter::Connect('/:city/:controller/:action/*', array() , array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
    CmsRouter::Connect('/:city/:controller/*', array(
		'action' => 'index'
	) , array(
        'city' => '(?!' . $controllers . ')[^\/]*'
    ));
	CmsRouter::Connect('/welcome_to_'.$site_name, array(
        'controller' => 'deals',
        'action' => 'index',
		'type' => 'geocity'
    ));
}
if (Cache::read('site.city_url', 'long') == 'subdomain') {
    CmsRouter::Connect('/img/:size/*', array(
        'controller' => 'images',
        'action' => 'view'
    ) , array(
        'size' => '(?:[a-zA-Z_]*)*'
    ));
    CmsRouter::Connect('/img/*', array(
        'controller' => 'images',
        'action' => 'view',
        'size' => 'original'
    ));
    CmsRouter::Connect('/js/*', array(
        'controller' => 'devs',
        'action' => 'asset_js'
    ));
    CmsRouter::Connect('/css/*', array(
        'controller' => 'devs',
        'action' => 'asset_css'
    ));
    CmsRouter::Connect('/city::city', array(
        'controller' => 'deals',
        'action' => 'index'
    ) , array(
        'city' => '[^\/]*'
    ));
    CmsRouter::Connect('/contactus/city::city', array(
        'controller' => 'contacts',
        'action' => 'add'
    ) , array(
        'city' => '[^\/]*'
    ));
    CmsRouter::Connect('/pages/*', array(
        'controller' => 'pages',
        'action' => 'display'
    ));
	
    CmsRouter::Connect('/company/user/register/city::city/*', array(
        'controller' => 'users',
        'action' => 'company_register'
    ) , array(
        'city' => '[^\/]*'
    ));
    CmsRouter::Connect('/admin/city::city', array(
        'controller' => 'users',
        'action' => 'stats',
        'prefix' => 'admin' ,
        'admin' => 1
    ) , array(
        'city' => '[^\/]*'
    ));
    CmsRouter::Connect('/robots', array(
        'controller' => 'devs',
        'action' => 'robots',
        'ext' => 'txt'
    ) , array(
        'city' => '[^\/]*'
    ));
    CmsRouter::Connect('/deals/recent/city::city', array(
        'controller' => 'deals',
        'action' => 'index',
        'type' => 'recent'
    ) , array(
        'city' => '[^\/]*'
    ));
    CmsRouter::Connect('/deals/company/:company/city::city', array(
        'controller' => 'deals',
        'action' => 'index',
    ) , array(
        'company' => '[^\/]*',
        'city' => '[^\/]*'
    ));
    CmsRouter::Connect('/city_suggestions/new/city::city', array(
        'controller' => 'city_suggestions',
        'action' => 'add',
    ) , array(
        'city' => '[^\/]*'
    ));
    CmsRouter::Connect('/subscribe/city::city', array(
        'controller' => 'subscriptions',
        'action' => 'add',
    ) , array(
        'city' => '[^\/]*'
    ));
    CmsRouter::Connect('/subscribe', array(
        'controller' => 'subscriptions',
        'action' => 'add',
    ) , array(
        'city' => '[^\/]*'
    ));
    CmsRouter::Connect('/files/*', array(
        'controller' => 'images',
        'action' => 'view',
        'size' => 'original'
    ));
    CmsRouter::Connect('/users/twitter/login/city::city', array(
        'controller' => 'users',
        'action' => 'login',
        'type' => 'twitter'
    ) , array(
        'city' => '[^\/]*'
    ));
    CmsRouter::Connect('/sitemap/city::city', array(
        'controller' => 'devs',
        'action' => 'sitemap'
    ) , array(
        'city' => '[^\/]*'
    ));  
	CmsRouter::Connect('/welcome_to_'.$site_name, array(
        'controller' => 'deals',
        'action' => 'index',
		'type' => 'geocity'
    ));
}
?>