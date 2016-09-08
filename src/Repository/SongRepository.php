<?php

/**
 * Class SongRepository
 *
 * @author Sypam <sypam@smile.fr>
 */
class SongRepository
{

    /**
     * Find a song by id and send back its data
     * @param int $id identifier of the song
     * @return array song data
     */
    public function findOneById($id)
    {
        $queryDriver = DBQuery::getInstance()->getDSN();

        $stmt = $queryDriver->prepare(
            'SELECT id, title, duration FROM songs WHERE id = :id LIMIT 1'
        );

        $stmt->execute(['id' => $id]);
        $song = $stmt->fetch(PDO::FETCH_ASSOC);

        return $song;
    }

    /**
     * Find a songs by playlist id and send back its data
     * @param int $id identifier of the playlist
     * @return array songs data
     */
    public function findByPlaylistId($id)
    {
        $queryDriver = DBQuery::getInstance()->getDSN();

        $stmt = $queryDriver->prepare(
            'SELECT songs.id, songs.title, songs.duration 
            FROM playlists_songs 
            LEFT JOIN songs ON songs.id = playlists_songs.song_id
            WHERE playlists_songs.playlist_id = :id '
        );

        $stmt->execute(['id' => $id]);
        $songs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $songs;
    }
}



