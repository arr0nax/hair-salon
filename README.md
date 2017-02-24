# Hair Salon

#### A Simple Way to Keep track of Stylists and Clients, February 24, 2017

#### By Clayton Collins

## Description

This app uses a database to store information about stylists and their clients. It could be easily expanded to hold other relevant information like phone numbers, emails, haircut history, etc.

## Mac Setup/Installation Requirements

* Clone this repository.
* Begin your server using mamp or other relevant application. This app is configured to access databases at 'localhost:8889'.
* Copy the 'hair_salon' and 'hair_salon_test' databases in to mySQL (they are found in the databases folder of this repository).
* Run 'composer install' in the root of the project directory.
* Begin a php server in the web folder of this directory (php -S localhost:8000).
* Access the site by navigating to localhost:8000/ in your browser.


###Back-up MySQL Commands - if copying the databases doesnt worl
* CREATE DATABASE hair_salon;
* USE hair_salon;
* CREATE TABLE stylists (id serial primary key, name varchar(255));
* CREATE TABLE clients (id serial primary key, name varchar(255), stylist_id int);
* _Either repeat these commands in a new database 'hair_salon_test' or use phpMyAdmin to copy the database's structure_


## Known Bugs

No known bugs.

## Support and contact details

If you any issues or have questions, ideas or concerns, please contact me or make a pull request.

## Technologies Used

PHP, mySQL, MAMP, Silex, Twig, HTML, CSS

Copyright (c) 2017 **Clayton C. Collins**
