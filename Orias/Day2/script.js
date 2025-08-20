const fileInput = document.getElementById('file-upload');
const fileNameDisplay = document.getElementById('file-name-display');
fileInput.addEventListener('change', function() {
    if (this.files.length > 0) {
        fileNameDisplay.textContent = this.files[0].name;
    } else {
        fileNameDisplay.textContent = 'Drag and drop files here';
    }
});