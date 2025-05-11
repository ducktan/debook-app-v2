
document.addEventListener('DOMContentLoaded', function () {
    const searchBox = document.getElementById('search-box');
    const resultsBox = document.getElementById('search-results');
    const form = document.getElementById('myform');

    // Ngăn form submit nếu đang dùng live search
    form.addEventListener('submit', function (e) {
        if (searchBox.value.length >= 2) {
            e.preventDefault(); // Bỏ comment nếu bạn muốn live search thay vì redirect
        }
    });

    searchBox.addEventListener('input', function () {
        const query = this.value;

        if (query.length < 2) {
            resultsBox.style.display = 'none';
            resultsBox.innerHTML = '';
            return;
        }

        fetch(`/ajax-search?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                let html = '';

                if (data.length > 0) {
                    data.forEach(product => {
                        html += `
                            <a href="/products/${product.id}" class="d-block p-2 border-bottom text-decoration-none text-dark">
                                <div class="d-flex align-items-center">
                                    <img src="${product.image_url}" alt="${product.title}" width="40" height="40" class="me-2" style="object-fit: cover;">
                                    <span>${product.title}</span>
                                </div>
                            </a>
                        `;
                    });
                } else {
                    html = '<div class="p-2 text-muted">Không tìm thấy sản phẩm</div>';
                }

                resultsBox.innerHTML = html;
                resultsBox.style.display = 'block';
            });
    });

    // Ẩn popup khi click ra ngoài
    document.addEventListener('click', function (e) {
        if (!form.contains(e.target)) {
            resultsBox.style.display = 'none';
        }
    });
});

