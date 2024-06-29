<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="scan.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h3>Calculate Your Calories</h3>
            <div class="drop_box">
                <header>
                    <h4>Find your meal here</h4>
                </header>
                <p>Files Supported: jpg, png, jpeg</p>
                <form method="post" action="process.php" enctype="multipart/form-data">
                    <input type="file" accept="image/*" id="fileID" name="image" style="display: none;" required>
                    <button type="button" class="uploadButton" id="uploadButton">Find Image</button>
                    <br><br>
                    <label for="grams">Enter Grams:</label>
                    <input type="number" id="grams" name="grams" required>
                    <br><br>
                    <input type="submit" class="submit" value="Calculate">
                </form>
            </div>
        </div>
    </div>

    <script>
        const fileInput = document.getElementById('fileID');
        const uploadButton = document.getElementById('uploadButton');

        uploadButton.addEventListener('click', () => {
            fileInput.click();
        });
    </script>
</body>
</html>