document.addEventListener('DOMContentLoaded', function() {
    // Xử lý filter
    const filterInputs = document.querySelectorAll('.price-filter, .format-filter');
    filterInputs.forEach(input => {
        input.addEventListener('change', applyFilters);
    });
    
    // Xử lý sort
    document.getElementById('sort-select').addEventListener('change', function() {
        const url = new URL(window.location.href);
        url.searchParams.set('sort', this.value);
        window.location.href = url.toString();
    });
    
    function applyFilters() {
        const form = document.getElementById('filter-form');
        const formData = new FormData(form);
        const params = new URLSearchParams();
        
        // Thêm các filter vào URL
        for (const [key, value] of formData.entries()) {
            if (value) params.append(key, value);
        }
        
        // Giữ lại sort nếu có
        const currentSort = new URLSearchParams(window.location.search).get('sort');
        if (currentSort) params.set('sort', currentSort);
        
        window.location.href = `${window.location.pathname}?${params.toString()}`;
    }
});