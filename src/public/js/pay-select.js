document.addEventListener('DOMContentLoaded', () => {
const select = document.getElementById('pay-select');
const summaryPay = document.getElementById('summary-pay');
if (!select || !summaryPay) return;

const payLabel = {
konbini: 'コンビニ払い',
card: 'カード支払い',
};

const render = () => {
summaryPay.textContent = payLabel[select.value] ?? '未選択';
};

render();
select.addEventListener('change', render);
select.addEventListener('input', render);
});