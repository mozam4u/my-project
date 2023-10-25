<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <thead>

    </thead>
    <tbody>

        @php

        echo "<strong>Note:Date parameter variale should be like 2018-06-26(Y-M-D)</strong><br /><br />";
        $datequery = Request::input('date');
        if (empty($datequery)) {
        return "<br /><strong>
            <font color='red'>Please Insert Date Query Parameter </font>
        </strong><br /><br />";
        }


        $year = date("Y");
        $month = date("m");
        $day = date("d");
        // The folder path for our file should be YYYY/MM/DD
        $directory = "image/" . "$year/$month/$day/";
        // If the directory doesn't already exist.
        if (!File::isDirectory($directory)) {
        // Create our directory.
        File::makeDirectory($directory, 0777, true);
        }

        function fileUrl($url)
        {
        $parts = parse_url($url);
        $path_parts = array_map('rawurldecode', explode('/', $parts['path']));
        return $parts['scheme'] . '://' . $parts['host'] . implode('/', array_map('rawurlencode', $path_parts));
        }
        $cDrivePath = 'C:/images/';

        // Get the current year, month, and day
        $year = date("Y");
        $month = date("m");
        $day = date("d");

        // Create the directory structure if it doesn't exist
        $directory = $cDrivePath . "$year/$month/$day/";

        if (!File::isDirectory($directory)) {
        File::makeDirectory($directory, 0777, true);
        }
        $count = 0;
        if ($data->count() > 0) {
        echo '<table width="1300" border="3">';
            echo '<tr>';
                echo '<td><strong>S.No.</strong></td>';
                echo '<td><strong>Image Path</strong></td>';
                echo '<td>Downloaded</td>';
                echo '</tr>';

            foreach ($data as $row) {
            echo "<tr>
                <td>";
                    echo $count = $count + 1;
                    echo "</td>
                <td>";
                    $imagePath = $row->OriginalPath;
                    echo ' <a href="https://itgdms.intoday.com/mams/' . $imagePath . '" target="_blank">' . $imagePath . '</a>';
                    echo '</td>
                <td>';
                    $downloadImageUurl = fileUrl("https://itgdms.intoday.com/mams/" . $imagePath . "");
                    $img = $directory . basename(parse_url($imagePath, PHP_URL_PATH));
                    $imageData = file_get_contents($downloadImageUurl);
                    if ($imageData !== false) {
                    $result_downloadImageUurl = file_put_contents($img, $imageData);
                    if ($result_downloadImageUurl !== false) {
                    echo "<strong>
                        <font color='#009900'>Image downloaded and saved successfully.</font>
                    </strong>";
                    } else {
                    echo "<strong>
                        <font color='red'>Error saving the image to the destination.</font>
                    </strong>";
                    }
                    } else {
                    echo "<strong>Error downloading the image from the URL.</strong>";
                    }
                    echo "</td>
            </tr>";
            }
            echo "</table>";
        } else {
        echo "No Data Found";
        }
        // Method for image name for space
        function file_url($url){
        $parts = parse_url($url);
        $path_parts = array_map('rawurldecode', explode('/', $parts['path']));
        return
        $parts['scheme'] . '://' .
        $parts['host'] .
        implode('/', array_map('rawurlencode', $path_parts));
        }

        @endphp

        <!-- {{ $stringValue="date="}} -->
        <a href="{{ route('data.download', $stringValue.' '.$datequery) }}">Download CSV File</a>

    </tbody>
    </table>
</body>

</html>
