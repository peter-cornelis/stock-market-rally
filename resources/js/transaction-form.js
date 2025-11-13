"use strict";

export default function initTransactionForm() {
    if(!document.getElementById("transaction-form")) return;

    document.getElementById("quantity").oninput = () => {
        const quantity = document.getElementById('quantity').value;
        const price = document.getElementById('price').value;
        const type = document.getElementById('type').value;
        const gross = Number((quantity * price).toFixed(2));
        let fee = Number((gross / 100 * 0.25).toFixed(2));
        fee > 2.5 && gross > 0 ? fee = fee : fee = 2.5;

        const total = type === "buy" ? gross + fee : gross - fee;
        document.getElementById('showGross').textContent = gross;
        document.getElementById('showFee').textContent = fee;
        document.getElementById('showTotal').textContent = total;
        document.getElementById('fee').textContent = fee;
        document.getElementById('total').textContent = total;
    }
}
