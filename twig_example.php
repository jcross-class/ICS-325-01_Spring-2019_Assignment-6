<?php

// Load the twig library using composer's autoload feature.
//  We'll go over composer in a future class.
require_once './vendor/autoload.php';

// Tell twig to use the current directory as the source for templates files.
$loader = new Twig_Loader_Filesystem('.');
// Create a new twig object to use to render with.
$twig = new Twig_Environment($loader);

// Render the template step3_view_session_data.twig using data from the given array.
// Print the output to the web browser.
echo $twig->render('twig_example_template.twig', array(
                                                        'title' => 'Twig Test',
                                                        'name' => 'joe',
                                                        'age' => 12,
                                                        'lucky_numbers' => array(1,7,15,88)
                                                       )
                    );
