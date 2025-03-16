<?php

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $jobDesc = htmlspecialchars($_POST["comments"]);


    $apiKey = $gemini_api_key;
    $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$apiKey";

    $prompt = "Generate a professional and personalized cold email for a job application. Give only one response. should have 100-150 words only. Don't include subject.
    The candidate's name is $name, and their email is $email. 
    The job description is as follows: 
    \"$jobDesc\". 
    Structure the email professionally, addressing the hiring manager, expressing interest in the role, highlighting relevant skills, and requesting a follow-up. Keep it concise, engaging, and polite.";


    $data = [
        "contents" => [
            [
                "parts" => [
                    ["text" => $prompt]
                ]
            ]
        ]
    ];

    $headers = [
        "Content-Type: application/json"
    ];

    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    curl_close($ch);

    $responseData = json_decode($response, true);
    if (isset($responseData["candidates"][0]["content"]["parts"][0]["text"])) {
        echo nl2br(htmlspecialchars($responseData["candidates"][0]["content"]["parts"][0]["text"]));
    } else {
        echo "Error: Failed to generate email. Please try again.";
    }


















    // $generatedEmail = "
    //     <p><strong>Subject:</strong> Job Application for Relevant Position</p>
    //     <p>Dear Hiring Manager,</p>
    //     <p>I hope this email finds you well. My name is <strong>$name</strong>, and I am interested in applying for the position described below:</p>
    //     <blockquote>$jobDesc</blockquote>
    //     <p>Attached is my resume for your review. Looking forward to discussing this opportunity further.</p>
    //     <p>Best Regards,<br>$name<br>$email</p>
    // ";

    // echo $generatedEmail;
}
?>