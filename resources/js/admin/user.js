document.addEventListener("DOMContentLoaded", function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // ========== Thêm người dùng ==========
    const addUserForm = document.getElementById("addUserForm");
    if (addUserForm) {
        addUserForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const formData = new FormData(addUserForm);

            fetch(addUserForm.getAttribute("action"), {
                method: "POST",
                headers: { "X-CSRF-TOKEN": csrfToken },
                body: formData,
            })
            .then(res => res.ok ? res.json() : Promise.reject(res))
            .then(data => {
                bootstrap.Modal.getInstance(document.getElementById('addUserModal')).hide();
                Swal.fire({ icon: 'success', title: 'Thành công', text: data.message || 'Đã thêm người dùng!', timer: 2000, showConfirmButton: false });
                addUserForm.reset();
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

    // ========== Tìm kiếm người dùng ==========
    const searchInput = document.getElementById('search-input');
    const tbody = document.getElementById('user-table-body');

    searchInput?.addEventListener('keyup', function () {
        fetch(`/admin/users/search?q=${encodeURIComponent(this.value)}`)
            .then(res => res.json())
            .then(users => renderUserRows(users))
            .catch(console.error);
    });

    function renderUserRows(users) {
        tbody.innerHTML = '';

        if (!users.length) {
            tbody.innerHTML = '<tr><td colspan="6">Không tìm thấy người dùng</td></tr>';
            return;
        }

        users.forEach(user => {
            const utypeMap = { 'ADM': 'Admin', 'USR': 'Khách', 'VIP': 'Khách VIP' };
            const avatar = user.avatar ? `/assets/img/avatars/${user.avatar}` : `/assets/img/default-avt.jpg`;
            const createdAt = new Date(user.created_at).toLocaleDateString('vi-VN');

            const row = `
                <tr>
                    <td>${user.id}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="user-avatar-wrapper">
                                <img src="${avatar}" class="rounded-circle me-2 hover-glow" data-bs-toggle="tooltip" title="${user.full_name}">
                                <span class="online-status-pulse bg-success"></span>
                            </div>
                            <div>
                                <p class="mb-0 fw-bold text-gradient">${user.full_name}</p>
                                <small class="text-muted">${user.email}</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-star-fill me-1"></i>${utypeMap[user.utype] ?? user.utype}
                        </span>
                    </td>
                    <td>${user.email}</td>
                    <td>${createdAt}</td>
                    <td>
                        <div class="d-flex action-buttons">
                            <button class="btn btn-primary btn-action btn-edit me-1 editUserBtn"
                                type="button"
                                data-id="${user.id}"
                                data-name="${user.name ?? ''}"
                                data-fullname="${user.full_name ?? ''}"
                                data-email="${user.email ?? ''}"
                                data-phone="${user.phone ?? ''}"
                                data-utype="${user.utype}"
                                data-bs-toggle="modal" data-bs-target="#edit">
                                <i class="fas fa-edit"></i>
                            </button>

                            <form class="delete-user-form" data-id="${user.id}">
                                <input type="hidden" name="_token" value="${csrfToken}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn-action btn-delete" data-bs-toggle="tooltip" title="Xoá">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            `;
            tbody.insertAdjacentHTML('beforeend', row);
        });

        bootstrap.Tooltip.getInstance(document.querySelector('[data-bs-toggle="tooltip"]')) || new bootstrap.Tooltip(document.querySelector('[data-bs-toggle="tooltip"]'));
    }

    // ========== Xoá người dùng (delegation) ==========
    document.addEventListener("submit", function (e) {
        if (e.target.matches(".delete-user-form")) {
            e.preventDefault();
            const form = e.target;
            const userId = form.dataset.id;

            Swal.fire({
                title: 'Xác nhận xoá?',
                text: "Thao tác này không thể hoàn tác!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Xoá',
                cancelButtonText: 'Hủy'
            }).then(result => {
                if (result.isConfirmed) {
                    fetch(`/admin/users/delete/${userId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.ok ? res.json() : Promise.reject())
                    .then(data => {
                        Swal.fire({ icon: 'success', title: 'Đã xoá', text: data.message, timer: 1500, showConfirmButton: false });
                        form.closest("tr").remove();
                    })
                    .catch(() => {
                        Swal.fire({ icon: 'error', title: 'Lỗi', text: 'Không thể xoá người dùng!' });
                    });
                }
            });
        }
    });

    // ========== Mở modal cập nhật người dùng ==========
    document.addEventListener("click", function (e) {
        const btn = e.target.closest(".editUserBtn");
        if (btn) {
            document.getElementById('edit_user_id').value = btn.dataset.id;
            document.getElementById('edit_name').value = btn.dataset.name;
            document.getElementById('edit_full_name').value = btn.dataset.fullname;
            document.getElementById('edit_email').value = btn.dataset.email;
            document.getElementById('edit_phone').value = btn.dataset.phone;
            document.getElementById('edit_utype').value = btn.dataset.utype;

            document.getElementById('editUserForm').action = `/admin/users/update/${btn.dataset.id}`;
        }
    });

   
});
