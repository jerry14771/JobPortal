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

if ($result->num_rows > 0) {
    $ipData = $result->fetch_assoc();
} else {
    $apiUrl = "https://ipapi.co/{$userIP}/json/";
    $response = file_get_contents($apiUrl);
    $data = json_decode($response, true);
    $city = $data['city'] ?? 'Unknown';
    $region = $data['region'] ?? 'Unknown';
    $country = $data['country_name'] ?? 'Unknown';
    $latitude = $data['latitude'] ?? null;
    $longitude = $data['longitude'] ?? null;
    $timezone = $data['timezone'] ?? 'Unknown';
    $currency = $data['currency'] ?? 'Unknown';
    $org = $data['org'] ?? 'Unknown';
    $stmt = $conn->prepare("INSERT INTO ip_info (ip_address, city, region, country, latitude, longitude, timezone, currency, org) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssddsss", $userIP, $city, $region, $country, $latitude, $longitude, $timezone, $currency, $org);
    $stmt->execute();
}

$pageUrl = $_SERVER['REQUEST_URI'];
$stmt = $conn->prepare("INSERT INTO page_visits (ip_address, page_url) VALUES (?, ?)");
$stmt->bind_param("ss", $userIP, $pageUrl);
$stmt->execute();
