<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="result.css">
    </head>
<body>
    <div class="container">
        <div class="card">
          <h3>Calculate Your Calories</h3>
          <div class="drop_box">
            <input type="file" accept="image/*" id="fileID" style="display: none;" >
            <button class="uploadButton"  id="uploadButton">Find new image</button>
            <input type="submit" class="submit" value="Calculate">
          </div>
        </div>
    </div>
    <div class="total">
        <h2>xx has a total of xx Calories</h2>
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
