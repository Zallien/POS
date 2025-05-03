var coolling="";
var numero="entry";

document.getElementById("button1").addEventListener("click",function(event){
    document.getElementById("record-one").style.display="flex"
    document.getElementById("record-two").style.display="none"
    document.getElementById("record-three").style.display="none"
    document.getElementById("record-four").style.display="none"
    loadAll()
    document.getElementById("button1").style.backgroundColor = "#EE6A43";
    document.getElementById("button2").style.backgroundColor = "white";
    document.getElementById("button3").style.backgroundColor = "white";
    document.getElementById("button4").style.backgroundColor = "white";
    numero="entry";
    document.getElementById("button1").style.color = "white";
    document.getElementById("button2").style.color = "black";
    document.getElementById("button3").style.color = "black";
    document.getElementById("button4").style.color = "black";

    //r1

})
document.getElementById("button2").addEventListener("click",function(event){
    document.getElementById("record-one").style.display="none"
    document.getElementById("record-two").style.display="none"
    document.getElementById("record-three").style.display="flex"
    document.getElementById("record-four").style.display="none"
    loadAll()
    document.getElementById("button1").style.backgroundColor = "white";
    document.getElementById("button2").style.backgroundColor = "#EE6A43";
    document.getElementById("button3").style.backgroundColor = "white";
    document.getElementById("button4").style.backgroundColor = "white";
    numero="invent";
    document.getElementById("button1").style.color = "black";
    document.getElementById("button2").style.color = "white";
    document.getElementById("button3").style.color = "black";
    document.getElementById("button4").style.color = "black";
})
document.getElementById("button3").addEventListener("click",function(event){
    document.getElementById("record-one").style.display="none"
    document.getElementById("record-two").style.display="none"
    document.getElementById("record-three").style.display="none"
    document.getElementById("record-four").style.display="flex"
    loadAll()
    document.getElementById("button1").style.backgroundColor = "white";
    document.getElementById("button2").style.backgroundColor = "white";
    document.getElementById("button3").style.backgroundColor = "#EE6A43";
    document.getElementById("button4").style.backgroundColor = "white";
    numero="sales";
    document.getElementById("button1").style.color = "black";
    document.getElementById("button2").style.color = "black";
    document.getElementById("button3").style.color = "white";
    document.getElementById("button4").style.color = "black";
})
document.getElementById("button4").addEventListener("click",function(event){
    document.getElementById("record-one").style.display="none"
    document.getElementById("record-two").style.display="flex"
    document.getElementById("record-three").style.display="none"
    document.getElementById("record-four").style.display="none"
    loadAll()
    document.getElementById("button1").style.backgroundColor = "white";
    document.getElementById("button2").style.backgroundColor = "white";
    document.getElementById("button3").style.backgroundColor = "white";
    document.getElementById("button4").style.backgroundColor = "#EE6A43";
    numero="adjust";
    document.getElementById("button1").style.color = "black";
    document.getElementById("button2").style.color = "black";
    document.getElementById("button3").style.color = "black";
    document.getElementById("button4").style.color = "white";
})
/////////////////////// USERS
//load for users
function loadAccount() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('actBody').innerHTML = xhr.responseText;
        }
    };
    xhr.open('GET', 'func/loadAccount.php', true);
    xhr.send();
}
//update and add
document.getElementById('adduserbtn').addEventListener('click', function(event) {
    event.preventDefault();
    var iduser = document.getElementById('iduser').value;
    var nameusers = document.getElementById('nameusers').value;
    var usernameusers = document.getElementById('usernameusers').value;
    var passwordusers = document.getElementById('passwordusers').value;
    var contactusers = document.getElementById('contactusers').value;
    var positionusers = document.getElementById('positionusers').value;

    var xhr = new XMLHttpRequest();
    
    var url = iduser ? 'func/updateAccount.php' : 'func/insertAccount.php';
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('iduser=' + encodeURIComponent(iduser) +'&nameusers=' + encodeURIComponent(nameusers) + '&usernameusers=' + encodeURIComponent(usernameusers) + '&passwordusers=' + encodeURIComponent(passwordusers) + '&contactusers=' + encodeURIComponent(contactusers)+ '&positionusers=' + encodeURIComponent(positionusers));
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            loadAccount();
            document.getElementById('iduser').value = '';
            document.getElementById('nameusers').value = '';
            document.getElementById('usernameusers').value = '';
            document.getElementById('passwordusers').value = '';
            document.getElementById('contactusers').value = '';
            document.getElementById('positionusers').value = '';
            document.getElementById("accountmodule").style.display = "none";
            alert("Successfully Updated!");
        }
    };
});
//edit
function editUser(id) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var user = JSON.parse(xhr.responseText);
            document.getElementById('iduser').value = user.id;
            document.getElementById('nameusers').value = user.name;
            document.getElementById('usernameusers').value = user.username;
            document.getElementById('contactusers').value = user.contact_no;
            document.getElementById('positionusers').value = user.position;
            document.getElementById("accountmodule").style.display = "flex";
        }
    };
    xhr.open('GET', 'func/fetchAccount.php?id=' + id, true);
    xhr.send();
}
//del
function deleteUser(iduser) {
    if (confirm('Are you sure you want to delete this Account?')) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                loadAccount();
            }
        };
        xhr.open('GET', 'func/delAccount.php?iduser=' + iduser, true);
        xhr.send();
    }
}
window.onload = loadAccount();



