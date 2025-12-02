"use strict";

export default function initTransactionForm() {
    const form = document.getElementById('transaction-form');
    if (!form) return;

    document.getElementById("quantity").oninput = () => {
        const quantity = Number(document.getElementById('quantity').value);
        const price = Number(form.dataset.price);
        const type = document.getElementById('type').value;
        const gross = (quantity * price);
        const cash = Number(form.dataset.balance);
        
        let fee = quantity > 0 ? Math.max(2.5, Number((gross * 0.0025).toFixed(2))) : 0;
        const total = (type === "buy" ? gross + fee : gross - fee);
        const estimatedCash = (type === "buy" ? cash - total : cash + total);
        
        document.getElementById('gross').textContent = gross.toFixed(2);
        document.getElementById('fee').textContent = fee.toFixed(2);
        document.getElementById('total').textContent = total.toFixed(2);
        document.getElementById('cash').textContent = estimatedCash.toFixed(2);
    }
}
