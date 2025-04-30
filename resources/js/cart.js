
function total_Price() {
    let total = 0;
    
    // Lấy tất cả các giá trị tổng của từng sản phẩm
    document.querySelectorAll('.item-total').forEach(item => {
        // Lấy giá trị thô từ phần tử và loại bỏ ký tự "đ"
        const raw = item.innerText.replace('đ', '').trim();

        // Chuyển chuỗi thành số nguyên
        const value = parseInt(raw, 10);

        // Kiểm tra nếu giá trị hợp lệ và cộng vào tổng
        if (!isNaN(value)) {
            total += value; // Cộng dồn giá trị của tất cả sản phẩm
        }
    });

    return total;
}

function updateHiddenTotalPrice() {
    const displayPrice = document.getElementById('total__prices').textContent;
    document.querySelector('input[name="amount"]').value = displayPrice;
}

document.addEventListener('DOMContentLoaded', function () {
    const quantityButtons = document.querySelectorAll('.quantity-update');
    
    quantityButtons.forEach(button => {
        button.addEventListener('click', () => {
            const productId = button.dataset.id;
            const action = button.dataset.action;

            const input = document.getElementById(`quantity-${productId}`);
            const itemTotal = document.querySelector(`.item-total[data-id="${productId}"]`);
            const priceElement = document.querySelector(`.product-price[data-id="${productId}"]`);
            const price = parseInt(priceElement.dataset.price, 10);

            let currentValue = parseInt(input.value, 10);
            if (isNaN(currentValue)) currentValue = 1;

            if (action === 'increase') {
                currentValue++;
            } else if (action === 'decrease' && currentValue > 1) {
                currentValue--;
            }

            input.value = currentValue;

            const newTotal = price * currentValue;

            // Cập nhật giá tổng sản phẩm trên giao diện
            itemTotal.innerText = newTotal;

            // Gửi yêu cầu AJAX để cập nhật số lượng trên server
            fetch(`/cart/update/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ quantity: currentValue })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cập nhật lại tổng giá trị giỏ hàng từ phản hồi server
                    document.getElementById('total__prices').innerText = data.totalPrice.toLocaleString('vi-VN') + 'đ';
                } else {
                    alert('Đã có lỗi xảy ra. Vui lòng thử lại.');
                }
            })
            .catch(error => {
                console.error('Lỗi:', error);
                alert('Đã có lỗi xảy ra. Vui lòng thử lại.');
            });
        });
    });

    // Gọi hàm totalPrice khi trang vừa tải để hiển thị tổng tiền ban đầu
    let initialTotal = total_Price();

    // Hiển thị tổng tiền ban đầu
    document.getElementById('total__prices').innerText = initialTotal;
    updateHiddenTotalPrice()
});



