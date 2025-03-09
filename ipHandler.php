<?php 
include "config.php";
function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

$userIP = getUserIP();
$sql = "SELECT * FROM ip_info WHERE ip_address = '$userIP'";
$result = $conn->query($sql);
$tz = 'Asia/Kolkata'; date_default_timezone_set($tz);
$currentTime = date('Y-m-d H:i:s');
if ($result->num_rows > 0) {
    $ipData = $result->fetch_assoc();
} else {
    $apiUrl = "https://ipinfo.io/{$userIP}?token=df06bfbbeabc09";
    $response = file_get_contents($apiUrl);
    $data = json_decode($response, true);
    $city = $data['city'] ?? 'Unknown';
    $region = $data['region'] ?? 'Unknown';
    $country = $data['country'] ?? 'Unknown';
    $loc = $data['loc'] ?? null;
    $timezone = $data['timezone'] ?? 'Unknown';
    $org = $data['org'] ?? 'Unknown';
    $hostname = $data['hostname'] ?? 'Unknown';
    $postal = $data['postal'] ?? 'Unknown';

    if ($loc) {
        list($latitude, $longitude) = explode(',', $loc);
    } else {
        $latitude = $longitude = 0; 
    }

    $stmt = $conn->prepare("INSERT INTO ip_info (ip_address, city, region, country, latitude, longitude, timezone, host, org, postal, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssddsssss", $userIP, $city, $region, $country, $latitude, $longitude, $timezone, $hostname, $org, $postal, $currentTime);
    $stmt->execute();
}


$pageUrl = $_SERVER['REQUEST_URI'];
$stmt = $conn->prepare("INSERT INTO page_visits (ip_address, page_url,visit_time) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $userIP, $pageUrl, $currentTime);
$stmt->execute();
