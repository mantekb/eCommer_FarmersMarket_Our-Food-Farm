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
	- The product stock will be decremented by the quantity purchased
	- Buyer and seller will be emailed a notification of the order
	- Payment will be removed from the buyer and paid to the seller
	- Cart is then emptied after order created
10. Users can view previous orders from the account drop-down
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
to serve the website, handle routing, manipulate data, and respond to requests.

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

The user that is in the process of using the site is represented by a `User` object.

Authorization is automatically handled by Laravel.

You can access the current user in PHP by calling the Laravel function `Auth::user()` and assigning that to a variable.

Users are stored in the `users` database along with specific information relating to them.

Users are seen as owners of other objects which are `stands`, `addresses`, `payment infos`, and `orders`.

Many of these objects can be referenced from the user object within `User.php`.

Users are referenced in just about every controller. They are extremely useful in gathering information about most types 
of other objects, as their user_id ties other objects together within the relational database.

###### Map

We use maps on the _/home_, _/stand/{stand\_id}_, and _/checkout_ routes.

The API we use to display the map, specific areas on the map, and display markers noting the location of stands
 is the [Mapbox](https://www.mapbox.com/) API.

We control what is displayed on the map through functions in `stand.js`, `map.js`, `LocationController.php`,
 and `SearchController.php`.

The controllers gather information about the location the user is in, the stands that need displayed, and
 narrowing down that information based upon search criteria.

The javascript files use the information from the back-end, and send it to the Mapbox API so the user can view
 stands in their area.

###### Stands

Stands are a sort of storefront that users can make in order to be able to sell their produce.

A user can create a stand, only if they don't currently have one and only if they are logged in.
After creating the stand they are taken to the payment information page.
The user cannot create `products` until their payment information is created,
 so they can get paid when their products are bought.

By visiting their stand's page, the user that owns it will see a button that allows them to edit their stand.
Clicking this button takes them to a form similar to that where they created their stand,
 saving any changes are immediately seen upon form submission.

When a user creates their stand, they enter in the location of their stand.
This allows us to get the latitude and longitude of that location in use on the map
 and in search and location based algorithms.

###### Products

Products are the items that users _(specifically stand owners)_ want to sell.

After creating their stand and payment information, a user is able to create products.
On this page they set specific data about each product, and can edit the products live.

**Note:** Currently the user cannot upload an image to associate with their products.
A placeholder image of a tomato is used instead.
Due to the use of the _masonry_ css framework, dimensions of the uploaded image should not matter
 when displaying the image. The page should resize properly with the images.

###### Cart