/////////////////////// Product List
//load for product
function loadProd() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('suppBody').innerHTML = xhr.responseText;
        }
    };
    xhr.open('GET', 'func/loadProd.php', true);
    xhr.send();
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
//edit
function editProd(idproduct) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var user = JSON.parse(xhr.responseText);
            document.getElementById('idproduct').value = user.id;
            document.getElementById('nameproduct').value = user.name;
            document.getElementById('productcode').value = user.pcode;
            document.getElementById('productprice').value = user.price;
            document.getElementById("productmodule").style.display = "flex";
        }
    };
    xhr.open('GET', 'func/fetchProd.php?idproduct=' + idproduct, true);
    xhr.send();
}
//del
function deleteProd(idproduct) {
    if (confirm('Are you sure you want to Remove this Product?')) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                loadProd();
            }
        };
        xhr.open('GET', 'func/delProd.php?idproduct=' + idproduct, true);
        xhr.send();
    }
}
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
                        <td style='width:5%;text-align:center;'><button style='width:2dvw; height: 5dvh;'  onclick='editProd( ${product.id})'>✎</button> <button style='width:3dvw; height: 5dvh;' onclick='deleteProd( ${product.id})'>🗑️</button></td>
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
                        <td style='width:5%;text-align:center;'><button style='width:2dvw; height: 5dvh;'  onclick='editProd( ${product.id})'>✎</button> <button style='width:3dvw; height: 5dvh;' onclick='deleteProd( ${product.id})'>🗑️</button></td>
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
window.onload = loadProd();


