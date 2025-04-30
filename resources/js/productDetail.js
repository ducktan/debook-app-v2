
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
