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
            <h1>Daza's Best Inventory with Sales Management System</h1>
            

                <div class="burgernav">
                <div class="div001"></div>
                <div class="div002"></div>
                <div class="div003"></div>
            </div>
        </div>
        <div class="nav">
            <img src="../media/logiiiii.png" alt="no img">
            <ul class="nav-list">
                <li><a href="#" id="dash">Dashboard</a></li>
                <li><a href="#" id="invent">Inventory</a></li>
                <li><a href="#" id="supplier">Product List</a></li>
                <li><a href="#" id="order">Order Sales</a></li>
                <li><a href="#" id="adjustment">Stock Adjustment</a></li>
                <li><a href="#" id="out">Stock Entry</a></li>
                <li><a href="#" id="report">Reports</a></li>
                <li><a href="#" id="accounts">Account  Management</a></li>
                <li><a href="../index.php" id="Logout">Log Out</a></li>
            </ul>
        </div>
        <input type="text" id="nums" hidden>
        <input type="text" id="entrynum" hidden>
        <input type="text" id="adnum" hidden>
        </h1>
        
        <div class="box">
            <div id="dash-content" class="content-section">
                <h1>Sales & Expenses</h1>
                    <div class="line firstline">
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
                    
                    <div class="line secondline">
                        <div class="one">
                            <div class="canvas001">
                                <canvas id="salesChart" style="width: 31dvw; height: 24dvh; display: block;"></canvas>
                            </div>
                        </div>
                        <div class="one withtables">
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

            <div id="invent-content" class="content-section" style="display: none;">
                    <div class="head">
                        <h1>Inventory Items</h1>
                        <div class="btn">
                        <input type="text" name="inventsearchs" id="inventsearchs">
                        <button id="inventsearchsing">Search</button>
                            <button id="inventAddbtn">+</button>
                            <!-- <button id="inventRecbtn">Recover</button> -->
                        </div>
                    </div>
                <div class="container">
                    <div class="body">
                        <table>
                            <thead>
                                <th class="th001">Item ID</th>
                                <th class="th002">Item Name</th>
                                <th class="th003">Price</th>
                                <th class="th004">Quantity (kg)</th>
                                <th class="th005">Status</th>
                                <th class="th00 ">Action</th>
                            </thead>
                            <tbody id="inventBody">

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
                                <div class="fortotals001">
                                    <input type="text" id="orderid" hidden>
                                    <label for="">Total</label>
                                    <input type="number" id="totaltxt" name="totaltxt">
                                </div>
                                <div  class="fortotals002">
                                    <label for="">Payment</label>
                                    <input type="number" id="paymenttxt" name="paymenttxt">
                                </div>
                                <div  class="fortotals003">
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

            <div id="adjustment-content" class="content-section" style="display: none;">
                <h1>Stock Adjustment</h1>
                <div class="cool">
                    <div class="head">
                        <input type="text" id="searchadjust"> <button id="searchadjustbtn"> search</button> 
                        <table>
                            <thead>
                                <th>Item Code</th>
                                <th>Item Name</th>
                                <th>Price</th>
                                <th>Quantity(Kg)</th>
                                <th>Action</th>
                            </thead>
                            <tbody id="tableadjust">

                            </tbody>
                        </table>
                    </div>
                    <div class="container">
                        <form action="">
                            <div class="lineforinput001">
                                <div>
                                    <label for="">Reference No.</label>
                                    <input type="text" name="adjustid" id="adjustid" hidden>
                                    <input type="text" name="adjustrefer" id="adjustrefer" required>
                                </div>
                                <div>
                                    <label for="">Item Name</label>
                                    <input type="text" name="adjustname" id="adjustname" readonly required> 
                                </div>
                                <div>
                                    <label for="">Item Price</label>
                                    <input type="text" name="adjustprice" id="adjustprice" readonly required>
                                </div>
                            </div>
                            <div class="lineforinput002">
                                <div>
                                    <label for="">Quantity (kg)</label>
                                    <input type="number" name="adjustquan" id="adjustquan" required>
                                </div>
                                <div>
                                    <label for="">Reason</label>
                                    <input type="text" name="adjustreason" id="adjustreason" required>
                                </div>
                                <div class="forbuttons">
                                    <button id="btnadjust">Enter</button>
                                    <br>
                                    <button id="btnadjustcancel">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>

            <div id="out-content" class="content-section" style="display: none;">
                <h1>Stock Entry</h1>
                <div class="cool">
                    <div class="head">
                        <input type="text" id="searchentry"> <button id="searchentrybtn"> search</button> 
                        <table>
                            <thead>
                                <th>Item ID</th>
                                <th>Item Name</th>
                                <th>Price</th>
                                <th>Quantity(Kg)</th>
                                <th>Action</th>
                            </thead>
                            <tbody id="tableentry">

                            </tbody>
                        </table>
                    </div>
                    <div class="container">
                        <form action="">
                            <div class="lineforinput001">
                                <div>
                                    <label for="">Reference No.</label>
                                    <input type="text" name="entryrefer" id="entryrefer" required>
                                </div>
                                <div>
                                    <label for="">Item Name</label>
                                    <input type="text" name="entryname" id="entryname" readonly required>
                                </div>
                                <div>
                                    <label for="">Item ID</label>
                                    <input type="text" name="entryid" id="entryid" readonly required>
                                </div>
                            </div>
                            <div class="lineforinput002">
                                <div>
                                    <label for="">Quantity (Kg)</label>
                                    <input type="number" name="entryquan" id="entryquan" required>
                                </div>
                                <div>
                                    <label for="">Price</label>
                                    <input type="number" name="entryprice" id="entryprice" required>
                                </div>
                                <div>
                                    <button id="btnentry">Enter</button>
                                    <br>
                                    <button id="btnentrycancel">Cancel</button>
                                </div>
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
                            <button id="suppAddbtn">+</button>
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
                                <th>Action</th>
                            </thead>
                            <tbody id="suppBody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="report-content" class="content-section" style="display: none;">
                <h1>Reports</h1>
                <div class="cool">
                    <div class="head">
                        <button id="button1">Stock Entries</button>
                        <button id="button2">Inventory</button>
                        <button id="button3">Sales</button>
                        <button id="button4">Stock Adjustments</button>
                        <div class="filter" id="stockentryrs1">
                            <label for="">Start Date</label>
                            <input type="date" id="startDate" name="startDate"  required>
                            <label for="">End Date</label>
                            <input type="date" id="endDate" name="endDate" required>
                            <button id="btnprint" >Print</button>
                        </div>
                        <div class="filter" id="stockadjustrs2" style="display: none;">
                            <label for="">Start Date</label>
                            <input type="date" id="startDate" name="startDate"  required>
                            <label for="">End Date</label>
                            <input type="date" id="endDate" name="endDate" required>
                            <button id="btnprint" >Print</button>
                        </div>
                        <div class="filter" id="stocksalesrs3" style="display: none;">
                            <label for="">Start Date</label>
                            <input type="date" id="startDate" name="startDate"  required>
                            <label for="">End Date</label>
                            <input type="date" id="endDate" name="endDate" required>
                            <button id="btnprint" >Print</button>
                        </div>    
                        

                    </div>
                    <div class="container">
                        <div class="one" id="record-one">
                            <table id="stockentry">
                                <thead>
                                    <th>Reference No</th>
                                    <th>Item Name</th>
                                    <th>Item ID</th>
                                    <th>Quantity (kg)</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                </thead>
                                <tbody id="oneBody">

                                </tbody>
                            </table>
                        </div>
                        <div class="one" id="record-two" style="display: none;">
                            <table id="stockout">
                                <thead>
                                    <th>Reference No</th>
                                    <th>Item Name</th>
                                    <th>Price</th>
                                    <th>Quantity (kg)</th>
                                    <th>Reason</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                </thead>
                                <tbody id="twoBody">

                                </tbody>
                            </table>
                        </div>
                        <div class="one" id="record-three" style="display: none;">
                            <table id="stockinvent">
                                <thead>
                                    <th>Item ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity (kg)</th>
                                    <th>Status</th>
                                </thead>
                                <tbody id="threeBody">

                                </tbody>
                            </table>
                        </div>
                        <div class="one" id="record-four" style="display: none;">
                            <table id="sales">
                                <thead>
                                    <th>Transaction No</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Payment</th>
                                    <th>Change</th>
                                    <th>Date</th>
                                </thead>
                                <tbody id="fourBody">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div id="accounts-content" class="content-section" style="display: none;">
                <div class="head">
                        <h1>Account Management</h1>
                        <div class="btn">
                            <button id="actAddbtn">+</button>
                            <!-- <button id="actRecbtn">Recover</button> -->
                        </div>
                    </div>
                <div class="container">
                    <div class="body">
                        <table>
                            <thead>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Contact No.</th>
                                <th>Action</th>
                            </thead>
                            <tbody id="actBody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            


        </div>
    </div>
            <div class="module" id="accountmodule" style="display: none;">
                <form action="">
                    <h1>Account Module</h1>
                    <div>
                        <div>
                            <input type="text" id="iduser" name="iduser" hidden>
                            <input type="text" id="nameusers" name="nameusers" placeholder="Full Name" required>
                        </div>
                        <div>
                            <input type="text" id="contactusers" name="contactusers" placeholder="Contact No." required>
                            <input type="text" id="usernameusers" name="usernameusers" placeholder="Username" required>
                        </div>
                        <div>
                            <input type="password" id="passwordusers" name="passwordusers" placeholder="Password" required>
                            <input type="text" id="positionusers" name="positionusers" placeholder="Position" required>
                        </div>
                        <div>
                            <u><b>Security Questions</b></u>
                        </div>
                        <div class="ques">
                            <select name="q1" id="q1" aria-placeholder="Select A Question">
                                <option value="Admin">What was the name of your first pet?</option>
                                <option value="Staff">What is the name of the first company you worked for?</option>
                                <option value="Manager">What is your mother's maiden name?</option>
                            </select>
                            <input type="text" id="ans1" name="ans1" placeholder="Enter Your Answer" required>
                        </div>
                        <div class="ques">
                        <select name="q2" id="q2" aria-placeholder="Select A Question">
                                <option value="Admin">In what city did your parents meet?</option>
                                <option value="Staff">What is the name of the first school you remember attending?</option>
                                <option value="Manager">What was the name of your favorite teacher?
                                </option>
                            </select>
                            <input type="text" id="ans2" name="ans2" placeholder="Enter Your Answer" required>
                        </div>
                        <div class="ques">
                        <select name="q3" id="q3" aria-placeholder="Select A Question">
                                <option value="Admin">What is your favorite book?</option>
                                <option value="Staff">What is the name of a college you applied to but didn’t attend?
                                </option>
                                <option value="Manager">What was the destination of your most memorable school field trip?</option>
                            </select>
                            <input type="text" id="ans3" name="ans3" placeholder="Enter Your Answer" required>
                        </div>
                        <div>
                            <button id="adduserbtn">Update</button>
                            <button id="usercancel" >Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="module" id="productmodule" style="display: none;">
                <form action="">
                    <h1>Product Module</h1>
                    <div class="deviderforproduct">
                        <div class="forinput002">
                            <input type="text" id="idproduct" name="idproduct" hidden>
                            <input type="text" id="nameproduct" name="nameproduct" placeholder="Product Name" required>
                        </div>
                        <div class="forinput002">
                            <input type="text" id="productcode" name="productcode" placeholder="Product Code" required>
                            <input type="text" id="productprice" name="productprice" placeholder="Product Price" required>
                        </div>
                        <div class="forbuttons002">
                            <button id="addproductbtn">Update</button>
                            <button id="productcancel" >Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="module" id="inventmodule" style="display: none;">
                <form action="">
                    <h1>Inventory Items Module</h1>
                    <div class="divideraddinvent001">
                        <div class="forinput002">
                            <input type="text" id="idraw" name="idraw" hidden>
                            <input type="text" id="nameraw" name="nameraw" placeholder="Ingedient Name" required>
                            <input type="text" id="rawprice" name="rawprice" placeholder="Price Bought" required>
                        </div>
                        <div class="forbuttons002">
                            <button id="addrawbtn">Update</button>
                            <button id="rawcancel" >Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
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
  document.getElementById("Logout").addEventListener("click",function(){
        if(confirm("Are you sure you want to log out?")) {
            window.location.href = "../index.php";
        } else {
        }
  })
  document.getElementById("dash-content").style.display = "block";
  document.getElementById("dash").classList.add("highlight");

});