/////////////////////// inventory List
//load for invent
function loadraw() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('inventBody').innerHTML = xhr.responseText;
        }
    };
    xhr.open('GET', 'func/loadraw.php', true);
    xhr.send();
}
//update and add
document.getElementById('addrawbtn').addEventListener('click', function(event) {
    event.preventDefault();
    var idraw = document.getElementById('idraw').value;
    var nameraw = document.getElementById('nameraw').value;
    var rawprice = document.getElementById('rawprice').value;

    var xhr = new XMLHttpRequest();
    
    var url = idraw ? 'func/updateraw.php' : 'func/insertraw.php';
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('idraw=' + encodeURIComponent(idraw) +'&nameraw=' + encodeURIComponent(nameraw) + '&rawprice=' + encodeURIComponent(rawprice));
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            loadraw();
            document.getElementById('idraw').value = '';
            document.getElementById('nameraw').value = '';
            document.getElementById('rawprice').value = '';
            document.getElementById("inventmodule").style.display = "none";
            alert("Successfully Updated!");
        }
    };
});
//edit
function editraw(idraw) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var user = JSON.parse(xhr.responseText);
            document.getElementById('idraw').value = user.id;
            document.getElementById('nameraw').value = user.name;
            document.getElementById('rawprice').value = user.price;
            document.getElementById("inventmodule").style.display = "flex";
        }
    };
    xhr.open('GET', 'func/fetchraw.php?idraw=' + idraw, true);
    xhr.send();
}
//del
function deleteraw(idraw) {
    if (confirm('Are you sure you want to Remove this Ingedient?')) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                loadraw();
            }
        };
        xhr.open('GET', 'func/deraw.php?idraw=' + idraw, true);
        xhr.send();
    }
}
//search
document.getElementById('inventsearchsing').addEventListener('click', function() {
    let searchQuery = document.getElementById('inventsearchs').value;
    fetch('func/inventseraching?query=' + encodeURIComponent(searchQuery))
        .then(response => response.json())
        .then(data => {
            let productBody = document.getElementById('inventBody');
            productBody.innerHTML = ''; 
            if (data.length > 0) {
                data.forEach(product => {
                    let row = document.createElement('tr');
                    row.innerHTML = `
                        <td style='width:10%;'>${product.id}</td>
                        <td  style='width:10%;'>${product.name}</td>
                        <td style='width:10%;'>₱${product.price}</td>
                        <td  style='width:10%;'>${product.quantity}</td>
                        <td  style='width:10%;'>${product.status}</td>
                        <td style='width:5%;text-align:center;'><button style='width:2dvw; height: 5dvh;'  onclick='editraw(${product.id})'>✎</button> <button style='width:3dvw; height: 5dvh;' onclick='deleteraw(${product.id})'>🗑️</button></td>
                    `;
                    productBody.appendChild(row);
                });
            } else {
                productBody.innerHTML = '<tr><td colspan="6">No results found.</td></tr>'
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});
document.getElementById('inventsearchs').addEventListener('change', function() {
    let searchQuery = document.getElementById('inventsearchs').value;
    fetch('func/inventseraching.php?query=' + encodeURIComponent(searchQuery))
        .then(response => response.json())
        .then(data => {
            let productBody = document.getElementById('inventBody');
            productBody.innerHTML = ''; 

            if (data.length > 0) {
                data.forEach(product => {
                    let row = document.createElement('tr');
                    row.innerHTML = `
                        <td style='width:10%;'>${product.id}</td>
                        <td  style='width:10%;'>${product.name}</td>
                        <td style='width:10%;'>₱${product.price}</td>
                        <td  style='width:10%;'>${product.quantity}</td>
                        <td  style='width:10%;'>${product.status}</td>
                        <td style='width:5%;text-align:center;'><button style='width:2dvw; height: 5dvh;'  onclick='editraw(${product.id})'>✎</button> <button style='width:3dvw; height: 5dvh;' onclick='deleteraw(${product.id})'>🗑️</button></td>
                    `;
                    productBody.appendChild(row);
                });
            } else {
                productBody.innerHTML = '<tr><td colspan="6">No results found.</td></tr>'
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});
window.onload = loadraw();



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


/////////////////////////Stock Ajustment
//load for Ajustment
function loadAd() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('tableadjust').innerHTML = xhr.responseText;
        }
    };
    xhr.open('GET', 'func/loadAdjust.php', true);
    xhr.send();
}
window.onload = loadAd();
//fetch
function editAd(adjustcode) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var user = JSON.parse(xhr.responseText);
            document.getElementById('adjustid').value = user.id;
            document.getElementById('adjustname').value = user.name;
            document.getElementById('adjustprice').value = user.price;
        }
    };
    xhr.open('GET', 'func/fetchAd.php?adjustcode=' + adjustcode, true);
    xhr.send();
}
//cancel
document.getElementById("btnadjustcancel").addEventListener("click",function(event){
    event.preventDefault();
    document.getElementById('adjustid').value = "";
    document.getElementById('adjustname').value = "";
    document.getElementById('adjustprice').value = "";
    document.getElementById('adjustquan').value = "";
    document.getElementById('adjustreason').value = "";
    document.getElementById('adjustrefer').value = "";
    loadAd();
})
//insert
document.getElementById('btnadjust').addEventListener('click', function(event) {
    event.preventDefault();
    var adjustid = document.getElementById('adjustid').value;
    var adjustrefer = document.getElementById('adjustrefer').value;
    var adjustname = document.getElementById('adjustname').value;
    var adjustprice = document.getElementById('adjustprice').value;
    var adjustquan = document.getElementById('adjustquan').value;
    var adjustreason = document.getElementById('adjustreason').value;

    if(adjustid ==="" || adjustrefer === "" || adjustname === "" || adjustprice === "" || adjustquan === "" || adjustreason === ""){
        alert("Please Insert All Fields")
    }else{
        var rrr = new XMLHttpRequest();
    var cool = 'func/AdInsert.php';
    rrr.open('POST', cool, true);
    rrr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    rrr.send('adjustid=' + encodeURIComponent(adjustid) +'&adjustrefer=' + encodeURIComponent(adjustrefer) + '&adjustname=' + encodeURIComponent(adjustname)+'&adjustprice=' + encodeURIComponent(adjustprice) +'&adjustquan=' + encodeURIComponent(adjustquan) + '&adjustreason=' + encodeURIComponent(adjustreason));
    rrr.onreadystatechange = function() {
        if (rrr.readyState === 4 && rrr.status === 200) {
        }
    };
    var xhr = new XMLHttpRequest();
    var url = 'func/updateAd.php';
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('adjustid=' + encodeURIComponent(adjustid) +'&adjustrefer=' + encodeURIComponent(adjustrefer) + '&adjustname=' + encodeURIComponent(adjustname)+'&adjustprice=' + encodeURIComponent(adjustprice) +'&adjustquan=' + encodeURIComponent(adjustquan) + '&adjustreason=' + encodeURIComponent(adjustreason));
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            loadAll();
            document.getElementById('adjustid').value = '';
            document.getElementById('adjustrefer').value = '';
            document.getElementById('adjustname').value = '';
            document.getElementById('adjustprice').value = '';
            document.getElementById('adjustquan').value = '';
            document.getElementById('adjustreason').value = '';
            alert("Successfully Updated!");
        }
    };
    }
    
});
//search
document.getElementById('searchadjustbtn').addEventListener('click', function() {
    let searchQuery = document.getElementById('searchadjust').value;
    fetch('func/adjustsearching?query=' + encodeURIComponent(searchQuery))
        .then(response => response.json())
        .then(data => {
            let productBody = document.getElementById('tableadjust');
            productBody.innerHTML = ''; 
            if (data.length > 0) {
                data.forEach(product => {
                    let row = document.createElement('tr');
                    row.innerHTML = `
                        <td style='width:10%;'>${product.id}</td>
                        <td  style='width:10%;'>${product.name}</td>
                        <td style='width:10%;'>₱${product.price}</td>
                        <td  style='width:10%;'>${product.quantity}</td>
                        <td style='width:5%;text-align:center;'><button style='width:2dvw; height: 5dvh;'  onclick='editAd(${product.id})'>≫</button></td>
                    `;
                    productBody.appendChild(row);
                });
            } else {
                productBody.innerHTML = '<tr><td colspan="5">No results found.</td></tr>'
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});
document.getElementById('searchadjust').addEventListener('change', function() {
    let searchQuery = document.getElementById('searchadjust').value;
    fetch('func/adjustsearching.php?query=' + encodeURIComponent(searchQuery))
        .then(response => response.json())
        .then(data => {
            let productBody = document.getElementById('tableadjust');
            productBody.innerHTML = ''; 

            if (data.length > 0) {
                data.forEach(product => {
                    let row = document.createElement('tr');
                    row.innerHTML = `
                        <td style='width:10%;'>${product.id}</td>
                        <td  style='width:10%;'>${product.name}</td>
                        <td style='width:10%;'>₱${product.price}</td>
                        <td  style='width:10%;'>${product.quantity}</td>
                        <td style='width:5%;text-align:center;'><button style='width:2dvw; height: 5dvh;'  onclick='editAd(${product.id})'>≫</button></td>
                    `;
                    productBody.appendChild(row);
                });
            } else {
                productBody.innerHTML = '<tr><td colspan="5">No results found.</td></tr>'
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});



//////////////// stock entry
//load for entry
function loadEntry() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('tableentry').innerHTML = xhr.responseText;
        }
    };
    xhr.open('GET', 'func/loadEntry.php', true);
    xhr.send();
}
window.onload = loadEntry();
//fetch
function editEntry(entryid) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var user = JSON.parse(xhr.responseText);
            document.getElementById('entryid').value = user.id;
            document.getElementById('entryname').value = user.name;
            document.getElementById('entryprice').value = user.price;
        }
    };
    xhr.open('GET', 'func/fetchEntry.php?entryid=' + entryid, true);
    xhr.send();
}
//cancel
document.getElementById("btnentrycancel").addEventListener("click",function(event){
    event.preventDefault();
    document.getElementById('entryrefer').value = "";
    document.getElementById('entryname').value = "";
    document.getElementById('entryid').value = "";
    document.getElementById('entryquan').value = "";
    document.getElementById('entryprice').value = "";
    loadEntry();
})
//insert
document.getElementById('btnentry').addEventListener('click', function(event) {
    event.preventDefault();
    var entryrefer = document.getElementById('entryrefer').value;
    var entryname = document.getElementById('entryname').value;
    var entryid = document.getElementById('entryid').value;
    var entryquan = document.getElementById('entryquan').value;
    var entryprice = document.getElementById('entryprice').value;

    if(entryid ==="" || entryname === "" || entryquan === "" || entryrefer === "" || entryprice === ""){
        alert("Please Insert All Fields")
    }else{
        var rrr = new XMLHttpRequest();
    var cool = 'func/EntryInsert.php';
    rrr.open('POST', cool, true);
    rrr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    rrr.send('entryrefer=' + encodeURIComponent(entryrefer) +'&entryname=' + encodeURIComponent(entryname) + '&entryid=' + encodeURIComponent(entryid)+'&entryquan=' + encodeURIComponent(entryquan) +'&entryprice=' + encodeURIComponent(entryprice));
    rrr.onreadystatechange = function() {
        if (rrr.readyState === 4 && rrr.status === 200) {
        }
    };
    var xhr = new XMLHttpRequest();
    var url = 'func/updateEntry.php';
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('entryrefer=' + encodeURIComponent(entryrefer) +'&entryname=' + encodeURIComponent(entryname) + '&entryid=' + encodeURIComponent(entryid)+'&entryquan=' + encodeURIComponent(entryquan) +'&entryprice=' + encodeURIComponent(entryprice));
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            loadAll();
            document.getElementById('entryrefer').value = '';
            document.getElementById('entryname').value = '';
            document.getElementById('entryid').value = '';
            document.getElementById('entryquan').value = '';
            document.getElementById('entryprice').value = '';
            alert("Successfully Updated!");
        }
    };
    }
    
});
//search
document.getElementById('searchentrybtn').addEventListener('click', function() {
    let searchQuery = document.getElementById('searchentry').value;
    fetch('func/entrysearch?query=' + encodeURIComponent(searchQuery))
        .then(response => response.json())
        .then(data => {
            let productBody = document.getElementById('tableentry');
            productBody.innerHTML = ''; 
            if (data.length > 0) {
                data.forEach(product => {
                    let row = document.createElement('tr');
                    row.innerHTML = `
                        <td style='width:10%;'>${product.id}</td>
                        <td  style='width:10%;'>${product.name}</td>
                        <td style='width:10%;'>₱${product.price}</td>
                        <td  style='width:10%;'>${product.quantity}</td>
                        <td style='width:5%;text-align:center;'><button style='width:2dvw; height: 5dvh;'  onclick='editAd(${product.id})'>≫</button></td>
                    `;
                    productBody.appendChild(row);
                });
            } else {
                productBody.innerHTML = '<tr><td colspan="5">No results found.</td></tr>'
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});
document.getElementById('searchentry').addEventListener('change', function() {
    let searchQuery = document.getElementById('searchentry').value;
    fetch('func/entrysearch.php?query=' + encodeURIComponent(searchQuery))
        .then(response => response.json())
        .then(data => {
            let productBody = document.getElementById('tableentry');
            productBody.innerHTML = ''; 

            if (data.length > 0) {
                data.forEach(product => {
                    let row = document.createElement('tr');
                    row.innerHTML = `
                        <td style='width:10%;'>${product.id}</td>
                        <td  style='width:10%;'>${product.name}</td>
                        <td style='width:10%;'>₱${product.price}</td>
                        <td  style='width:10%;'>${product.quantity}</td>
                        <td style='width:5%;text-align:center;'><button style='width:2dvw; height: 5dvh;'  onclick='editAd(${product.id})'>≫</button></td>
                    `;
                    productBody.appendChild(row);
                });
            } else {
                productBody.innerHTML = '<tr><td colspan="5">No results found.</td></tr>'
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});

/////////////////////records
function loadr1() {
    //stock enrtry
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('oneBody').innerHTML = xhr.responseText;
        }
    };
    xhr.open('GET', 'func/r1.php', true);
    xhr.send();
}
function rs1(){
    var start_date = document.getElementById('startDate').value;
    var end_date = document.getElementById('endDate').value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('oneBody').innerHTML = xhr.responseText;
        }
    };
    xhr.open('GET', 'func/rs1.php?start_date=' + start_date + '&end_date=' + end_date, true);
    xhr.send();
}
document.getElementById('startDate').addEventListener('change', function() {
    rs1();
});
function loadr2() {
    //inventory
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('threeBody').innerHTML = xhr.responseText;
        }
    };
    xhr.open('GET', 'func/r2.php', true);
    xhr.send();
}
function loadr3() {
    var xhr = new XMLHttpRequest();
    //sales
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('fourBody').innerHTML = xhr.responseText;
        }
    };
    xhr.open('GET', 'func/r3.php', true);
    xhr.send();
}
function loadr4() {
    //adjustment
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('twoBody').innerHTML = xhr.responseText;
        }
    };
    xhr.open('GET', 'func/r4.php', true);
    xhr.send();
}
window.onload= loadAll();


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
    loadr1();
    stating();
    loadr2();
    loadr3();
    loadprods();
    loadr4();
    loadEntry();
    numing1();
    numing2();
    loadAd();
    loadAccount();
    loadraw();
    loadProd();
    numing();
    fetchSalesAndExpenses();
    charting();
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

