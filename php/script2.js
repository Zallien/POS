


/////////////////////// Product List
//load for product
function loadProd() {
    // var xhr = new XMLHttpRequest();
    // xhr.onreadystatechange = function() {
    //     if (xhr.readyState === 4 && xhr.status === 200) {
    //         document.getElementById('suppBody').innerHTML = xhr.responseText;
    //     }
    // };
    // xhr.open('GET', 'func/loadProd.php', true);
    // xhr.send();
    fetch('func/productssearch.php?query=')
        .then(response => response.json())
        .then(data => {
            let productBody = document.getElementById('suppBody');
            productBody.innerHTML = ''; 

            if (data.length > 0) {
                data.forEach(product => {
                    let row = document.createElement('tr');
                    row.innerHTML = `
                        <td style='width:10%;'>${product.name}</td>
                        <td style='width:10%;'>${product.pcode}</td>
                        <td style='width:10%;'>₱${product.price}</td>
                    `;
                    productBody.appendChild(row);
                });
            } else {
                productBody.innerHTML = '<tr><td colspan="3">No results found.</td></tr>'
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
//update and add
document.getElementById('addproductbtn').addEventListener('click', function(event) {
    event.preventDefault();
    var idproduct = document.getElementById('idproduct').value;
    var nameproduct = document.getElementById('nameproduct').value;
    var productcode = document.getElementById('productcode').value;
    var productprice = document.getElementById('productprice').value;


    var xhr = new XMLHttpRequest();
    
    var url = idproduct ? 'func/updateProd.php' : 'func/insertProd.php';
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('idproduct=' + encodeURIComponent(idproduct) +'&nameproduct=' + encodeURIComponent(nameproduct) + '&productcode=' + encodeURIComponent(productcode) + '&productprice=' + encodeURIComponent(productprice));
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            loadProd();
            document.getElementById('idproduct').value = '';
            document.getElementById('nameproduct').value = '';
            document.getElementById('productcode').value = '';
            document.getElementById('productprice').value = '';
            document.getElementById("productmodule").style.display = "none";
            alert("Successfully Updated!");
        }
    };
});
// //edit
// function editProd(idproduct) {
//     var xhr = new XMLHttpRequest();
//     xhr.onreadystatechange = function() {
//         if (xhr.readyState === 4 && xhr.status === 200) {
//             var user = JSON.parse(xhr.responseText);
//             document.getElementById('idproduct').value = user.id;
//             document.getElementById('nameproduct').value = user.name;
//             document.getElementById('productcode').value = user.pcode;
//             document.getElementById('productprice').value = user.price;
//             document.getElementById("productmodule").style.display = "flex";
//         }
//     };
//     xhr.open('GET', 'func/fetchProd.php?idproduct=' + idproduct, true);
//     xhr.send();
// }
// //del
// function deleteProd(idproduct) {
//     if (confirm('Are you sure you want to Remove this Product?')) {
//         var xhr = new XMLHttpRequest();
//         xhr.onreadystatechange = function() {
//             if (xhr.readyState === 4 && xhr.status === 200) {
//                 loadProd();
//             }
//         };
//         xhr.open('GET', 'func/delProd.php?idproduct=' + idproduct, true);
//         xhr.send();
//     }
// }
//search
    document.getElementById('productssearchsing').addEventListener('click', function() {
    let searchQuery = document.getElementById('productssearchs').value;
    fetch('func/productssearch?query=' + encodeURIComponent(searchQuery))
        .then(response => response.json())
        .then(data => {
            let productBody = document.getElementById('suppBody');
            productBody.innerHTML = ''; 

            if (data.length > 0) {
                data.forEach(product => {
                    let row = document.createElement('tr');
                    row.innerHTML = `
                        <td style='width:10%;'>${product.name}</td>
                        <td style='width:10%;'>${product.pcode}</td>
                        <td style='width:10%;'>₱${product.price}</td>
                    `;
                    productBody.appendChild(row);
                });
            } else {
                productBody.innerHTML = '<tr><td colspan="3">No results found.</td></tr>'
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});
document.getElementById('productssearchs').addEventListener('change', function() {
    let searchQuery = document.getElementById('productssearchs').value;
    fetch('func/productssearch.php?query=' + encodeURIComponent(searchQuery))
        .then(response => response.json())
        .then(data => {
            let productBody = document.getElementById('suppBody');
            productBody.innerHTML = ''; 

            if (data.length > 0) {
                data.forEach(product => {
                    let row = document.createElement('tr');
                    row.innerHTML = `
                        <td style='width:10%;'>${product.name}</td>
                        <td style='width:10%;'>${product.pcode}</td>
                        <td style='width:10%;'>₱${product.price}</td>
                    `;
                    productBody.appendChild(row);
                });
            } else {
                productBody.innerHTML = '<tr><td colspan="3">No results found.</td></tr>'
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});
window.onload = loadProd();



/////////////////////// order sales
//load for orders
function loadprods() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('tableorder').innerHTML = xhr.responseText;
        }
    };
    xhr.open('GET', 'func/loadorder1.php', true);
    xhr.send();
}
document.getElementById("paybtn").addEventListener('click', function(event) {
    event.preventDefault();
    calculateChange();
    if(4===4){
        if( document.getElementById('change').value<0){
            alert("Please Enter the right amount")
        }else{

            saveTransactionToDatabase();
            loadAll();
        }
    }else{
        alert("Please Enter The right Amount")
    }
});
function saveTransactionToDatabase() {
    const tableChoosen = document.getElementById("tablechoosen");
    const total = parseFloat(document.getElementById("totaltxt").value);
    const payment = parseFloat(document.getElementById("paymenttxt").value);
    const change = parseFloat(document.getElementById("change").value);
    const date = new Date().toISOString().slice(0, 19).replace('T', ' ');
    fetch('func/ordergetout.php?action=getRowCount')
        .then(response => response.json())
        .then(rowCountData => {
            if (rowCountData.success) {
                const rowCount = parseInt(rowCountData.rowCount);
                const transactionNo = document.getElementById("nums").value + date;
                const transactionData = [];

                for (let i = 0; i < tableChoosen.rows.length; i++) {
                    const row = tableChoosen.rows[i];
                    const pname = row.cells[0].textContent;
                    const price = parseFloat(row.cells[1].textContent);
                    const quantity = parseInt(row.cells[2].querySelector('input').value);
                    const itemTotal = parseFloat(row.cells[3].textContent);

                    transactionData.push({
                        transaction_no: transactionNo,
                        pname: pname,
                        price: price,
                        quantity: quantity,
                        total: itemTotal,
                        payment: payment,
                        change: change,
                        Date: date,
                    });
                }
                fetch('func/ordergetout.php?action=saveTransaction', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(transactionData),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                    } else {
                        alert('Error saving transaction: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while saving the transaction.');
                });

                const receiptURL = `../receipt.php?transaction_no=${encodeURIComponent(transactionNo)}`;
                window.open(receiptURL, '_blank');
                clearCart();
                loadAll();
            } else {
                alert('Error getting row count: ' + rowCountData.message);
            }
}).catch(error => {
    console.error('Error:', error);
    alert('An error occurred while getting the row count.');
});

}
//still not working
function clearCart() {
    const totalInput = document.getElementById("totaltxt");
const paymentInput = document.getElementById("paymenttxt");
const changeInput = document.getElementById("change");
document.getElementById('tablechoosen').innerHTML ="";
totalInput.value = "";
paymentInput.value = "";
changeInput.value = "";
}
//search
document.getElementById('searchorderbtn').addEventListener('click', function() {
    let searchQuery = document.getElementById('searchorder').value;
    fetch('func/ordersearch?query=' + encodeURIComponent(searchQuery))
        .then(response => response.json())
        .then(data => {
            let productBody = document.getElementById('tableorder');
            productBody.innerHTML = ''; 
            if (data.length > 0) {
                data.forEach(product => {
                    let row = document.createElement('tr');
                    row.innerHTML = `
                        <td style='width:10%;'>${product.name}</td>
                        <td style='width:10%;'>${product.pcode}</td>
                        <td style='width:10%;'>₱${product.price}</td>
                        <td style='width:5%;text-align:center;'><button style='width:2dvw; height: 5dvh;'  onclick='addProductToCart(this)'>≫</button></td>
                    `;
                    productBody.appendChild(row);
                });
            } else {
                productBody.innerHTML = '<tr><td colspan="4">No results found.</td></tr>'
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});
document.getElementById('searchorder').addEventListener('change', function() {
    let searchQuery = document.getElementById('searchorder').value;
    fetch('func/ordersearch.php?query=' + encodeURIComponent(searchQuery))
        .then(response => response.json())
        .then(data => {
            let productBody = document.getElementById('tableorder');
            productBody.innerHTML = ''; 

            if (data.length > 0) {
                data.forEach(product => {
                    let row = document.createElement('tr');
                    row.innerHTML = `
                        <td style='width:10%;'>${product.name}</td>
                        <td style='width:10%;'>${product.pcode}</td>
                        <td style='width:10%;'>₱${product.price}</td>
                        <td style='width:5%;text-align:center;'><button style='width:2dvw; height: 5dvh;'  onclick='addProductToCart(this)'>≫</button></td>
                    `;
                    productBody.appendChild(row);
                });
            } else {
                productBody.innerHTML = '<tr><td colspan="4">No results found.</td></tr>'
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});
window.onload = loadprods();



/////////////////////////////////// dash

function loadtop(){
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('top').innerHTML = xhr.responseText;
        }
    };
    xhr.open('GET', 'func/loadtop.php', true);
    xhr.send();
}
function loadbot(){
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('least').innerHTML = xhr.responseText;
        }
    };
    xhr.open('GET', 'func/loadleast.php', true);
    xhr.send();
}
//////sales and expenses
function fetchSalesAndExpenses() {
    fetch('func/dashing.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Error fetching data:', data.error);
            } else {
                document.getElementById('weekly-sales').textContent = formatCurrency(data.weekly_sales);
                document.getElementById('monthly-sales').textContent = formatCurrency(data.monthly_sales);
                document.getElementById('yearly-sales').textContent = formatCurrency(data.yearly_sales);
                document.getElementById('monthly-expenses').textContent = formatCurrency(data.monthly_expenses);
                // document.getElementById('weekly-difference').textContent = formatCurrency(data.weekly_difference);
                // document.getElementById('monthly-difference').textContent = formatCurrency(data.monthly_difference);
                // document.getElementById('yearly-difference').textContent = formatCurrency(data.yearly_difference);
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
        });
}

function formatCurrency(number) {
    return new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP' }).format(number);
}



function loadAll(){
    loadbot();
    loadtop();
    numing();
    loadprods();
    loadProd();
    stating();
    charting();
    fetchSalesAndExpenses();
}
window.onload= loadAll();




document.getElementById("dash").addEventListener("click",function(event){
    event.preventDefault();
    loadAll();
    
})
document.getElementById("order").addEventListener("click",function(event){
    event.preventDefault();
    loadAll();
})

document.getElementById("supplier").addEventListener("click",function(event){
    event.preventDefault();
    loadAll();
    
})


function charting(){
    const ctx = document.getElementById('salesChart').getContext('2d');

    fetch('func/chart.php')
        .then(response => response.json())
        .then(salesData => {
            const labels = salesData.map(row => row.sale_date);
            const data = salesData.map(row => row.daily_sales);
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Daily Sales (PHP)',
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value, index, values) {
                                    return '₱' + value;
                                }
                            }
                        }
                    }
                }
            });
            console.log(labels)
        })
        .catch(error => {
            console.error('Error fetching sales data:', error);
        });
}


function numing() {
    const today = new Date().toISOString().slice(0, 10)
    fetch('func/ord.php')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const rowCount = data.count;
            console.log('Number of rows in transactions table:', rowCount);
            document.getElementById('nums').value = rowCount + 1, today;
            coolling= rowCount + 1, today;
        } else {
            console.error('Error fetching row count:', data.message);
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
    });
}

function stating(){
    var a= 1;
    var xhr = new XMLHttpRequest();
    var url = 'func/updatestatus.php';
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('a=' + encodeURIComponent(a));
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
        }
    };
}
