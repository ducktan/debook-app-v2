document.addEventListener("DOMContentLoaded", function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Thêm sản phẩm (AJAX)
    const addProductForm = document.querySelector('#addProductForm');
    if (addProductForm) {
        addProductForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(addProductForm);

            fetch(addProductForm.getAttribute("action"), {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken
                },
                body: formData
            })
            .then(res => {
                if (res.ok) return res.json();
                return res.json().then(data => Promise.reject(data));
            })
            .then(data => {
                // Ẩn modal
                const modalEl = document.getElementById('addProductModal');
                const modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) modal.hide();

                Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: data.message || 'Sản phẩm đã được thêm!',
                    timer: 2000,
                    showConfirmButton: false
                });

                addProductForm.reset();

                setTimeout(() => location.reload(), 2000);
            })
            .catch(err => {
                let msg = "Có lỗi xảy ra!";
                if (err.errors) {
                    msg = Object.values(err.errors).flat().join('<br>');
                } else if (err.message) {
                    msg = err.message;
                }
                Swal.fire({ icon: 'error', title: 'Lỗi', html: msg });
            });
        });
    }
});

// XOÁ
document.querySelectorAll('.delete-product-form').forEach(form => {
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const button = this.querySelector('.delete-product-btn');
        const productName = button.dataset.name;

        Swal.fire({
            title: `Xác nhận xoá`,
            text: `Bạn có chắc muốn xoá sản phẩm "${productName}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Xoá',
            cancelButtonText: 'Huỷ'
        }).then(result => {
            if (result.isConfirmed) {
                fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        _method: 'DELETE'
                    })
                })
                .then(res => {
                    if (res.ok) return res.json();
                    return res.json().then(data => Promise.reject(data));
                })
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Đã xoá',
                        text: data.message || 'Xoá thành công!',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    setTimeout(() => location.reload(), 2000);
                })
                .catch(async err => {
                    let msg = 'Có lỗi xảy ra khi xoá!';
                    if (err.message) msg = err.message;
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: msg
                    });
                });
            }
        });
    });
});

// Fill
document.addEventListener("click", function (e) {
    const btn = e.target.closest(".editProductBtn");
    if (!btn) return;

    // Lấy data attributes
    const id = btn.dataset.id || '';
    const title = btn.dataset.title || '';
    const author = btn.dataset.author || '';
    const type = btn.dataset.type || '';
    const category_id = btn.dataset.category_id || '';
    const publication_date = btn.dataset.publication_date || '';
    const price = btn.dataset.price || '';
    const duration = btn.dataset.duration || '';
    const language = btn.dataset.language || '';
    const description = btn.dataset.description || '';
    const image_url = btn.dataset.image_url || '';
    const file_url = btn.dataset.file_url || '';

    // Gán vào form
    document.getElementById('edit_product_id').value = id;
    document.getElementById('edit_title').value = title;
    document.getElementById('edit_author').value = author;
    document.getElementById('edit_type').value = type;
    document.getElementById('edit_category_id').value = category_id;
    document.getElementById('edit_publication_date').value = publication_date;
    document.getElementById('edit_price').value = price;
    document.getElementById('edit_duration').value = duration;
    document.getElementById('edit_language').value = language;
    document.getElementById('edit_description').value = description;

    // Hiển thị ảnh hiện tại nếu có
    const currentImage = document.getElementById('current_product_image');
    if (image_url) {
        currentImage.src = `/storage/images/products/${image_url}`;
        currentImage.style.display = 'inline-block';
    } else {
        currentImage.style.display = 'none';
    }

    // Hiển thị tên file hiện tại nếu có
    const currentFileName = document.getElementById('current_file_name');
    if (file_url) {
        // Lấy tên file từ đường dẫn url
        const parts = file_url.split('/');
        const fileName = parts[parts.length - 1];
        currentFileName.textContent = 'File hiện tại: ' + fileName;
    } else {
        currentFileName.textContent = '';
    }
     // Cập nhật action cho form cập nhật
    // const editForm = document.getElementById('editProductForm');
    // editForm.action = `/admin/products/update/${id}`;
});

// Update
document.getElementById('editProductForm').addEventListener('submit', function (e) {
    e.preventDefault();

    let form = e.target;
    let formData = new FormData(form);
    let id = document.getElementById('edit_product_id').value;

    fetch(`/admin/products/update/${id}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: formData
    })
    .then(res => {
        if (!res.ok) throw new Error('Có lỗi xảy ra khi gửi request');
        return res.json();
    })
    .then(data => {
        Swal.fire({
            icon: 'success',
            title: 'Thành công',
            text: 'Cập nhật sản phẩm thành công!',
            timer: 2000,
            showConfirmButton: false
        });

        // Ẩn modal
        let modal = bootstrap.Modal.getInstance(document.getElementById('editProductModal'));
        modal.hide();

        location.reload(); // Refresh lại bảng nếu muốn
    })
    .catch(err => {
        Swal.fire({
            icon: 'error',
            title: 'Lỗi',
            text: err.message || 'Không thể cập nhật sản phẩm'
        });
    });
});


