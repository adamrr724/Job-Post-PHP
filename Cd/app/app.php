<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cd.php";


    $app = new Silex\Application();


    $app->get("/", function() {

        // $new_cds = array();
        //     foreach($new_cds as $cd) {
                $new_cd = new CD($_GET['title'], $_GET['artist'], $_GET['cover_art'], $_GET['price']);
            // }

        $first_cd = new CD("Master of Reality", "Black Sabbath", "/img/reality.jpg", 10.99);
        $second_cd = new CD("Electric Ladyland", "Jimi Hendrix", "/img/ladyland.jpg", 10.99);
        $third_cd = new CD("Nevermind", "Nirvana", "/img/nevermind.jpg", 10.99);
        $fourth_cd = new CD("I don't get it", "Pork Lion", "/img/porklion.jpg", 49.99);
        $cds = array($first_cd, $second_cd, $third_cd, $fourth_cd);

        if(isset($new_cd)) {
            array_push($cds, $new_cd);
        }
        $output = "";
        foreach ($cds as $album) {
            $output = $output . "<div class='row'>
                <div class='col-md-6'>
                    <img style='max-height:300px' src=" . $album->getCoverArt() . ">
                </div>
                <div class='col-md-6'>
                    <p>" . $album->getTitle() . "</p>
                    <p>By " . $album->getArtist() . "</p>
                    <p>$" . $album->getPrice() . "</p>
                </div>
            </div>
            ";
        }
        return $output;
    });

    $app->get("/new_cd", function() {
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'>
            <title>Add a new CD</title>
        </head>
        <body>
            <div class='container'>
                <h1>Add Your CD</h1>
                <p>Enter the Album information below.</p>
                <form action='/'>
                    <div class='form-group'>
                      <label for='title'>Enter the title:</label>
                      <input id='title' name='title' class='form-control' type='text'>
                    </div>
                    <div class='form-group'>
                      <label for='artist'>Enter the artist:</label>
                      <input id='artist' name='artist' class='form-control' type='text'>
                    </div>
                    <div class='form-group'>
                      <label for='cover_art'>Enter the image path:</label>
                      <input id='cover_art' name='cover_art' class='form-control' type='text'>
                    </div>
                    <div class='form-group'>
                      <label for='price'>Enter the price:</label>
                      <input id='price' name='price' class='form-control' type='float'>
                    </div>
                    <button type='submit' class='btn-success'>Create</button>
                </form>
            </div>
        </body>
        </html>
        ";
    });


    return $app; //end of the php
?>
