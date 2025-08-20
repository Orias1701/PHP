<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../../../font-6-pro/css/all.css">
    <title>Valid Form</title>
</head>
<body>
    <h2>Payment Receipt Upload Form</h2>
    <form class="form">
        <div class="form-input">
            <div class="info">
                <label class = "label-top" for="inf">Name</label>
                <input type="text" class="inf">
                <label class = "label-bot" for="inf">First Name</label>
            </div>
            <div class="info">
                <label class = "label-top" for="inf"></label>
                <input type="text" class="inf">
                <label class = "label-bot" for="inf">Last Name</label>
            </div>
            <div class="info">
                <label class = "label-top" for="inf">Email</label>
                <input type="text" class="inf">
                <label class = "label-bot" for="inf">example@example.com</label>
            </div>
            <div class="info">
                <label class = "label-top" for="inf">Invoice ID</label>
                <input type="text" class="inf">
                <label class = "label-bot" for="inf"></label>
            </div>
        </div>
        <div class="checkboxes">
            <label class = "label-top" for="inf">Pay For</label>
            <div class="boxes">
                <label><input type="checkbox" name="category[]" value="15K Category"> 15K Category</label>
                <label><input type="checkbox" name="category[]" value="35K Category"> 35K Category</label>
                <label><input type="checkbox" name="category[]" value="55K Category"> 55K Category</label>
                <label><input type="checkbox" name="category[]" value="75K Category"> 75K Category</label>
                <label><input type="checkbox" name="category[]" value="116K Category"> 116K Category</label>
                <label><input type="checkbox" name="category[]" value="Shuttle One Way"> Shuttle One Way</label>
                <label><input type="checkbox" name="category[]" value="Shuttle Two Ways"> Shuttle Two Ways</label>
                <label><input type="checkbox" name="category[]" value="Training Cap Merchandise"> Training Cap Merchandise</label>
                <label><input type="checkbox" name="category[]" value="Compressport T-Shirt Merchandise"> Compressport T-Shirt Merchandise</label>
                <label><input type="checkbox" name="category[]" value="Buf Merchandise"> Buf Merchandise</label>
                <label><input type="checkbox" name="category[]" value="Other"> Other</label>
            </div>
        </div>
        <div class="upload">
            <label for="file-upload" class="upload-box" id="drop-area">
                <i class="fa-solid fa-cloud-arrow-up"></i>
                <p id = "browse-file">Browse Files</p>
                <p>Drag and drop files here</p>
                <input id="file-upload" type="file" accept=".jpg,.jpeg,.png,.gif" />
            </label>     
        </div>
        <small>jpg, jpeg, png, gif (1mb max.)</small>
        <div class="message">
            <label for="message-box" class="label-top">Additional Information</label>
            <textarea name="message-box" class="message-box" rows="5" cols="40" placeholder="Type here..."></textarea>
        </div>
    </form>
</body>
</html>