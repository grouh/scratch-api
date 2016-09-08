<?php

/**
 * Class SongController
 *
 * @author Sypam <sypam@smile.fr>
 */
class SongController
{

    /**
     * Display song data
     *
     * @param string $url  left url elements
     * @param array  $args get and post data
     *
     * @return array data sent back
     */
    public function viewAction($url, $args)
    {

        if (array_key_exists('id', $args)
            && (intval($args['id'])>0)
        ) {

            $repository = new SongRepository();
            $song = $repository->findOneById($args['id']);

        } elseif ($url != '' && intval($url) > 0) {

            $repository = new SongRepository();
            $song = $repository->findOneById(intval($url));

        } else {
            return ['message' => "Bad request"];
        }

        if (!$song) {
            return ['message' => 'No song found'];
        }

        return ['song' => $song];
    }

}



