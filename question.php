<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập Dữ liệu JSON</title>
    <style>
        .question {
            color: red;
        }
    </style>
</head>
<body>

<h2>Nhập Dữ liệu JSON</h2>
<form method="post">
    <textarea name="jsonData" rows="10" cols="50" placeholder='Nhập JSON vào đây'></textarea><br><br>
    <button type="submit">Gửi</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu JSON từ form
    $jsonData = $_POST['jsonData'];

    // Chuyển đổi JSON thành mảng PHP
    $data = json_decode($jsonData, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "<p style='color: red;'>Dữ liệu JSON không hợp lệ.</p>";
        exit;
    }

    // Hiển thị question_direction và các đáp án với số thứ tự
    $questionNumber = 1;
    foreach ($data as $question) {
        // Lấy câu hỏi
        $questionDirection = $question['question_direction'];
        echo "<h3 class='question'>Câu {$questionNumber}:</h3>";
        echo "<p class='question'>" . strip_tags($questionDirection) . "</p>";

        // Lấy các đáp án
        echo "<h4>Đáp án:</h4><ul>";
        foreach ($question['answer_option'] as $answer) {
            echo "<li>" . strip_tags($answer['value']) . "</li>";
        }
        echo "</ul>";

        // Tăng số thứ tự câu hỏi
        $questionNumber++;
    }
}
?>

</body>
</html>
