
// Hàm cập nhật số lượng
const updateQuantity = (inputId, isIncrease) => {
    const input = document.getElementById(inputId);
    let value = parseInt(input.value, 10) || 1;

    input.value = isIncrease ? value + 1 : Math.max(1, value - 1);
};

// Gán sự kiện click
document.getElementById('increaseQty')?.addEventListener('click', () => updateQuantity('quantityInput', true));
document.getElementById('decreaseQty')?.addEventListener('click', () => updateQuantity('quantityInput', false));

// Đồng bộ số lượng trước khi submit
document.querySelector('form')?.addEventListener('submit', () => {
    document.getElementById('quantityInputHidden').value = document.getElementById('quantityInput').value;
});

// AJAX thêm sản phẩm vào giỏ hàng
    $(document).ready(function () {
        $('#add-to-cart-form').on('submit', function (e) {
            e.preventDefault();

            let form = $(this);
            let url = form.attr('action');
            let data = form.serialize();

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        });

                        // Cập nhật badge giỏ hàng
                        updateCartCount(response.cart_count);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: 'Không thể thêm vào giỏ hàng.'
                        });
                    }
                },
                error: function () {
                    alert("Lỗi khi gửi yêu cầu!");
                }
            });
        });

        function updateCartCount(count) {
            let badge = $('.move__it');

            if (count > 0) {
                if (badge.length) {
                    badge.text(count);
                } else {
                    $('.fa-shopping-cart').after(`
                        <span class="position-absolute top-0 start-100 move__it badge rounded-pill bg-danger">
                            ${count}
                        </span>
                    `);
                }
            } else {
                badge.remove();
            }
        }
    });



 const toggleBtn = document.getElementById("toggleSummary");
    const shortText = document.getElementById("summaryShort");
    const fullText = document.getElementById("summaryFull");

    if (toggleBtn && shortText && fullText) {
        toggleBtn.addEventListener("click", function () {
            const isExpanded = !fullText.classList.contains("d-none");

            if (isExpanded) {
                fullText.classList.add("d-none");
                shortText.classList.remove("d-none");
                toggleBtn.innerHTML = 'Đọc thêm <i class="fas fa-chevron-down"></i>';
            } else {
                fullText.classList.remove("d-none");
                shortText.classList.add("d-none");
                toggleBtn.innerHTML = 'Thu gọn <i class="fas fa-chevron-up"></i>';
            }
        });
    }