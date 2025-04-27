document.addEventListener('DOMContentLoaded', function () {
    const decreaseBtn = document.getElementById('decreaseQty');
    const increaseBtn = document.getElementById('increaseQty');
    const quantityInput = document.getElementById('quantityInput');

    decreaseBtn.addEventListener('click', function () {
        let currentQty = parseInt(quantityInput.value);
        if (currentQty > 1) {
            quantityInput.value = currentQty - 1;
        }
    });

    increaseBtn.addEventListener('click', function () {
        let currentQty = parseInt(quantityInput.value);
        quantityInput.value = currentQty + 1;
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('toggleSummary');
    const shortText = document.getElementById('summaryShort');
    const fullText = document.getElementById('summaryFull');

    toggleBtn.addEventListener('click', function () {
        if (fullText.classList.contains('d-none')) {
            shortText.classList.add('d-none');
            fullText.classList.remove('d-none');
            toggleBtn.innerHTML = 'Thu gọn <i class="fas fa-chevron-up"></i>';
        } else {
            fullText.classList.add('d-none');
            shortText.classList.remove('d-none');
            toggleBtn.innerHTML = 'Đọc thêm <i class="fas fa-chevron-down"></i>';
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const decreaseBtn = document.getElementById('decreaseQty');
    const increaseBtn = document.getElementById('increaseQty');
    const quantityInput = document.getElementById('quantityInput');
    const hiddenQuantity = document.getElementById('hiddenQuantity');

    decreaseBtn.addEventListener('click', function () {
        let currentQty = parseInt(quantityInput.value);
        if (currentQty > 1) {
            quantityInput.value = currentQty - 1;
            hiddenQuantity.value = quantityInput.value;
        }
    });

    increaseBtn.addEventListener('click', function () {
        let currentQty = parseInt(quantityInput.value);
        quantityInput.value = currentQty + 1;
        hiddenQuantity.value = quantityInput.value;
    });
});