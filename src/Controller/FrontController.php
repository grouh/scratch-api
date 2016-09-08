<?php

/**
 * Class FrontController
 *
 * PHP Version 5.6
 *
 * @package  Front
 * @author   Sylvain Pamart <sypam@smile.fr>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 */
class FrontController
{
    /**
     * This function handle given url and redirect to appropriate controller
     * @param string $url url to handle
     * @return null
     */
    public function handle($url)
    {
        $urlSegmentsWithGet = explode("?", $url);
        $urlSegments = explode("/", $urlSegmentsWithGet[0]);

        global $routing;

        // We assume asked URLs is in routing, otherwise consider it a bad request
        // Ideally we would send back a 404
        if (isset($urlSegments[0])
            && isset($routing[$urlSegments[0]])
            && isset($urlSegments[1])
            && isset($routing[$urlSegments[0]]['actions'][$urlSegments[1]])
        ) {
            // Determine controller and action in routing
            $controllerName = array_shift($urlSegments);
            $controller = $routing[$controllerName]['controller'];

            $actionName = array_shift($urlSegments);
            $action = $routing[$controllerName]['actions'][$actionName];

            // Set rest of the url as a string
            $urlSegments = implode('/', $urlSegments);

            //Call designated controller and action
            $handler = new $controller();
            $response = $handler->$action($urlSegments, array_merge($_GET, $_POST));

            $formatter = new ResponseFormatter();
            echo $formatter->format($response);

        } else {
            $response = ['message' => 'Bad Request'];
            $formatter = new ResponseFormatter();
            echo $formatter->format($response);
        }

    }
}



