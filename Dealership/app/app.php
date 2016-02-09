<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Dealership.php";


    $app = new Silex\Application();

    $app->get("/", function() {
        return "<!DOCTYPE html>
        <html>
        <head>
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'>
            <title>Find a Car</title>
        </head>
        <body>
            <div class='container'>
                <h1>Find a Car!</h1>
                <form action='/results'>
                    <div class='form-group'>
                        <label for='price'>Enter Maximum Price:</label>
                        <input id='price' name='price' class='form-control' type='number'>
                    </div>
                    <div class='form-group'>
                        <label for='miles'>Enter Maximum Mileage:</label>
                        <input id='miles' name='miles' class='form-control' type='number'>
                    </div>
                    <button type='submit' class='btn-success'>Submit</button>
                </form>
            </div>
        </body>
        </html>";
    });

    $app->get("/results", function() {

        $porsche = new Car("2014 Porsche 911", 114991, "img/porsche.jpg", 7864);
        $ford = new Car("2011 Ford F450", 55995, "img/ford.jpg", 14241);
        $lexus = new Car("2013 Lexus RX 350", 44700, "img/lexus.jpg", 20000);
        $mercedes = new Car("Mercedes Benx CLS550", 39900, "img/mercedes.jpg", 37979);

        $cars = array($porsche, $ford, $lexus, $mercedes);

        $cars_matching_search = array();
            foreach ($cars as $car) {
                if (($car->worthBuying($_GET["price"])) && ($car->maxMileage($_GET["miles"]))) {
                    array_push($cars_matching_search, $car);
                }
            }

        $output = "";   //return string

        if (empty($cars_matching_search)) {
            $output = "NO RESULTS FOUND ";
        } else {
            foreach ($cars_matching_search as $car) {
                $c_model = $car->getModel();
                $c_price = $car->getPrice();
                $c_image = $car->getImage();
                $c_miles = $car->getMiles();
                $output = $output . "<div class='row'>
                    <div class='col-md-6'>
                    <img style='max-height:300px' src=" .
                    $c_image . ">
                </div>
                <div class='col-md-6'>
                    <p>" . $c_model . "</p>
                    <p>By " . $c_price . "</p>
                    <p>$" . $c_miles . "</p>
                </div>
            </div>
            ";
            }
        }

    return $output;
    });

    return $app; //end of the php


?>
