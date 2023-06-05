## Here is the task:

* [x] use the API https://swapi.dev  to fetch data using php  (no frontend technology like TypeScript, JavaScript, JQuery,...)

* [x] display a list/table of 15 starships (name, model, cargo capacity) ordered by fastest (descending).

  * [x] if possible list their pilots as well (name, height) to know the crew better.

  * [x] else it would be nice to know the crew size.

  * [x] each ship in list should show how much slower it is in percent regarding to the fastest one.
    * `\App\Services\Resources\Starship #52`

* [x] build the ships as own class in PHP

  * [x] the ships should be able to transport different objects as some cargo  which can get added by using a method (cargo reduces cargo capacity).

  * [x] the attributes of the ships should be accessible by getters/setters



* [ ] to display the results, you can decide to use html or commandline output.
  * Because of time I just made it a simple json API with one single endpoint 
    * `http:\\localhost\api\starships`

* [x] you can handover the code using a public github repo, bitbucket repo, …  your choice 😉

## Code of Interest:

* https://github.com/mubasharkk/sevencooks/tree/main/app/Services
* https://github.com/mubasharkk/sevencooks/blob/main/app/Http/Controllers/StarshipsController.php


## Running the app

The application is built on Laravel using sail. 

```
$ composer install && ./vendor/bin/sail up -d

```

## API URL

`http://localhost/api/starships`
