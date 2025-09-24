function openPopup(id) {
    document.getElementById(id).style.display = 'flex';
}
function closePopup(id) {
    document.getElementById(id).style.display = 'none';
}
function confirmDelete(url) {
    if (confirm("Bạn có chắc chắn muốn xóa bản ghi này?")) {
        window.location = url;
    }
}
