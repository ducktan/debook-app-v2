document.addEventListener('DOMContentLoaded', () => {
    const deleteButtons = document.querySelectorAll('.delete-comment-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', async (e) => {
            e.preventDefault();

            const commentId = button.dataset.id;
            const row = button.closest('tr');

            Swal.fire({
                title: 'Xác nhận xoá?',
                text: 'Bạn sẽ không thể khôi phục bình luận này!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Xoá',
                cancelButtonText: 'Huỷ',
                reverseButtons: true
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const res = await fetch(`/admin/comments/delete/${commentId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            }
                        });

                        const data = await res.json();

                        if (res.ok) {
                            Swal.fire('Đã xoá!', data.message, 'success');
                            row.remove(); // Xoá dòng khỏi bảng
                        } else {
                            throw new Error(data.message || 'Lỗi khi xoá');
                        }
                    } catch (err) {
                        Swal.fire('Lỗi!', err.message, 'error');
                    }
                }
            });
        });
    });
});