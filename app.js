document.addEventListener("DOMContentLoaded", function () {
    // Fetch raw materials and finished products data from the server
    fetchRawMaterials();
    fetchFinishedProducts();
});

function fetchRawMaterials() {
    fetch('server.php?action=get_raw_materials')
        .then(response => response.json())
        .then(data => {
            const rawMaterialTable = document.getElementById("rawMaterialTable").getElementsByTagName('tbody')[0];
            rawMaterialTable.innerHTML = '';

            data.forEach(item => {
                const row = rawMaterialTable.insertRow();
                row.innerHTML = `
                    <td>${item.raw_material_name}</td>
                    <td>${item.count}</td>
                    <td>
                        <button onclick="subtractRawMaterial(${item.id})">-</button>
                        <button onclick="addRawMaterial(${item.id})">+</button>
                    </td>
                `;
                rawMaterialTable.appendChild(row);
            });
        })
        .catch(error => console.error('Error:', error));
}

function fetchFinishedProducts() {
    fetch('server.php?action=get_finished_products')
        .then(response => response.json())
        .then(data => {
            const finishProductTable = document.getElementById("finishProductTable").getElementsByTagName('tbody')[0];
            finishProductTable.innerHTML = '';

            data.forEach(item => {
                const row = finishProductTable.insertRow();
                row.innerHTML = `
                    <td>${item.product_name}</td>
                    <td>${item.count}</td>
                    <td>
                        <button onclick="subtractFinishedProduct(${item.id})">-</button>
                        <button onclick="addFinishedProduct(${item.id})">+</button>
                    </td>
                `;
                finishProductTable.appendChild(row);
            });
        })
        .catch(error => console.error('Error:', error));
}

function subtractRawMaterial(id) {
    const count = parseInt(prompt("Enter the quantity to subtract:"));
    if (!isNaN(count) && count > 0) {
        fetch('server.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=subtract_raw_material&id=${id}&count=${count}`,
        })
        .then(response => response.text())
        .then(message => {
            alert(message);
            fetchRawMaterials();
        })
        .catch(error => console.error('Error:', error));
    }
}

function addRawMaterial(id) {
    const count = parseInt(prompt("Enter the quantity to add:"));
    if (!isNaN(count) && count > 0) {
        fetch('server.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=add_raw_material&id=${id}&count=${count}`,
        })
        .then(response => response.text())
        .then(message => {
            alert(message);
            fetchRawMaterials();
        })
        .catch(error => console.error('Error:', error));
    }
}

function subtractFinishedProduct(id) {
    const count = parseInt(prompt("Enter the quantity to subtract:"));
    if (!isNaN(count) && count > 0) {
        fetch('server.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=subtract_finished_product&id=${id}&count=${count}`,
        })
        .then(response => response.text())
        .then(message => {
            alert(message);
            fetchFinishedProducts();
            fetchRawMaterials(); // Refresh raw materials as finished products might use raw materials
        })
        .catch(error => console.error('Error:', error));
    }
}

function addFinishedProduct(id) {
    const count = parseInt(prompt("Enter the quantity to add:"));
    if (!isNaN(count) && count > 0) {
        fetch('server.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=add_finished_product&id=${id}&count=${count}`,
        })
        .then(response => response.text())
        .then(message => {
            alert(message);
            fetchFinishedProducts();
            fetchRawMaterials(); // Refresh raw materials as finished products might use raw materials
        })
        .catch(error => console.error('Error:', error));
    }
}