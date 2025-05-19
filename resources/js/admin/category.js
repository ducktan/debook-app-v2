document.addEventListener("DOMContentLoaded", function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // ========== Thêm danh mục ==========
    const addCategoryForm = document.querySelector('#addCategoryForm');
    if (addCategoryForm) {
        addCategoryForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const formData = new FormData(addCategoryForm);

            fetch(addCategoryForm.getAttribute("action"), {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken
                },
                body: formData
            })
            .then(res => res.ok ? res.json() : Promise.reject(res))
            .then(data => {
                bootstrap.Modal.getInstance(document.getElementById('addCategoryModal')).hide();
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: data.message || 'Đã thêm danh mục!',
                    timer: 2000,
                    showConfirmButton: false
                });
                addCategoryForm.reset();
                setTimeout(() => location.reload(), 2000);
            })
            .catch(async err => {
                let msg = "Có lỗi xảy ra!";
                if (err.status === 422) {
                    const data = await err.json();
                    msg = Object.values(data.errors).flat().join('<br>');
                }
                Swal.fire({ icon: 'error', title: 'Lỗi', html: msg });
            });
        });
    }

    // ========== Xoá danh mục (AJAX) ==========
    document.querySelectorAll('.delete-category-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const button = this.querySelector('.delete-category-btn');
            const categoryName = button.dataset.name;

            Swal.fire({
                title: `Xác nhận xoá`,
                text: `Bạn có chắc muốn xoá danh mục "${categoryName}"?`,
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
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: new URLSearchParams({
                            _method: 'DELETE'
                        })
                    })
                    .then(res => res.ok ? res.json() : Promise.reject(res))
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
                        if (err.status === 403 || err.status === 422) {
                            const data = await err.json();
                            msg = data.message || msg;
                        }
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

     // ========== Mở modal cập nhật người dùng ==========
    
    document.addEventListener("click", function (e) {
        const btn = e.target.closest(".editCategoryBtn");
        if (btn) {
            // Lấy dữ liệu từ button
            const id = btn.dataset.id;
            const name = btn.dataset.name;
            const slug = btn.dataset.slug;
            const description = btn.dataset.description;
            const image = btn.dataset.image;

            // Gán vào form
            document.getElementById('edit_category_id').value = id;
            document.getElementById('edit_category_name').value = name;
            document.getElementById('edit_category_slug').value = slug;
            document.getElementById('edit_category_description').value = description;

            // Ảnh hiện tại (nếu có)
            const currentImage = document.getElementById('current_category_image');
            if (image) {
                currentImage.src = `/storage/images/categories/${image}`;
                currentImage.style.display = 'block';
            } else {
                currentImage.style.display = 'none';
            }

            // Cập nhật action cho form cập nhật
            const editForm = document.getElementById('editCategoryForm');
            editForm.action = `/admin/categories/update/${id}`;
        }
    });

        // ========== Cập nhật danh mục ==========
        document.getElementById("editCategoryForm").addEventListener("submit", function (e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);
        const categoryId = document.getElementById("edit_category_id").value;

        fetch(`/admin/categories/update/${categoryId}`, {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) throw new Error("Lỗi khi gửi yêu cầu.");
            return response.json();
        })
        .then(data => {
            Swal.fire("Thành công", "Cập nhật danh mục thành công!", "success").then(() => {
                location.reload(); // Refresh lại bảng nếu muốn
            });
        })
        .catch(error => {
            console.error("Lỗi:", error);
            Swal.fire("Lỗi", "Không thể cập nhật danh mục.", "error");
        });
    });
    // ========== Tìm kiếm ==========
    
});
