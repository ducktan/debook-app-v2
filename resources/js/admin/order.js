
    var orderDetailModal = document.getElementById('orderDetailModal');
    orderDetailModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var orderId = button.getAttribute('data-id');
        var modalBody = orderDetailModal.querySelector('#orderDetailContent');
        modalBody.innerHTML = '<p>Đang tải...</p>';

        fetch(`/admin/orders/${orderId}`)
            .then(response => response.text())
            .then(html => {
                modalBody.innerHTML = html;
            })
            .catch(() => {
                modalBody.innerHTML = '<p class="text-danger">Lỗi tải dữ liệu</p>';
            });
    });


    // Xoá đơn hàng
    document.querySelectorAll('form.delete-order-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa đơn hàng này?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (!result.isConfirmed) return;

            const orderId = this.getAttribute('data-id');
            const token = this.querySelector('input[name="_token"]').value;
            const method = this.querySelector('input[name="_method"]').value;

            fetch(`/admin/orders/delete/${orderId}`, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                }
            })
            .then(res => {
                if (!res.ok) throw new Error('Lỗi khi xóa đơn hàng');
                return res.json();
            })
            .then(data => {
                Swal.fire({
                    icon: 'success',
                    title: 'Đã xóa',
                    text: data.message,
                    timer: 1500,
                    showConfirmButton: false
                });
                setTimeout(() => location.reload(), 1600);
            })
            .catch(() => {
                Swal.fire({
                    icon: 'error',
                    title: 'Thất bại',
                    text: 'Xóa đơn hàng thất bại'
                });
            });
        });
    });
});

// Chuyển trang thái đơn hàng
document.querySelectorAll('.complete-order-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Xác nhận đơn hàng?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Xác nhận',
            cancelButtonText: 'Hủy',
        }).then((result) => {
            if (!result.isConfirmed) return;

            // Lấy URL action của form
            const url = form.action;

            // Tạo FormData để gửi token và method
            const formData = new FormData(form);

            fetch(url, {
                method: 'POST',  // Gửi POST, Laravel hiểu method PATCH qua _method trong formData
                headers: {
                    'Accept': 'application/json',
                },
                body: formData,
            })
            .then(res => {
                if (!res.ok) throw new Error('Lỗi khi cập nhật trạng thái');
                return res.json();
            })
            .then(data => {
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: data.message,
                    timer: 1500,
                    showConfirmButton: false
                });
                setTimeout(() => location.reload(), 1600);
            })
            .catch(() => {
                Swal.fire({
                    icon: 'error',
                    title: 'Thất bại',
                    text: 'Cập nhật trạng thái thất bại'
                });
            });
        });
    });
});
