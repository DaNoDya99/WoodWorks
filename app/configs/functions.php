<?php



function show($stuff)
{
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

function str_to_url($url)
{

    $url = str_replace("'", "", $url);
    $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
    $url = trim($url, "-");
    $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
    $url = strtolower($url);
    $url = preg_replace('~[^-a-z0-9_]+~', '', $url);

    return $url;
}

function set_value($key, $default = '')
{

    if (!empty($_POST[$key])) {
        return $_POST[$key];
    } else if (!empty($default)) {
        return $default;
    }

    return '';
}


function esc($str)
{
    return nl2br(htmlspecialchars($str));
}

function resize_image($filename, $max_size = 700)
{

    $type = mime_content_type($filename);

    if (file_exists($filename)) {
        switch ($type) {

            case 'image/png':
                $image = imagecreatefrompng($filename);
                break;

            case 'image/gif':
                $image = imagecreatefromgif($filename);
                break;

            case 'image/jpeg':
                $image = imagecreatefromjpeg($filename);
                break;

            default:
                $image = imagecreatefromjpeg($filename);
                break;
        }

        $src_w = imagesx($image);
        $src_h = imagesy($image);

        if ($src_w > $src_h) {
            if ($src_w < $max_size) {
                $max_size = $src_w;
            }

            $dst_w = $max_size;
            $dst_h = ($src_h / $src_w) * $max_size;
        } else {

            if ($src_h < $max_size) {
                $max_size = $src_h;
            }
            $dst_w = ($src_w / $src_h) * $max_size;
            $dst_h = $max_size;
        }

        $dst_image = imagecreatetruecolor($dst_w, $dst_h);

        if ($type == 'image/png') {
            imagealphablending($dst_image, false);
            imagesavealpha($dst_image, true);
        }

        imagecopyresampled($dst_image, $image, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);

        imagedestroy($image);

        imagejpeg($dst_image, $filename, 90);
        switch ($type) {

            case 'image/png':
                imagepng($dst_image, $filename);
                break;

            case 'image/gif':
                imagegif($dst_image, $filename);
                break;

            case 'image/jpeg':
                imagejpeg($dst_image, $filename, 90);
                break;

            default:
                imagejpeg($dst_image, $filename, 90);
                break;
        }

        imagedestroy($dst_image);
    }

    return $filename;
}
function exportToCsv($data, $filename)
{
    // show($data);
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    $file = fopen('php://output', 'w');
    foreach ($data as $row) {
        $row = (array)$row;
        fputcsv($file, (array)$row);
    }
    fclose($file);
}

/**
 * @throws \PHPMailer\PHPMailer\Exception
 */
