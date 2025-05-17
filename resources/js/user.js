document.addEventListener("DOMContentLoaded", function () {
    // ===== AJAX Thêm người dùng =====
    const form = document.getElementById("addUserForm");
    if (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            const formData = new FormData(form);

            fetch(form.getAttribute("action"), {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                },
                body: formData,
            })
            .then(res => {
                if (!res.ok) throw res;
                return res.json();
            })
            .then(data => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('addUserModal'));
                modal.hide();

                Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: data.message || 'Đã thêm người dùng!',
                    timer: 2000,
                    showConfirmButton: false
                });

                form.reset();
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

    // ===== AJAX Xoá người dùng =====
    document.querySelectorAll(".delete-user-form").forEach(form => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            const userId = form.getAttribute("data-id");

            Swal.fire({
                title: 'Xác nhận xoá?',
                text: "Thao tác này không thể hoàn tác!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Xoá',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`users/delete/${userId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                            'Accept': 'application/json',
                        }
                    })
                    .then(res => {
                        if (!res.ok) throw res;
                        return res.json();
                    })
                    .then(data => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Đã xoá',
                            text: data.message || 'Người dùng đã bị xoá!',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        form.closest("tr").remove();
                    })
                    .catch(() => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: 'Không thể xoá người dùng!'
                        });
                    });
                }
            });
        });
    });

    // Bắt sự kiện click nút edit
    document.querySelectorAll(".editUserBtn").forEach(btn => {
    btn.addEventListener("click", function () {
        const userId = this.dataset.id;
        document.getElementById('edit_user_id').value = userId;
        document.getElementById('edit_name').value = this.dataset.name;
        document.getElementById('edit_full_name').value = this.dataset.fullname;
        document.getElementById('edit_email').value = this.dataset.email;
        document.getElementById('edit_phone').value = this.dataset.phone;
        document.getElementById('edit_utype').value = this.dataset.utype;

     
        document.getElementById('editUserForm').action = `/admin/users/update/${userId}`;
    });
});


    // // Gửi form update bằng AJAX
    // document.getElementById('editUserForm').addEventListener('submit', function (e) {
    //     e.preventDefault();
    //     const id = document.getElementById('edit_user_id').value;
    //     const form = e.target;
    //     const formData = new FormData(form);

    //     fetch(`users/update/${id}`, {
    //         method: 'POST',
    //         headers: {
    //             'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
    //         },
    //         body: formData
    //     })
    //     .then(res => {
    //         if (!res.ok) throw res;
    //         return res.json();
    //     })
    //     .then(data => {
    //         bootstrap.Modal.getInstance(document.getElementById('editUserModal')).hide();
    //         Swal.fire({
    //             icon: 'success',
    //             title: 'Thành công',
    //             text: data.message,
    //             timer: 2000,
    //             showConfirmButton: false
    //         });
    //         setTimeout(() => location.reload(), 1500);
    //     })
    //     .catch(
    //         async err => {
    //         let msg = 'Lỗi cập nhật!';
    //         if (err.status === 422) {
    //             const res = await err.json();
    //             msg = Object.values(res.errors).flat().join('<br>');
    //         }
    //         Swal.fire({ icon: 'error', title: 'Lỗi', html: msg });

    //         console.log('Error:', err);
    //     });
    // });

  
});
