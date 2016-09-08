<?php

/**
 * Class PlaylistController
 *
 * @author Sypam <sypam@smile.fr>
 */
class PlaylistController
{

    /**
     * Display playlist data
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

            $repository = new PlaylistRepository();
            $playlist = $repository->findOneById($args['id']);

        } elseif ($url != '' && intval($url) > 0) {

            $repository = new PlaylistRepository();
            $playlist = $repository->findOneById(intval($url));

        } else {
            return ['message' => "Bad request"];
        }

        if (!$playlist) {
            return ['message' => 'No playlist found'];
        } else {
            $repository = new SongRepository();
            $songs = $repository->findByPlaylistId($playlist['id']);
            if ($songs) {
                $playlist['songs'] = $songs;
            }
        }

        return ['playlist' => $playlist];
    }

    /**
     * Display playlist data
     *
     * @param string $url  left url elements
     * @param array  $args get and post data
     *
     * @return array data sent back
     */
    public function editAction($url, $args)
    {
        // Check for existing playlist
        if (array_key_exists('id', $args)
            && (intval($args['id'])>0)
        ) {

            $playlistRepository = new PlaylistRepository();
            $playlist = $playlistRepository->findOneById($args['id']);

        } elseif ($url != '' && intval($url) > 0) {

            $playlistRepository = new PlaylistRepository();
            $playlist = $playlistRepository->findOneById(intval($url));

        } else {
            return ['message' => "Bad request"];
        }

        if (!$playlist) {
            return ['message' => 'No playlist found'];
        } else {

            // Determine action and song ID
            if (array_key_exists('add', $args)
                && (intval($args['add'])>0)
            ) {
                $move = 'add';
                $songId = $args['add'];
            } elseif (array_key_exists('remove', $args)
                && (intval($args['remove'])>0)
            ) {
                $move = 'remove';
                $songId = $args['remove'];
            } else {
                return ['message' => 'No action asked'];
            }

            // Check for song
            $songRepository = new SongRepository();
            $song = $songRepository->findOneById($songId);

            if (!$song) {
                return ['message' => 'No song found'];
            } else {

                // Check for song in playlist
                $playlistSongs = $songRepository->findByPlaylistId($playlist['id']);

                $isInPlaylist = false;
                foreach ($playlistSongs as $playlistSong) {
                    if ($playlistSong['id'] == $song['id']) {
                        $isInPlaylist = true;
                    }
                }

                // Control if action is needed (song in or out of playlist)
                if ($isInPlaylist && $move == 'add') {
                    return ['message' => 'Already in playlist'];
                } elseif (!$isInPlaylist && $move == 'remove') {
                    return ['message' => 'Not in playlist'];
                }

                // Launch the modification
                if ($move == 'add') {
                    $result = $playlistRepository->addSongToPlaylist(
                        $playlist['id'], $args['add']
                    );
                } else {
                    $result = $playlistRepository->removeSongFromPlaylist(
                        $playlist['id'], $args['remove']
                    );
                }

                if ($result) {
                    return ['message' => 'Success'];
                }
            }

        }

        return ['message' => 'Bad request'];
    }
}



