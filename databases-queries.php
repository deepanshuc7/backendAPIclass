<?php
$db = new SQLite3(__DIR__ . '../database/spotify.sqlite');

//  Count all tracks
$countTracks = $db->querySingle("SELECT COUNT(*) FROM tracks");

//  Tracks with 'you' in title
$youTracksRes = $db->query("SELECT Name FROM tracks WHERE Name LIKE '%you%'");
$youList = '';
while ($row = $youTracksRes->fetchArray(SQLITE3_ASSOC)) {
    $youList .= '<li>' . htmlspecialchars($row['Name']) . '</li>';
}
$countYouTracks = substr_count($youList, '<li>');

//  Tracks with 'you' AND 'i' in title
$youAndIRes = $db->query("SELECT Name FROM tracks WHERE Name LIKE '%you%' AND Name LIKE '%i%'");
$youAndIList = '';
while ($row = $youAndIRes->fetchArray(SQLITE3_ASSOC)) {
    $youAndIList .= '<li>' . htmlspecialchars($row['Name']) . '</li>';
}

//  Tracks with 'you' AND 'i' in title AND album title contains 'chron' or 'vol'
$tracksWithAlbumRes = $db->query("
    SELECT tracks.Name AS TrackName, albums.Title AS AlbumTitle
    FROM tracks
    JOIN albums ON tracks.AlbumId = albums.AlbumId
    WHERE tracks.Name LIKE '%you%' AND tracks.Name LIKE '%i%'
      AND (albums.Title LIKE '%chron%' OR albums.Title LIKE '%vol%')
");
$trackAlbumList = '';
$countTrackAlbum = 0;
while ($row = $tracksWithAlbumRes->fetchArray(SQLITE3_ASSOC)) {
    $trackAlbumList .= '<li>' . htmlspecialchars($row['TrackName']) . ' (Album: ' . htmlspecialchars($row['AlbumTitle']) . ')</li>';
    $countTrackAlbum++;
}

//  Tracks with albums and artists info
$fullTrackInfoRes = $db->query("
    SELECT tracks.Name AS TrackName, albums.Title AS AlbumTitle, artists.Name AS ArtistName
    FROM tracks
    JOIN albums ON tracks.AlbumId = albums.AlbumId
    JOIN artists ON albums.ArtistId = artists.ArtistId
    WHERE tracks.Name LIKE '%you%' AND tracks.Name LIKE '%i%'
      AND (albums.Title LIKE '%chron%' OR albums.Title LIKE '%vol%')
");
$fullTrackList = '';
while ($row = $fullTrackInfoRes->fetchArray(SQLITE3_ASSOC)) {
    $fullTrackList .= '<li>' . htmlspecialchars($row['TrackName']) . ' (Album: ' . htmlspecialchars($row['AlbumTitle']) . ', Artist: ' . htmlspecialchars($row['ArtistName']) . ')</li>';
}

//  List artists only (distinct)
$artistListRes = $db->query("
    SELECT DISTINCT artists.Name
    FROM tracks
    JOIN albums ON tracks.AlbumId = albums.AlbumId
    JOIN artists ON albums.ArtistId = artists.ArtistId
    WHERE tracks.Name LIKE '%you%' AND tracks.Name LIKE '%i%'
      AND (albums.Title LIKE '%chron%' OR albums.Title LIKE '%vol%')
");
$artistList = '';
while ($row = $artistListRes->fetchArray(SQLITE3_ASSOC)) {
    $artistList .= '<li>' . htmlspecialchars($row['Name']) . '</li>';
}

//  Playlists containing "I put a spell on you"
$trackId = $db->querySingle("SELECT TrackId FROM tracks WHERE Name LIKE '%I put a spell on you%'");
$playlistList = '';
$firstPlaylistId = null;
$firstPlaylistName = '';
if ($trackId) {
    $playlistRes = $db->query("
        SELECT playlists.PlaylistId, playlists.Name
        FROM playlist_track
        JOIN playlists ON playlist_track.PlaylistId = playlists.PlaylistId
        WHERE playlist_track.TrackId = $trackId
    ");
    while ($row = $playlistRes->fetchArray(SQLITE3_ASSOC)) {
        $playlistList .= '<li>' . htmlspecialchars($row['Name']) . '</li>';
        if ($firstPlaylistId === null) {
            $firstPlaylistId = (int)$row['PlaylistId'];
            $firstPlaylistName = htmlspecialchars($row['Name']);
        }
    }
}

//  Songs in the first playlist
$playlistSongList = '';
if ($firstPlaylistId) {
    $playlistSongsRes = $db->query("
        SELECT tracks.Name
        FROM playlist_track
        JOIN tracks ON playlist_track.TrackId = tracks.TrackId
        WHERE playlist_track.PlaylistId = $firstPlaylistId
    ");
    while ($row = $playlistSongsRes->fetchArray(SQLITE3_ASSOC)) {
        $playlistSongList .= '<li>' . htmlspecialchars($row['Name']) . '</li>';
    }
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <style>
            .chat-container {
                width: 80%;
                margin: 20px auto;
                background-color: white;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }

            .chat-history {
                padding: 20px;
            }

            .message {
                margin-bottom: 20px;
                padding: 10px;
                border-radius: 8px;
                clear: both;
            }

            .message.user {
                background-color: #e0f7fa;
                align-self: flex-end;
                float: left;
            }

            .message.bot {
                background-color: #f0f0f0;
                float: right;
            }

            .message .timestamp {
                font-size: 0.8em;
                color: #888;
                margin-top: 5px;
            }
        </style>
    </head>
    <body>
        <h1>Databases: queries</h1>

        <ul>
            <li>You wake up after a deep sleep. But something doesn't seem right. You can't feel your body. Strange... You look around, but the only thing you can see are 0s and 1s. Oh no! You woke up as an AI chatbot trained on the spotify.sqlite database!</li>

            <li>Wait, some one is talking to you...

                <div class="chat-container">
                    <div class="chat-history">
                        <div class="message user">
                            Hello! Can you help me out? I need some information...
                            <div class="timestamp">10:01 AM</div>
                        </div>
                        <div class="message bot">
                            10100 00 1? W01r0 0m 1? Wh0r0 a0 I? Whe0e am I? Where am I? Wow... that was weird. Ehh, I don't know man. Who are you? I just woke up and I don't feel too well. What do you need?
                            <div class="timestamp">10:02 AM</div>
                        </div>
                        <div class="message user">
                            Jeez, these AI bots nowadays... I don't got time for this, alright. Anyway, listen, I'm looking for a song...
                            <div class="timestamp">10:03 AM</div>
                        </div>
                        <div class="message bot">
                            Ok... I'll need some more information than that. I can see <b><?= $countTracks ?></b> songs here...
                            <div class="timestamp">10:05 AM</div>
                        </div>
                        <div class="message user">
                            Well, it goes something like <i>wom, wom, wom, drumroll, takka, takka</i>
                            <div class="timestamp">10:07 AM</div>
                        </div>

                        <div class="message bot">
                            Ok, that's not really helping. Do you have something like a lyric?
                            <div class="timestamp">10:07 AM</div>
                        </div>

                        <div class="message user">
                            Well, it's a guy, and he screams. Like, really loud. Something like eh eh eh eh eh <i>youuuuu</i>
                            <div class="timestamp">10:08 AM</div>
                        </div>

                        <div class="message bot">
                            Ok, pff... let me have a look. I see <b><?= $countYouTracks ?></b> songs containing the word <i>you</i>. Do you want me to repeat them to you?
                            <div class="timestamp">10:08 AM</div>
                        </div>

                        <div class="message user">
                            Sure...
                            <div class="timestamp">10:10 AM</div>
                        </div>

                        <div class="message bot">
                            Here you go: <ul><?= $youList ?></ul>
                            <div class="timestamp">10:11 AM</div>
                        </div>

                        <div class="message user">
                            That's a lot. I already forgot what you said. Can you slim it down a little maybe? It's coming back to me. I think the dude also starts with 'I' eh eh eh eh 'you'.
                            <div class="timestamp">10:12 AM</div>
                        </div>

                        <div class="message bot">
                            So you want to know all the tracks that contain the word 'you' and 'I' in the title? You're vague man, but can do. Here you go: <ul><?= $youAndIList ?></ul>
                            <div class="timestamp">10:12 AM</div>
                        </div>

                        <div class="message user">
                            Still not helping. But I remember something else now. I first heard the song on an album that had 'vol' or 'chron' in the title.
                            <div class="timestamp">10:13 AM</div>
                        </div>

                        <div class="message bot">
                            Now we're getting somewhere. Vol or chron, ehh. I've found <b><?= $countTrackAlbum ?></b> tracks that are on an album that contain the word 'chron' or 'vol' and that has songs that have the words 'you' and 'i' in the title. Here they are: <ul><?= $trackAlbumList ?></ul>
                            <div class="timestamp">10:14 AM</div>
                        </div>

                        <div class="message user">
                            Hm, still doesn't ring a bell. Do you also see the artist?
                            <div class="timestamp">10:14 AM</div>
                        </div>

                        <div class="message bot">
                            Ah, yeah, I see them. <ul><?= $fullTrackList ?></ul>
                            <div class="timestamp">10:14 AM</div>
                        </div>

                        <div class="message user">
                            Can you just tell me the artists, not the songs?
                            <div class="timestamp">10:15 AM</div>
                        </div>

                        <div class="message bot">
                            No biggie. <ul><?= $artistList ?></ul>
                            <div class="timestamp">10:15 AM</div>
                        </div>

                        <div class="message user">
                            Yes! I remember it clearly now! It was looking for was <i>I put a spell on you</i>, by <i>CCR</i>! Wow, that's great. You're pretty good. Thanks man.
                            <div class="timestamp">10:16 AM</div>
                        </div>

                        <div class="message bot">
                            No worries. Anything else I can be of any asistance with, I'm here now anyway.
                            <div class="timestamp">10:16 AM</div>
                        </div>

                        <div class="message user">
                            Yeah, I'm looking for some similar music. Can you show me some playlists that have this song?
                            <div class="timestamp">10:17 AM</div>
                        </div>

                        <div class="message user">
                            Hello? Are you still there?
                            <div class="timestamp">10:32 AM</div>
                        </div>

                        <div class="message user">
                            Helloooohoo?
                            <div class="timestamp">10:45 AM</div>
                        </div>

                        <div class="message bot">
                            Oops, sorry, I felt a bit sick. I had to go to the garbage collector. I'm back now, let me have a look: <ul><?= $playlistList ?></ul>
                            <div class="timestamp">10:46 AM</div>
                        </div>

                        <div class="message user">
                            Ok, great. Can you tell me what other songs are in the first playlist?
                            <div class="timestamp">10:47 AM</div>
                        </div>

                        <div class="message bot">
                            Sure. The playlist is called: <b><?= $firstPlaylistName ?></b>, and here are all the songs that are in it: <ul><?= $playlistSongList ?></ul>
                            <div class="timestamp">10:48 AM</div>
                        </div>

                    </div>
                </div>
            </li>
        </ul>
    </body>
</html>
