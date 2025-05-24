import Chart from 'chart.js/auto';
import pdfMake from 'pdfmake/build/pdfmake';
import pdfFonts from 'pdfmake/build/vfs_fonts';

// Configurar las fuentes para pdfMake
pdfMake.vfs = pdfFonts.pdfMake.vfs;

document.addEventListener('DOMContentLoaded', function () {
    let cart = [];
    let sales = [];
    let purchases = [];

    // Gráficos de estadísticas
    const salesChart = new Chart(document.getElementById('salesChart'), {
        type: 'line',
        data: {
            labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May'],
            datasets: [{
                label: 'Ventas Mensuales ($)',
                data: [1200, 1500, 800, 2000, 1800],
                borderColor: '#dc3545',
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });

    const stockChart = new Chart(document.getElementById('stockChart'), {
        type: 'bar',
        data: {
            labels: ['Categoría 1', 'Categoría 2'],
            datasets: [{
                label: 'Stock',
                data: [50, 30],
                backgroundColor: '#dc3545'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });

    // Exportar estadísticas a Excel
    document.getElementById('exportStatsBtn').addEventListener('click', function () {
        const salesData = salesChart.data.datasets[0].data;
        const stockData = stockChart.data.datasets[0].data;
        const csv = [
            'Ventas Mensuales',
            'Mes,Ventas ($)',
            ...salesChart.data.labels.map((label, i) => `${label},${salesData[i]}`),
            '',
            'Stock por Categoría',
            'Categoría,Stock',
            ...stockChart.data.labels.map((label, i) => `${label},${stockData[i]}`)
        ].join('\n');

        const blob = new Blob([csv], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'estadisticas_smartket.csv';
        a.click();
        window.URL.revokeObjectURL(url);
    });

    // Actualizar widgets
    function updateWidgets() {
        document.getElementById('totalProducts').textContent = document.getElementById('productsTable').querySelectorAll('tbody tr').length;
        document.getElementById('todaySales').textContent = sales.filter(sale => new Date(sale.date).toDateString() === new Date().toDateString()).length;
        document.getElementById('lowStock').textContent = Array.from(document.getElementById('productsTable').querySelectorAll('tbody tr'))
            .filter(row => parseInt(row.cells[3].textContent) < 10).length;
    }

    // Agregar producto
    document.getElementById('productForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const productId = document.getElementById('productId').value;
        const name = document.getElementById('productName').value;
        const category = document.getElementById('productCategory').value;
        const stock = parseInt(document.getElementById('productStock').value);
        const price = parseFloat(document.getElementById('productPrice').value);

        const table = document.getElementById('productsTable').querySelector('tbody');
        const salesTable = document.getElementById('salesTable').querySelector('tbody');
        if (productId) {
            // Editar producto
            const row = document.querySelector(`#productsTable tr[data-id="${productId}"]`);
            const saleRow = document.querySelector(`#salesTable tr[data-id="${productId}"]`);
            row.cells[1].textContent = name;
            row.cells[2].textContent = category;
            row.cells[3].textContent = stock;
            row.cells[4].textContent = `$${price.toFixed(2)}`;
            saleRow.cells[1].textContent = name;
            saleRow.cells[2].textContent = `$${price.toFixed(2)}`;
            saleRow.cells[3].textContent = stock;
        } else {
            // Agregar producto
            const newId = table.rows.length + 1;
            const row = table.insertRow();
            row.setAttribute('data-id', newId);
            row.innerHTML = `
                <td>${newId}</td>
                <td>${name}</td>
                <td>${category}</td>
                <td>${stock}</td>
                <td>$${price.toFixed(2)}</td>
                <td>
                    <button class="btn btn-sm btn-warning me-1 edit-product" data-id="${newId}"><i class="fas fa-edit"></i> Editar</button>
                    <button class="btn btn-sm btn-danger delete-product" data-id="${newId}"><i class="fas fa-trash"></i> Eliminar</button>
                </td>
            `;
            const saleRow = salesTable.insertRow();
            saleRow.setAttribute('data-id', newId);
            saleRow.innerHTML = `
                <td>${newId}</td>
                <td>${name}</td>
                <td>$${price.toFixed(2)}</td>
                <td>${stock}</td>
                <td><input type="number" class="form-control form-control-sm sale-quantity" style="width: 80px;" value="1" min="1" data-id="${newId}"></td>
                <td><button class="btn btn-sm btn-primary add-to-cart" data-id="${newId}"><i class="fas fa-cart-plus"></i> Agregar al Carrito</button></td>
            `;
            // Actualizar gráfico de stock
            stockChart.data.labels.push(category);
            stockChart.data.datasets[0].data.push(stock);
            stockChart.update();
        }

        updateWidgets();
        bootstrap.Modal.getInstance(document.getElementById('addProductModal')).hide();
        document.getElementById('productForm').reset();
        document.getElementById('addProductModalLabel').textContent = 'Agregar Producto';
        document.getElementById('productId').value = '';
    });

    // Editar/Eliminar producto
    document.getElementById('productsTable').addEventListener('click', function (e) {
        if (e.target.closest('.edit-product')) {
            const button = e.target.closest('.edit-product');
            const id = button.getAttribute('data-id');
            const row = document.querySelector(`#productsTable tr[data-id="${id}"]`);
            document.getElementById('productId').value = id;
            document.getElementById('productName').value = row.cells[1].textContent;
            document.getElementById('productCategory').value = row.cells[2].textContent;
            document.getElementById('productStock').value = row.cells[3].textContent;
            document.getElementById('productPrice').value = parseFloat(row.cells[4].textContent.replace('$', ''));
            document.getElementById('addProductModalLabel').textContent = 'Editar Producto';
            new bootstrap.Modal(document.getElementById('addProductModal')).show();
        }

        if (e.target.closest('.delete-product')) {
            const button = e.target.closest('.delete-product');
            const id = button.getAttribute('data-id');
            const category = document.querySelector(`#productsTable tr[data-id="${id}"]`).cells[2].textContent;
            document.querySelector(`#productsTable tr[data-id="${id}"]`).remove();
            document.querySelector(`#salesTable tr[data-id="${id}"]`).remove();
            const index = stockChart.data.labels.indexOf(category);
            if (index !== -1) {
                stockChart.data.labels.splice(index, 1);
                stockChart.data.datasets[0].data.splice(index, 1);
                stockChart.update();
            }
            updateWidgets();
        }
    });

    // Registrar compra
    document.getElementById('purchaseForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const productId = document.getElementById('purchaseProduct').value;
        const supplier = document.getElementById('purchaseSupplier').value;
        const quantity = parseInt(document.getElementById('purchaseQuantity').value);
        const price = parseFloat(document.getElementById('purchasePrice').value);
        const date = new Date().toLocaleDateString();

        const productRow = document.querySelector(`#productsTable tr[data-id="${productId}"]`);
        const productName = productRow.cells[1].textContent;
        const newStock = parseInt(productRow.cells[3].textContent) + quantity;
        productRow.cells[3].textContent = newStock;
        document.querySelector(`#salesTable tr[data-id="${productId}"]`).cells[3].textContent = newStock;

        const table = document.getElementById('purchasesTable').querySelector('tbody');
        const newId = table.rows.length + 1;
        const row = table.insertRow();
        row.setAttribute('data-id', newId);
        row.innerHTML = `
            <td>${newId}</td>
            <td>${productName}</td>
            <td>${supplier}</td>
            <td>${quantity}</td>
            <td>$${price.toFixed(2)}</td>
            <td>$${(price * quantity).toFixed(2)}</td>
            <td>${date}</td>
        `;
        purchases.push({ id: newId, product: productName, supplier, quantity, price, total: price * quantity, date });

        const category = productRow.cells[2].textContent;
        const index = stockChart.data.labels.indexOf(category);
        stockChart.data.datasets[0].data[index] = newStock;
        stockChart.update();
        updateWidgets();

        bootstrap.Modal.getInstance(document.getElementById('addPurchaseModal')).hide();
        document.getElementById('purchaseForm').reset();
    });

    // Agregar al carrito
    document.getElementById('salesTable').addEventListener('click', function (e) {
        if (e.target.closest('.add-to-cart')) {
            const button = e.target.closest('.add-to-cart');
            const id = button.getAttribute('data-id');
            const row = document.querySelector(`#salesTable tr[data-id="${id}"]`);
            const quantity = parseInt(row.querySelector('.sale-quantity').value);
            const stock = parseInt(row.cells[3].textContent);

            if (quantity > stock) {
                alert('Cantidad excede el stock disponible');
                return;
            }

            const product = {
                id: id,
                name: row.cells[1].textContent,
                price: parseFloat(row.cells[2].textContent.replace('$', '')),
                quantity: quantity,
                stock: stock
            };

            cart.push(product);
            updateCart();
            document.getElementById('cartSection').style.display = 'block';
        }
    });

    // Nueva venta
    document.getElementById('newSaleBtn').addEventListener('click', function () {
        cart = [];
        updateCart();
        document.getElementById('cartSection').style.display = 'none';
    });

    // Confirmar venta
    document.getElementById('confirmSaleBtn').addEventListener('click', function () {
        const date = new Date().toLocaleDateString();
        const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const saleId = sales.length + 1;

        cart.forEach(item => {
            const userRow = document.querySelector(`#salesTable tr[data-id="${item.id}"]`);
            const adminRow = document.querySelector(`#productsTable tr[data-id="${item.id}"]`);
            const newStock = item.stock - item.quantity;
            userRow.cells[3].textContent = newStock;
            adminRow.cells[3].textContent = newStock;

            const category = adminRow.cells[2].textContent;
            const index = stockChart.data.labels.indexOf(category);
            stockChart.data.datasets[0].data[index] = newStock;
            stockChart.update();
        });

        // Añadir a facturación
        const billingTable = document.getElementById('billingTable').querySelector('tbody');
        const row = billingTable.insertRow();
        row.setAttribute('data-id', saleId);
        row.innerHTML = `
            <td>${saleId}</td>
            <td>Cliente Genérico</td>
            <td>${date}</td>
            <td>$${total.toFixed(2)}</td>
            <td>
                <button class="btn btn-sm btn-primary generate-bill" data-id="${saleId}"><i class="fas fa-file-pdf"></i> Generar Boleta</button>
            </td>
        `;

        sales.push({ id: saleId, client: 'Cliente Genérico', date, total, items: [...cart] });
        salesChart.data.datasets[0].data[salesChart.data.datasets[0].data.length - 1] += total;
        salesChart.update();
        updateWidgets();

        cart = [];
        updateCart();
        document.getElementById('cartSection').style.display = 'none';
        alert('Venta confirmada');
    });

    // Generar boleta
    document.getElementById('billingTable').addEventListener('click', function (e) {
        if (e.target.closest('.generate-bill')) {
            const id = e.target.closest('.generate-bill').getAttribute('data-id');
            const sale = sales.find(s => s.id == id);
            const docDefinition = {
                content: [
                    {
                        image: 'data:image',
                        width: 50,
                        alignment: 'center',
                        margin: [0, 0, 0, 10]
                    },
                    { text: 'Boleta de Venta', style: 'header' },
                    { text: `ID: ${sale.id}`, margin: [0, 10] },
                    { text: `Cliente: ${sale.client}` },
                    { text: `Fecha: ${sale.date}` },
                    { text: 'Productos:', style: 'subheader', margin: [0, 10] },
                    {
                        table: {
                            headerRows: 1,
                            widths: ['*', 'auto', 'auto', 'auto'],
                            body: [
                                ['Producto', 'Cantidad', 'Precio Unitario', 'Total'],
                                ...sale.items.map(item => [item.name, item.quantity, `$${item.price.toFixed(2)}`, `$${(item.price * item.quantity).toFixed(2)}`])
                            ]
                        }
                    },
                    { text: `Total: $${sale.total.toFixed(2)}`, style: 'subheader', margin: [0, 10] }
                ],
                styles: {
                    header: { fontSize: 18, bold: true, alignment: 'center' },
                    subheader: { fontSize: 14, bold: true }
                }
            };

            // Generar y descargar PDF
            pdfMake.createPdf(docDefinition).download(`boleta_${sale.id}.pdf`);
        }
    });

    // Actualizar carrito
    function updateCart() {
        const cartTable = document.getElementById('cartTable').querySelector('tbody');
        cartTable.innerHTML = '';
        cart.forEach((item, index) => {
            const row = cartTable.insertRow();
            row.innerHTML = `
                <td>${item.name}</td>
                <td>${item.quantity}</td>
                <td>$${item.price.toFixed(2)}</td>
                <td>$${(item.price * item.quantity).toFixed(2)}</td>
                <td><button class="btn btn-sm btn-danger remove-from-cart" data-index="${index}"><i class="fas fa-trash"></i> Eliminar</button></td>
            `;
        });
    }

    // Eliminar del carrito
    document.getElementById('cartTable').addEventListener('click', function (e) {
        if (e.target.closest('.remove-from-cart')) {
            const index = e.target.closest('.remove-from-cart').getAttribute('data-index');
            cart.splice(index, 1);
            updateCart();
            if (cart.length === 0) {
                document.getElementById('cartSection').style.display = 'none';
            }
        }
    });

    updateWidgets();

    // Establecer enlace activo para el dashboard
    const dashboardUrl = "{{ route('dashboard') }}";
    const dashboardLink = document.querySelector(`.main-nav-link[href="${dashboardUrl}"]`);
    if (dashboardLink) {
        dashboardLink.classList.add('active');
    }
});