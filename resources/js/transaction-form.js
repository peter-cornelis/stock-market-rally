"use strict";

export default function initTransactionForm() {
    const form = document.getElementById('transaction-form');
    if (!form) return;

    document.getElementById("quantity").oninput = () => {
        const quantity = document.getElementById('quantity').value;
        const price = Number(form.dataset.price);
        const type = document.getElementById('type').value;
        const gross = Number((quantity * price).toFixed(2));
        
        let fee = Number((gross / 100 * 0.25).toFixed(2));
        fee > 2.5 && gross > 0 ? fee = fee : fee = 2.5;
        const total = type === "buy" ? gross + fee : gross - fee;
        
        document.getElementById('gross').textContent = gross;
        document.getElementById('fee').textContent = fee;
        document.getElementById('total').textContent = total;
    }
}
