<?php

function sendMail($userData) {

        $to = ADMIN_MAIL . ', ';
        $to .= "{$userData['email']}";
        $subject = 'New CV';
        $message = renderBodyMail($userData);
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";
        mail($to, $subject, $message, $headers);
}

function renderBodyMail($userData) {
    $message = "<html>
                    <head>
                        <title>Birthday Reminders for August</title>
                    </head>
                    <body>
                        <p>Here are the birthdays upcoming in August!</p>
                        <table>
                            <tr><td></td>Name<td>{$userData['name']}</td></tr>
                            <tr><td></td>Surname<td>{$userData['surname']}</td></tr>
                            <tr><td></td>Age<td>{$userData['age']}</td></tr>
                            <tr><td></td>Birthday<td>{$userData['birthday']}</td></tr>
                            <tr><td></td>Email<td>{$userData['email']}</td></tr>
                            <tr><td></td>Country<td>{$userData['country']}</td></tr>
                            <tr><td></td>City<td>{$userData['city']}</td></tr>
                            <tr><td></td>Address<td>{$userData['address']}</td></tr>
                            <tr><td></td>Skills<td>{$userData['skills']}</td></tr>
                            <tr><td></td>Job Title<td>{$userData['jobTitle']}</td></tr>
                            <tr><td></td>Company Name<td>{$userData['companyName']}</td></tr>
                            <tr><td></td>Start Date<td>{$userData['startDate']}</td></tr>
                            <tr><td></td>End Date<td>{$userData['endDate']}</td></tr>
                        </table>
                    </body>
                </html>";
    return $message;
}