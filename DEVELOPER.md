# Developer Documentation


#### Program Flow

1. User navigates to landing page.
2. From here they can put in their zip code in order to find stands near them.
3. Users can search for stands based on:
	- stand names
	- product names
	- mile radius
	- price ranges
4. Users can then visit stands
5. Users can login and register from any page
6. Users can add products from a stand to their cart
7. Users can then view their cart and make changes
8. Then they can proceed to checkout where they choose payment type
	- cash
	- input card then
	- use saved card (disabled)
9. Upon choosing payment type they can submit the order
	- The product stock will be decremented by the quantity pruchased
	- Buyer and seller will be emailed a notification of the order
	- Payment will be removed from the buyer and paid to the seller
	- Cart is then emptied after order created
10. Users can view previous orders from the account dropdown
11. Users can change their settings and save payment information
12. Users can create a stand and post products (after setting up payment account)
13. Users can view and create learning resources (blogs/articles)
14. Users can logout and still use the searching features of the website

#### Setup For Local Development

1. Install WAMP
	1. Click on WAMP tray icon > phpmyadmin
	2. Login with user: "root" pass: ""
	3. On side nav click _new+_
	4. Add database "cs4540g1" (or whatever is in .env)
2. Install Composer
3. Clone this repo into C:\wamp\www
4. `cd our-food-farm`
5. `composer install`
6. `php artisan migrate`
7. Ensure browsing to *localhost/our-food-farm/public* works.

#### Program explanation

_Our Food Farm_ uses the [Laravel](https://laravel.com/docs/5.2/) PHP framework 
to serve the webiste, handle routing, manipulate data, and responsd to requests.

As a css framework we changed out the original Bootstrap css framework in favor 
of a more unique css framework in [Materialize](http://materializecss.com/).

For javascript we are making use of the [JQuery](http://api.jquery.com/) library in order to save 
time doing frequent type of `AJAX` calls and `DOM` manipulations.

**Misc Libraries:**
- [Mapbox](https://www.mapbox.com/)
- [SweetAlert](http://t4t5.github.io/sweetalert/)
- [Masonry](http://masonry.desandro.com/)

#### Program Analysis

###### User

explanation

controllers

front-end

###### Map

explanation

controllers

front-end

###### Stands

explanation

controllers

front-end

...so on

