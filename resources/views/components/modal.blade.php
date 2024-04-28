<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 20% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            max-width: 400px;
            border-radius: 8px;
        }

        .close {
            color: #ff0000;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .buttons {
            text-align: right;
        }

        button {
            padding: 8px 16px;
            margin-left: 8px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #confirmButton {
            background-color: #4CAF50;
            color: white;
        }

        #cancelButton {
            background-color: #ccc;
        }
    </style>
</head>

<body>
    <!-- Modal -->
    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Confirmation</h2>
            <p id="confirmationText"></p>
            <div class="buttons">
                <button id="cancelButton">キャンセル</button>
                <button id="confirmButton">OK</button>

            </div>
        </div>
    </div>
</body>
<script>
    var span = document.getElementsByClassName("close")[0];


    span.onclick = function() {
        document.getElementById('confirmationModal').style.display = 'none';
    };


    window.onclick = function(event) {
        if (event.target == document.getElementById('confirmationModal')) {
            document.getElementById('confirmationModal').style.display = 'none';
        }
    };
</script>

</html>