document.getElementById("btnprint").addEventListener("click",function(event){
    if(numero==="entry"){
        const url = "../entriesreport.php";
        window.open(url, '_blank');
        console.log(numero);
    }
    else if(numero==="invent"){
        const url = "../inventoryreport.php";
        window.open(url, '_blank');
    }
    else if(numero==="sales"){
        const url = "../salesreport.php";
        window.open(url, '_blank');
    }
    else if(numero==="adjust"){
        const url = "../adjustmentreport.php";
        window.open(url, '_blank');
    }
})

function printthis(){
    
}

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
function numing1() {
    const date = new Date().toISOString().slice(0, 19).replace('T', ' ');
    const today = new Date().toISOString().slice(0, 19)
    fetch('func/ord1.php')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const rowCount = data.count;
            console.log('Number of rows in transactions table:', rowCount);
            document.getElementById('adjustrefer').value = (rowCount + 1) + today;
        } else {
            console.error('Error fetching row count:', data.message);
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
    });
}
function numing2() {
    const today = new Date().toISOString().slice(0, 10)
    fetch('func/ord2.php')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const rowCount = data.count;
            console.log('Number of rows in transactions table:', rowCount);
            document.getElementById('entryrefer').value = (rowCount + 1) + today;
        } else {
            console.error('Error fetching row count:', data.message);
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
    });
}