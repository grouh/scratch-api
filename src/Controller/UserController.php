<?php

/**
 * Class UserController
 *
 * @author Sypam <sypam@smile.fr>
 */
class UserController
{

    /**
     * Display user data
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

            $repository = new UserRepository();
            $user = $repository->findOneById($args['id']);

        } elseif (array_key_exists('username', $args)
            && ($args['username'] != '')
        ) {

            $repository = new UserRepository();
            $user = $repository->findOneByUsername($args['username']);

        } elseif ($url != '' && intval($url) > 0) {

            $repository = new UserRepository();
            $user = $repository->findOneById(intval($url));

        } else {
            return ['message' => "Bad request"];
        }

        if (!$user) {
            return ['message' => 'No user found'];
        } else {
            $repository = new PlaylistRepository();
            $playlists = $repository->findByUserId($user['id']);
            if ($playlists) {
                $user['playlists'] = $playlists;
            }
        }

        return ['user' => $user];
    }
}



