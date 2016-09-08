<?php

/**
 * Class PlaylistRepository
 *
 * @author Sypam <sypam@smile.fr>
 */
class PlaylistRepository
{

    /**
     * Find a playlist by id and send back its data
     *
     * @param int $id identifier of the user
     *
     * @return array playlist data
     */
    public function findOneById($id)
    {
        $queryDriver = DBQuery::getInstance()->getDSN();

        $stmt = $queryDriver->prepare(
            'SELECT id, user_id, title FROM playlists WHERE id = :id LIMIT 1'
        );

        $stmt->execute(['id' => $id]);
        $playlist = $stmt->fetch(PDO::FETCH_ASSOC);

        return $playlist;;
    }

    /**
     * Find a user playlists by id and send back its data
     *
     * @param int $id identifier of the user
     *
     * @return array user data
     */
    public function findByUserId($id)
    {
        $queryDriver = DBQuery::getInstance()->getDSN();

        $stmt = $queryDriver->prepare(
            'SELECT id, title FROM playlists WHERE user_id = :id'
        );

        $stmt->execute(['id' => $id]);
        $playlists = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $playlists;
    }

    /**
     * Add song to playlists by song and playlist id
     *
     * @param int $playlistId identifier of the playlist
     * @param int $songId     identifier of the song
     *
     * @return array user data
     */
    public function addSongToPlaylist($playlistId, $songId)
    {
        $queryDriver = DBQuery::getInstance()->getDSN();

        $stmt = $queryDriver->prepare(
            'INSERT INTO playlists_songs (playlist_id,song_id)
             VALUES (:playlist_id, :song_id)'
        );

        $stmt->bindParam('playlist_id', $playlistId);
        $stmt->bindParam('song_id', $songId);
        $stmt->execute();

        return $stmt->rowCount();
    }

    /**
     * Remove song from playlists by song and playlist id
     *
     * @param int $playlistId identifier of the playlist
     * @param int $songId     identifier of the song
     *
     * @return array user data
     */
    public function removeSongFromPlaylist($playlistId, $songId)
    {
        $queryDriver = DBQuery::getInstance()->getDSN();

        $stmt = $queryDriver->prepare(
            'DELETE FROM playlists_songs WHERE 
              playlist_id = :playlist_id AND song_id = :song_id'
        );

        $stmt->execute(['playlist_id' => $playlistId, 'song_id' => $songId]);

        return $stmt->rowCount();
    }
}