document.getElementById("dash").addEventListener("click",function(){
    event.preventDefault();
    loadAll();
    
})
document.getElementById("invent").addEventListener("click",function(){
    event.preventDefault();
    loadAll();
    
})
document.getElementById("order").addEventListener("click",function(){
    event.preventDefault();
    loadAll();
})
document.getElementById("adjustment").addEventListener("click",function(){
    event.preventDefault();
    loadAll();
    numing1();
})
document.getElementById("out").addEventListener("click",function(){
    event.preventDefault();
    loadAll();
    numing2();
    
})
document.getElementById("supplier").addEventListener("click",function(){
    event.preventDefault();
    loadAll();
    
})
document.getElementById("report").addEventListener("click",function(){
    event.preventDefault();
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
})
document.getElementById("accounts").addEventListener("click",function(){
    event.preventDefault();
    loadAll();
    
})


document.getElementById("actAddbtn").addEventListener("click",function(){
    event.preventDefault();
    document.getElementById("accountmodule").style.display = "flex";
})
document.getElementById("usercancel").addEventListener("click",function(){
    event.preventDefault();
    document.getElementById('iduser').value = '';
            document.getElementById('nameusers').value = '';
            document.getElementById('usernameusers').value = '';
            document.getElementById('passwordusers').value = '';
            document.getElementById('contactusers').value = '';
            document.getElementById('positionusers').value = '';
    document.getElementById("accountmodule").style.display = "none";
})
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
document.getElementById("inventAddbtn").addEventListener("click",function(){
    event.preventDefault();
    document.getElementById("inventmodule").style.display = "flex";
})
document.getElementById("rawcancel").addEventListener("click",function(){
    event.preventDefault();
    document.getElementById('idraw').value = '';
            document.getElementById('nameraw').value = '';
            document.getElementById('rawprice').value = '';
    document.getElementById("inventmodule").style.display = "none";
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
<script src="script.js"></script>
<script src="responsive.js"></script>

</html>