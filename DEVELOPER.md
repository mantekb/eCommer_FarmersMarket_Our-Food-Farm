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
- [Stripe](https://stripe.com/docs)

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

###### Settings

The user is able to update the information we have stored about them through the _/settings_ page.
Users can only access this page if they are currently logged in.

The settings page allows users to update their name, password, and location.

We save the location so we can automatically use it to display location on the map.
**Note:** This way of accessing location is not yet supported by the map functions.

The `SettingsController.php` and `settings.js` speak with each other through _AJAX_ in order to allow
 the user to stay on the same page and update multiple forms, without having to load a whole new page.
The javascript file handles gathering form information and sending it to the back-end,
 where the controller updates the models, and thus, the database.

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

The map is open to all users (not just the ones that are logged in) because it is a requirement of the API
 to not have the maps restricted behind a login.

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

Products also display on the _deals of the day_ page in order for the user to see deals near them.
**Note:** There's not currently the functionality expected through this page. Currently it just displays
 all products in a grid.

###### Cart

The cart is an object that is not represented within the _database_. As a result, it is within
 _App/Classes_ instead of the root within the _app_ folder, as it is not to be confused with a
 [model](https://laravel.com/docs/5.2/eloquent).

The cart is used as an object which holds all the products that a user adds to their cart.
It is a programmatic representation of a physical cart one would have at a store.

The cart object takes care of checking stock, complex array additions, and complex array searching
 when adding, updating, or removing items from the cart.
This is done so the user of the Cart object only has to worry about what comes in-or-out,
 not how operations within the cart are handled.

The cart also completes the order by creating the `Order` object, and saving the order and `OrderItems`
 to the database.

Any user can add products to their cart, but they can only proceed through checkout if they are logged in.

###### Checkout

When the user feels they have all the products in their cart that they need, the user can proceed to the
 view cart (_/cart/view_) page in order to view and finalize their order before they submit payment.
From this page the user can update and remove items from their cart.
The _Proceed to Checkout_ button will be removed and an _Update_ button will be displayed in place.
This is so the user can be forced to update the Cart in the back-end, as updating on every change
 could cause issues from asynchronous calls completing in the wrong order.

By proceeding to checkout (_/checkout_), the user is given an option of what payment methods they want to use to pay.
Options are:
- Cash (pay at time of pickup)
- Card (enter card info to pay right away)
- Saved Information (**Note:** Disabled and not working for unknown reasons.)

When using a card to pay, the [Stripe](https://stripe.com/docs) API is given necessary information to
 take money from the buyer, and give it to the account we created for the seller.

Around the same time the `Order` is created in the database and email notifications are sent to the buyer and sellers.
**Note:** An email server wasn't available at time of development, so the emails are untested and are not known
 whether or not they work.

After submitting the order, the buyer is taken to a page that shows the location of each stand on a map, the address,
 and what products they are purchasing from each stand.

###### Order

An `Order` represents a completed transaction between a _buyer_ and a _seller_ and records the time
 the transaction happened.

`OrderItems` are related to an `Order` and contain more specific information about the products that were
 bought, and the product's attributes at the time of order.

Users can view their previous orders through the account drop-down in the navbar (only available if logged in).
By visiting this page they can see the order by the time it was completed.
By clicking on the link on the order, they can see all the products they bought,
 the quantity they purchased, and the total prices of those products.

