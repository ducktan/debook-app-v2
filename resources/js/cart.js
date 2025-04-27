document.querySelectorAll('.quantity-update').forEach(button => {
    button.addEventListener('click', function() {
        let productId = this.getAttribute('data-id');
        let action = this.getAttribute('data-action');
        let quantityInput = document.getElementById('quantity-' + productId);
        let currentQuantity = parseInt(quantityInput.value);

        // Cập nhật số lượng dựa trên hành động
        if (action === 'increase') {
            currentQuantity++;
        } else if (action === 'decrease' && currentQuantity > 1) {
            currentQuantity--;
        }

        // Cập nhật lại giá trị của ô nhập số lượng
        quantityInput.value = currentQuantity;

        // Lấy giá của sản phẩm từ DOM (ở đây bạn đã có giá trong HTML)
        let productPrice = parseInt(document.querySelector('.product-price .text-success').textContent.replace('đ', '').replace(',', ''));
        

        // Tính lại tổng giá của sản phẩm
        let totalPrice = productPrice * currentQuantity;

        // Cập nhật lại tổng giá của sản phẩm trong giỏ hàng
        let itemTotal = document.querySelector('.item-total[data-id="' + productId + '"]');
        itemTotal.textContent = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(totalPrice);

        // // Gửi yêu cầu Ajax đến server để cập nhật giỏ hàng
        // fetch(`/cart/update/${productId}`, {
        //     method: 'POST',
        //     headers: {
        //         'Content-Type': 'application/json',
        //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //     },
        //     body: JSON.stringify({ quantity: currentQuantity })
        // })
        // .then(response => response.json())
        // .then(data => {
        //     if (data.success) {
        //         // Nếu bạn cần cập nhật tổng giỏ hàng, bạn có thể làm ở đây
        //         let totalPriceElement = document.querySelector('#total-price'); // Giả sử có phần tử hiển thị tổng giỏ hàng
        //         totalPriceElement.textContent = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(data.totalPrice);
        //     }
        // })
        // .catch(error => console.error('Error:', error));
    });
});
