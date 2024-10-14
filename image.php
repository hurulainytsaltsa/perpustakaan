<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Upload Foto dengan Preview</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        /* Tambahkan gaya CSS untuk preview area */
        #preview-container {
            max-width: 300px;
            margin-top: 20px;
        }
        #image-preview {
            max-width: 100%;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="photo">Pilih Foto:</label>
            <input type="file" class="form-control" id="photo" name="photo" required onchange="previewImage(this);">
        </div>

        <!-- Preview Area -->
        <div id="preview-container">
            <img id="image-preview" src="#" alt="Preview" style="display:none;">
        </div>

        <button type="submit" class="btn btn-primary">Upload Foto</button>
    </form>
</div>

<script>
function previewImage(input) {
    var file = input.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('image-preview').src = e.target.result;
            document.getElementById('image-preview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}
</script>

</body>
</html>
