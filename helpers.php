
if (!function_exists('file_url')) {
    function file_url($url)
    {
        $parts = parse_url($url);
        $path_parts = array_map('rawurldecode', explode('/', $parts['path']));
        return $parts['scheme'] . '://' . $parts['host'] . implode('/', array_map('rawurlencode', $path_parts));
    }
}

function file_url($url)
{
    $parts = parse_url($url);
    $path_parts = array_map('rawurldecode', explode('/', $parts['path']));
    return $parts['scheme'] . '://' . $parts['host'] . implode('/', array_map('rawurlencode', $path_parts));
}