document.addEventListener('DOMContentLoaded', function () {
    const paySelect = document.getElementById('pay-select');
    const summaryPay = document.getElementById('summary-pay');

    paySelect.addEventListener('change', function () {
        if (this.value === 'pay') {
            summaryPay.textContent = 'コンビニ払い';
        } else if (this.value === 'credit') {
            summaryPay.textContent = 'カード支払い';
        }
    });
});

