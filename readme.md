# Our Food Farm

**Client:** Jerry Schnepp

**Developers:**
- Alec Gordon
- Jessica Wooley
- Sam O'Neal
- Mantek Bhatia

## Project Summary

The _Our Food Farm_ project is a website devoted to connect backyard gardeners, 
and farmsteads to an ever growing customer base looking for fresh locally grown produce and other farmstead products.
Target audiences include urban, suburban households that are producing food locally and looking for locally produced food

**Goals:**
1. Establish a connection with Backyard gardeners, Farmers, and Ranchers with customers looking for local grown foods. 
2. Help re-establish people with their food sources, by establishing full transparency on where and how their food was grown. 
3. Help establish community between the backyard gardeners, farmers, ranchers. 
4. Help boost local entrepreneurship/commerce.

**Target Audience:**
1. Urban and suburban households that are producing food locally. 
2. Urban and suburban households looking for locally produced foods.

## Deployment

### Setup For Production Environment

1. Setup a server of your choice with PHP, git, and composer.
2. Clone this repository into your webserver and set up domain.
3. In the command line, run `composer install` in the project's folder.
4. Ensure user keys in `.env` and other files are updated to their production versions.
5. Browse to the live website!

### Setup For Local Development

1. Install WAMP
	1. Click on WAMP tray icon > phpmyadmin
	2. Login with user: "root" pass: ""
	3. On side nav click _new+_
	4. Add database "homestead"
2. Install Composer
3. Clone this repo into C:\wamp\www
4. `cd our-food-farm`
5. `composer install`
6. `php artisan migrate`
7. Ensure browsing to *localhost/our-food-farm/* works.
