<?php
    session_start();
    include 'connection.php';

    if (!isset($_SESSION['user_id'])) {
    header("Location: ./login.php");
    exit;
}

try {
    $stmt = $conn->prepare("SELECT name FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $userName = $user['name'];
    } else {
        $userName = "User not found";
    }

} catch (PDOException $e) {
    $userName = "Database error";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daza's Best</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/dash.css">
</head>
<body>
    <div class="wrapper">
        <div class="navtop">
            <h1>Daza's Best Inventory with Sales System</h1>
        </div>
        <div class="nav">
            <img src="../media/logiiiii.png" alt="no img">
            <ul class="nav-list">
                <li><a href="#" id="dash">Dashboard</a></li>
                <li><a href="#" id="supplier">Product List</a></li>
                <li><a href="#" id="order">Order Sales</a></li>
                <li><a href="../index.php" id="Logout">Log Out</a></li>
            </ul>
        </div>
        <input type="text" id="nums" hidden>

        <div class="box">
        <div id="dash-content" class="content-section">
                <h1>Sales & Expenses</h1>
                    <div class="line">
                        <div class="cont">
                        <h3>Weekly Sales</h3>
                        <h3 id="weekly-sales">number</h3>
                        </div>
                        <div class="cont">
                        <h3>Monthly Sales</h3>
                        <h3 id="monthly-sales">number</h3>
                        </div>
                        <div class="cont">
                        <h3>Yearly Sales</h3>
                        <h3 id="yearly-sales">number</h3>
                        </div>
                        <div class="cont" id="ex">
                        <h3>Monthly Expenses</h3>
                        <h3 id="monthly-expenses">number</h3>
                        </div>
                    </div>
                    
                    <div class="line">
                        <div class="one">
                            <div>
                                <canvas id="salesChart" style="width: 31dvw; height: 24dvh; display: block;"></canvas>
                            </div>
                        </div>
                        <div class="one">
                        <table>
                            <thead>
                                <th>Top Selling Products</th>
                                <th></th>
                            </thead>
                            <tbody id="least">

                            </tbody>
                        </table>
                        <table>
                            <thead>
                                <th>Least Selling Products</th>
                                <th></th>
                            </thead>
                            <tbody id="top">

                            </tbody>
                        </table>
                        </div>
                    </div>
        </div>

            <div id="order-content" class="content-section" style="display: none;">
                <h1>Order Sales</h1>
                <div class="cool">
                    <div class="head">
                        <input type="text" id="searchorder"> <button id="searchorderbtn"> search</button> 
                        <table>
                            <thead>
                                <th>Product Name</th>
                                <th>Product Code</th>
                                <th>Price</th>
                                <th>Action</th>
                            </thead>
                            <tbody id="tableorder">

                            </tbody>
                        </table>
                    </div>
                    <div class="container">
                        <form action="" id="form">
                                <div class="tablediv">
                                    <table>
                                        <thead>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody id="tablechoosen"> 

                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <input type="text" id="orderid" hidden>
                                    <label for="">Total</label>
                                    <input type="number" id="totaltxt" name="totaltxt">
                                </div>
                                <div>
                                    <label for="">Payment</label>
                                    <input type="number" id="paymenttxt" name="paymenttxt">
                                </div>
                                <div>
                                    <label for="">Change</label>
                                    <input type="number" id="change" name="change">
                                </div>
                                <div>
                                    <button id="paybtn">Pay</button>
                                </div>  
                        </form>
                    </div>
                </div>
            </div>
            <div id="supplier-content" class="content-section" style="display: none;">
                <div class="head">
                        <h1>Product List</h1>
                        <div class="btn">
                            <input type="text" name="productssearchs" id="productssearchs">
                            <button id="productssearchsing">Search</button>
                            <!-- <button id="suppAddbtn">+</button> -->
                            <!-- <button id="suppRecbtn">Recover</button> -->
                        </div>
                    </div>
                <div class="container">
                    <div class="body">
                        <table>
                            <thead>
                                <th>Product Name</th>
                                <th>Product Code</th>
                                <th>Price</th>
                            </thead>
                            <tbody id="suppBody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            
            


        </div>
    </div>
            <div class="module" id="productmodule" style="display: none;">
                <form action="">
                    <h1>Product Module</h1>
                    <div>
                        <div>
                            <input type="text" id="idproduct" name="idproduct" hidden>
                            <input type="text" id="nameproduct" name="nameproduct" placeholder="Product Name" required>
                        </div>
                        <div>
                            <input type="text" id="productcode" name="productcode" placeholder="Product Code" required>
                            <input type="text" id="productprice" name="productprice" placeholder="Product Price" required>
                        </div>
                        <div>
                            <button id="addproductbtn">Update</button>
                            <button id="productcancel" >Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- <div id="dash-content" class="content-section">
                <h1>Sales & Expenses</h1>
                    <div class="line">
                        <div class="cont">
                        <h3>Weekly Sales</h3>
                        <h3 id="weekly-sales">number</h3>
                        </div>
                        <div class="cont">
                        <h3>monthly-sales</h3>
                        <h3 id="monthly-sales">number</h3>
                        </div>
                        <div class="cont">
                        <h3>yearly-sales</h3>
                        <h3 id="yearly-sales">number</h3>
                        </div>
                        <div class="cont" id="ex">
                        <h3>monthly-expenses</h3>
                        <h3 id="monthly-expenses">number</h3>
                        </div>
                    </div>
                    
                    <div class="line">
                        <div class="one">
                        <table>
                            <thead>
                                <th>Top Selling Products</th>
                                <th></th>
                            </thead>
                            <tbody id="top">

                            </tbody>
                        </table>
                        </div>
                        <div class="one">
                        <table>
                            <thead>
                                <th>Least Selling Products</th>
                                <th></th>
                            </thead>
                            <tbody id="least">

                            </tbody>
                        </table>
                        </div>
                    </div>
            </div>


            <div id="order-content" class="content-section" style="display: none;">
                <h1>Order Sales</h1>
                <div class="cool">
                    <div class="head">
                        <input type="text" id="searchorder"> <button id="searchorderbtn"> search</button> 
                        <table>
                            <thead>
                                <th>Product Name</th>
                                <th>Product Code</th>
                                <th>Price</th>
                                <th>Action</th>
                            </thead>
                            <tbody id="tableorder">

                            </tbody>
                        </table>
                    </div>
                    <div class="container">
                        <form action="" id="form">
                                <div class="tablediv">
                                    <table>
                                        <thead>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody id="tablechoosen"> 

                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <input type="text" id="orderid" hidden>
                                    <label for="">Total</label>
                                    <input type="number" id="totaltxt" name="totaltxt">
                                </div>
                                <div>
                                    <label for="">Payment</label>
                                    <input type="number" id="paymenttxt" name="paymenttxt">
                                </div>
                                <div>
                                    <label for="">Change</label>
                                    <input type="number" id="change" name="change">
                                </div>
                                <div>
                                    <button id="paybtn">Pay</button>
                                </div>  
                        </form>
                    </div>
                </div>
            </div>

            <div id="supplier-content" class="content-section" style="display: none;">
                <div class="head">
                        <h1>Product List</h1>
                        <div class="btn">
                            <button id="suppAddbtn">+</button>
                            <button id="suppRecbtn">Recover</button> -->
                        <!-- </div>
                    </div>
                <div class="container">
                    <div class="body">
                        <table>
                            <thead>
                                <th>Product Name</th>
                                <th>Product Code</th>
                                <th>Price</th>
                                <th>Action</th>
                            </thead>
                            <tbody id="suppBody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            


        </div>
    </div>
            <div class="module" id="productmodule" style="display: none;">
                <form action="">
                    <h1>Product Module</h1>
                    <div>
                        <div>
                            <input type="text" id="idproduct" name="idproduct" hidden>
                            <input type="text" id="nameproduct" name="nameproduct" placeholder="Product Name" required>
                        </div>
                        <div>
                            <input type="text" id="productcode" name="productcode" placeholder="Product Code" required>
                            <input type="text" id="productprice" name="productprice" placeholder="Product Price" required>
                        </div>
                        <div>
                            <button id="addproductbtn">Update</button>
                            <button id="productcancel" >Cancel</button>
                        </div>
                    </div>
                </form>
            </div> -->
</body>
<script>
        document.addEventListener("DOMContentLoaded", function() {
  const navLinks = document.querySelectorAll(".nav-list li a");
  const contentSections = document.querySelectorAll(".content-section");

  navLinks.forEach(link => {
    link.addEventListener("click", function(event) {
      event.preventDefault();

      navLinks.forEach(otherLink => {
        otherLink.classList.remove("highlight");
      });
      this.classList.add("highlight");
      contentSections.forEach(section => {
        section.style.display = "none";
      });
      const contentId = this.id + "-content";
      const contentElement = document.getElementById(contentId);
      if (contentElement) {
        contentElement.style.display = "block";
      }
      
    });
  });
  document.getElementById("dash").addEventListener("click",function(){
    event.preventDefault();
    loadAll();
    
})
document.getElementById("order").addEventListener("click",function(){
    event.preventDefault();
    loadAll();
})
document.getElementById("supplier").addEventListener("click",function(){
    event.preventDefault();
    loadAll();
    
})





  document.getElementById("Logout").addEventListener("click",function(){
    if(confirm("Are you sure you want to log out?")) {
            window.location.href = "../index.php";
        } else {
        }
  })
  document.getElementById("dash-content").style.display = "block";
  document.getElementById("dash").classList.add("highlight");

});

document.getElementById("suppAddbtn").addEventListener("click",function(){
    event.preventDefault();
    document.getElementById("productmodule").style.display = "flex";
})
document.getElementById("productcancel").addEventListener("click",function(){
            event.preventDefault(); 
            document.getElementById("productmodule").style.display = "none";
            document.getElementById('idproduct').value = '';
            document.getElementById('nameproduct').value = '';
            document.getElementById('productcode').value = '';
            document.getElementById('productprice').value = '';
})


function addProductToCart(button) {
    const row = button.parentNode.parentNode;
    const productName = row.cells[0].textContent;
    const getprice = row.cells[2];  
    const priceText = getprice.textContent.replace('₱', '').replace(',', '');
    const price = parseFloat(priceText);
    const tableChoosen = document.getElementById("tablechoosen");
    const newRow = tableChoosen.insertRow();

    const nameCell = newRow.insertCell(0);
    const priceCell = newRow.insertCell(1);
    const quantityCell = newRow.insertCell(2);
    const totalCell = newRow.insertCell(3);
    const actionCell = newRow.insertCell(4);

    nameCell.textContent = productName;
    priceCell.textContent = price;
    quantityCell.innerHTML = '<input type="number" value="1" min="1" onchange="updateTotal(this)" style="width:5dvw;">';
    totalCell.textContent = price;
    actionCell.innerHTML = '<button onclick="removeProduct(this)">✖</button>';

    calculateTotal();
}
function removeProduct(button) {
    const row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
    calculateTotal();
}
function updateTotal(input) {
    const row = input.parentNode.parentNode;
    const price = parseFloat(row.cells[1].textContent);
    const quantity = parseInt(input.value);
    row.cells[3].textContent = price * quantity;
    calculateTotal();
}
function calculateTotal() {
    const tableChoosen = document.getElementById("tablechoosen");
    let grandTotal = 0;
    for (let i = 0; i < tableChoosen.rows.length; i++) {
        grandTotal += parseFloat(tableChoosen.rows[i].cells[3].textContent);
    }
    document.getElementById("totaltxt").value = grandTotal;
}
document.getElementById("paymenttxt").addEventListener('input', function() {
    calculateChange();
});
function calculateChange() {
    const payment = parseFloat(document.getElementById('paymenttxt').value);
    const total = parseFloat(document.getElementById('totaltxt').value);
    const changeInput = document.getElementById('change');

    if (!isNaN(payment) && !isNaN(total)) {
        changeInput.value = payment - total;
    } else {
        changeInput.value = "";
    }
}


    </script>
<script src="script2.js"></script>

</html>