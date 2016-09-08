<?php

/**
 * Class ResponseFormatter
 * This class handle formatting before the response is sent back to the user
 * Additional formatting can be declared here
 * 
 * @author Sypam <sypam@smile.fr>
 */
class ResponseFormatter
{
    /**
     * This function apply a json encode on the response
     * @param string $url url to handle
     * @return null
     */
    public function format($reponse)
    {
        header('Content-Type: application/json');
        return json_encode($reponse);
    }
}



