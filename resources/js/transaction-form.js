"use strict";
const form = document.getElementById('transaction-form');

export default function initTransactionForm() {
    if (!form) return;

    if (Number(document.getElementById('quantity').value) > 0 && Number(document.getElementById('total').textContent) === 0) {
        const amounts = calculateAmounts();
        renderAmounts(amounts);
    }

    document.getElementById("quantity").oninput = () => {
        const amounts = calculateAmounts();
        renderAmounts(amounts);
    };
}

function calculateAmounts() {
    const type = document.getElementById('type').value;
    const quantity = Number(document.getElementById('quantity').value);
    const price = Number(form.dataset.price);
    const gross = (quantity * price);
    const cash = Number(form.dataset.balance);

    let fee = quantity > 0 ? Math.max(2.5, Number((gross * 0.0025).toFixed(2))) : 0;
    const total = (type === "buy" ? gross + fee : gross - fee);
    const estimatedCash = (type === "buy" ? cash - total : cash + total);

    return { gross, fee, total, estimatedCash };
}

function renderAmounts({ gross, fee, total, estimatedCash }) {
    document.getElementById('gross').textContent = gross.toFixed(2);
    document.getElementById('fee').textContent = fee.toFixed(2);
    document.getElementById('total').textContent = total.toFixed(2);
    document.getElementById('cash').textContent = estimatedCash.toFixed(2);
}
