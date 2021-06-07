<?php
defined("BASE_PATH") OR exit('No direct script access allowed');

function debug($data) {
  header('content-type:application/json');
  echo json_encode($data);
  die();
}

function base_url($path = NULL) : string {
  if (is_null($path)) {
    $path = '';
  }
  return "http://" . $_SERVER['HTTP_HOST'] . "/phperist/$path";
}

function starts_with(string $haystack, string $needle)
{
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}

function ends_with(string $haystack, string $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}

function adjust_brightness(string $hex, int $steps) {
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max(-255, min(255, $steps));

    // Normalize into a six character long hex string
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }

    // Split into three parts: R, G and B
    $color_parts = str_split($hex, 2);
    $return = '#';

    foreach ($color_parts as $color) {
        $color   = hexdec($color); // Convert to decimal
        $color   = max(0,min(255,$color + $steps)); // Adjust color
        $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
    }

    return $return;
}

function redirect(string $link, bool $base = TRUE) {
    if ($base) {
        $link = base_url($link);
    }
    header("Location: $link", TRUE);
    echo "<script>window.location.replace('$link');</script>";
    die();
}

function upload_image($target_dir, $file) {
    $target_file = $target_dir . basename($file["photo"]["name"]);
    $uploadOk = 1;
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $message = "";
    if(TRUE) {
        $check = getimagesize($file["photo"]["tmp_name"]);
        if($check !== false) {
            $message = "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $message = "File is not an image.";
            $uploadOk = 0;

            return ['message' => $message, 'is_successful' => $uploadOk];
        }
    }

    if (file_exists($target_file)) {
        $message = "Sorry, file already exists.";
        $uploadOk = 0;
        return ['message' => $message, 'is_successful' => $uploadOk];
    }

    if($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif" && $image_file_type != "webp" ) {
        $message = "Sorry, only JPG, JPEG, PNG, GIF, and WEBP files are allowed.";
        $uploadOk = 0;
        return ['message' => $message, 'is_successful' => $uploadOk];
    }

    if ($uploadOk == 0) {
        $message = "Sorry, your file was not uploaded.";
        return ['message' => $message, 'is_successful' => $uploadOk];
    } else {
        if (move_uploaded_file($file["photo"]["tmp_name"], $target_file)) {
            $message = "The file ". htmlspecialchars( basename( $file["photo"]["name"])). " has been uploaded.";
            return ['message' => $message, 'is_successful' => 1];
        } else {
            $message = "Sorry, there was an error uploading your file.";
            return ['message' => $message, 'is_successful' => $uploadOk];
        }
    }
}

function session_validate(string $key, string $redirect, bool $base = TRUE) {
    session_start();
    if(!isset($_SESSION[$key])) {
        redirect($redirect, $base);
    }
}

function load_component(string $component_path, $data) {
    foreach ($data as $key => $value) {
        ${$key} = $value;
    }
    include_once("components/$component_path.php");
}