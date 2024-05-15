<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Home</title>
    <style>
    .question-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
    }

    .ask-question-btn,
    .answer-btn {
        order: 1;
        margin-right: 20px;
        border: none;
        color: white;
        padding: 7px 25px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        border-radius: 8px;
    }

    .ask-question-btn {
        background-color: #4CAF50;
    }

    .ask-question-btn:hover {
        background-color: #45a049;
    }

    .answer-btn {
        background-color: royalblue;
    }

    .popup-form {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .popup-form button[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .popup-form input[type="text"],
    .popup-form textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .popup-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    .main-content {
        /* Adjust based on your header height */
        margin-left: 220px;
        /* Adjust based on your sidebar width */
        padding: 20px;
    }
    </style>
</head>

<body>
    <div class="main-content">
        <div class="question-header">
            <h1 class="text-capitalize">Questions</h1>
            <button class="ask-question-btn" onclick="togglePopupForm()">Ask Question</button>
        </div>
        <hr>
        <?php foreach ($questions as $question): ?>
        <div class="question-container">
            <div class="question">
                <h3><?php echo $question['title']; ?></h3>
                <?php
                    $escapedBody = htmlspecialchars($question['body'], ENT_QUOTES);
                ?>
                <button class="answer-btn" onclick="redirectToAnswer(this)"
                    data-title="<?php echo $question['title']; ?>" data-body="<?php echo $escapedBody; ?>"
                    data-id="<?php echo $question['question_id']; ?>">Answer</button>
                <p>| Votes: <?php echo $question['votes']; ?></p>
            </div>
        </div>
        <hr>
        <?php endforeach;?>

        <div class="popup-background" id="popupBackground" style="display: none;" onclick="closePopupForm()"></div>
        <div class="popup-form" id="popupForm" style="display: none;">
            <form action="questions" method="POST">
                <label for="title">Question </label>
                <input type="text" id="title" name="title" required>
                <label for="body">Details of the problem</label>
                <textarea id="body" name="body" rows="4" required></textarea>
                <label for="tags">Tags </label>
                <input type="text" id="tags" name="tags" required>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
    <script>
    function togglePopupForm() {
        var form = document.getElementById("popupForm");
        var background = document.getElementById("popupBackground");
        if (form.style.display === "none") {
            form.style.display = "block";
            background.style.display = "block";
        } else {
            form.style.display = "none";
            background.style.display = "none";
        }
    }

    function closePopupForm() {
        var form = document.getElementById("popupForm");
        var background = document.getElementById("popupBackground");
        form.style.display = "none";
        background.style.display = "none";
    }

    function redirectToAnswer(button) {
        var title = button.getAttribute('data-title');
        var body = button.getAttribute('data-body');
        var id = button.getAttribute('data-id');
        var encodedTitle = encodeURIComponent(title);
        var encodedBody = encodeURIComponent(body);
        var encodedId = encodeURIComponent(id);
        var url = '/answers?title=' + encodedTitle + '&body=' + encodedBody + '&question_id=' + encodedId;
        window.location.assign(url);
    }
    </script>
</body>

</html>