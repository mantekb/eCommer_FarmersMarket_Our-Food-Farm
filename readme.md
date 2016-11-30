# Our Food Farm

**Client:** Jerry Schnepp

**Developers:**
- Alec Gordon
- Jessica Wooley
- Sam O'Neal
- Mantek Bhatia


### Setup For Production Environment
1. 

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
