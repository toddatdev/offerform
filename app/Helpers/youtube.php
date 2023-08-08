<?php

if (!function_exists('video_url')) {

    function video_url($source)
    {
        if ($embedded = youtube_embedded_url($source)) {
            return $embedded;
        }
        return asset("storage/$source");
    }
}

if (!function_exists('youtube_url_parse')) {

    function youtube_url_parse($url)
    {
        $matches = [];
        preg_match("/(?:youtube(?:-nocookie)?\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|vi|shorts|e(?:mbed)?)\/|\S*?[?&]v=|\S*?[?&]vi=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/", $url, $matches);
        return $matches;
    }
}

if (!function_exists('youtube_video_id_from_url')) {

    function youtube_video_id_from_url($url)
    {
        $matches = youtube_url_parse($url);
        if (is_array($matches) && !empty($matches) && isset($matches[1])) {
            return $matches[1];
        }

        return null;
    }
}

if (!function_exists('youtube_embedded_url')) {

    function youtube_embedded_url($url)
    {
        if ($videoId = youtube_video_id_from_url($url)) {
            return "https://www.youtube.com/embed/{$videoId}";
        }
        return null;
    }
}

if (!function_exists('youtube_video_thumbnail')) {

    function youtube_video_thumbnail($url)
    {
        if ($videoId = youtube_video_id_from_url($url)) {
            return "https://img.youtube.com/vi/{$videoId}/mqdefault.jpg";
        }
        return null;
    }
}
