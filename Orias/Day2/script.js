// Chờ cho toàn bộ nội dung trang được tải xong
document.addEventListener('DOMContentLoaded', function() {

    // === PHẦN 1: LOGIC HIỂN THỊ TÊN FILE UPLOAD ===
    const fileInput = document.getElementById('file-upload');
    const fileNameDisplay = document.getElementById('file-name-display');

    // Kiểm tra xem các phần tử có tồn tại không trước khi gán sự kiện
    if (fileInput && fileNameDisplay) {
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileNameDisplay.textContent = this.files[0].name;
            } else {
                fileNameDisplay.textContent = 'Drag and drop files here';
            }
        });
    }


    // === PHẦN 2: LOGIC HIỂN THỊ POPUP XÁC NHẬN ===
    // 'serverData' là biến "cầu nối" được tạo ra từ file index.php
    // Kiểm tra xem biến 'serverData' có tồn tại và thuộc tính 'hasSession' là true không
    if (typeof serverData !== 'undefined' && serverData.hasSession) {
        
        const userChoice = confirm("Bạn có dữ liệu form chưa gửi. Bạn có muốn tiếp tục phiên làm việc này không?");

        // Nếu người dùng nhấn "Không" (Cancel)
        if (!userChoice) {
            // Tải lại trang với tham số đặc biệt để PHP xóa session
            window.location.href = 'index.php?clear_session=true';
        }
    }

});