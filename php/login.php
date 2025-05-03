<?php session_start();
    include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daza's Best</title>
    <link rel="stylesheet" href="../css/log.css">
</head>
<body>
    <div class="wrapper">
        <div class="box">
            <div class="left">
                <img src="../media/logiiiii.png" alt="">
                <h1>Inventory with <br>Sales Management System</h1>
                
            </div>
            <div class="right">
                <form action="" id="loginForm" method="POST">
                    <div class="label">
                        <h1>Log In</h1>
                        <h3>Welcome! Log in to your Account</h3>
                    </div>
                    <label for="user labelforinputs">
                        Username:
                    </label>
                    <input type="text" name="username" id="username" placeholder="Username">
                    <label for="pass labelforinputs">
                        Password:
                    </label>
                    <input type="password" name="password" id="password" placeholder="Password">
                    <div class="for" id="for">
                        <span>⍰</span>
                        <span>Forgot password?</span>
                    </div>
                    <center>
                    <button name="btn" id="">
                        Log In
                    </button>
                    </center>
                </form>

                <div class="forgotpasswordModule" id="forgotpasswordModule" style="display: none;">
                    <form id="forgotForm">
                        <h1>Forgot Password</h1>
                        <div>
                            <input type="hidden" name="username" id="forgotuser" value="">
                            <div class="ques">
                                <label for="" id="q1">Sample Question</label>
                                <input type="text" id="ans1" name="ans1" placeholder="Enter Your Answer" required>
                            </div>
                            <div class="ques">
                                <label for="" id="q2">sample question</label>
                                <input type="text" id="ans2" name="ans2" placeholder="Enter Your Answer" required>
                            </div>
                            <div class="ques">
                                <label for="" id="q3">Sample Question</label>
                                <input type="text" id="ans3" name="ans3" placeholder="Enter Your Answer" required>
                            </div>
                            <div id="buttons">
                            <button id="adduserbtn">Recover Password</button>
                            <button id="usercancel" >Cancel</button>
                            </div>
                        </div>
                        
                    </form>
                    
                </div>
                
                <div class="module" id="resetpass" style="display: none;">
                    <form action="" id="resetForm">
                        <div>
                            <h1>Reset Password</h1>
                            <input type="hidden" name="username" id="resetuser" value="">
                            <label for="">New Password:</label>
                            <input type="password" name="newpassword" id="newpassword" placeholder="New Password" required>
                            <label for="">Confirm Password:</label>
                            <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" required>
                            <button id="resetbtn">Reset</button>    
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    
</body>
<script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    try{
                        let response = JSON.parse(xhr.responseText);
                        alert(response.message);
                        if(response.success){
                            if (response.type === 'Admin') {
                                window.location.href = "dash.php";
                            } else if (response.type === 'Staff') {
                                window.location.href = "staff.php";
                            }
                        }else{
                        }
                        document.getElementById('loginForm').reset();
                    }catch(e){
                        console.error("JSON Parse Error:", e);
                        alert("Log in Failded!");
                        document.getElementById('message').textContent = "invalid JSON response";
                        console.log("Raw Response:", xhr.responseText);
                    }
                     }
                };
            xhr.open('POST', 'check.php', true);
            xhr.send(formData);
        });
    document.getElementById("for").addEventListener("click", function() {
        if (document.getElementById("username").value === "" ) {
           alert("Please enter your username.");
        } else {
            document.getElementById("forgotuser").value = document.getElementById("username").value;
            var name = document.getElementById("username").value;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        try {
                            var user = JSON.parse(xhr.responseText);
                            if (user.question_1 == null || user.question_2 == null || user.question_3 == null) {
                                alert("User Not Found");
                            } else {
                                document.getElementById("forgotpasswordModule").style.display = "block";
                                document.getElementById('q1').textContent = user.question_1;
                                document.getElementById('q2').textContent = user.question_2;
                                document.getElementById('q3').textContent = user.question_3;
                            }
                        } catch (e) {
                            console.error("Error parsing JSON:", e);
                            alert("Invalid response from server.");
                        }
                    } else {
                        alert("Error fetching questions. Please try again.");
                    }
                }
            };
            xhr.open('GET', './forgotpass.php?name=' + name, true);
            xhr.send();
            }
        
    });
    document.getElementById("usercancel").addEventListener("click", function() {
        document.getElementById("forgotpasswordModule").style.display = "none";
        document.getElementById("forgotuser").value = "";
        document.getElementById("forgotForm").reset();
    });
    document.getElementById("adduserbtn").addEventListener("click", function(event) {
        event.preventDefault();
        if (document.getElementById("ans1").value === "" || document.getElementById("ans2").value === "" || document.getElementById("ans3").value === "") {
            alert("Please fill in all fields.");
            return;
        }else{
            var formData = new FormData(document.getElementById("forgotForm"));
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    try {
                        if (xhr.responseText === "Account verified.") {
                            document.getElementById("resetpass").style.display = "block";
                            document.getElementById("resetuser").value = document.getElementById("forgotuser").value;
                            document.getElementById("forgotpasswordModule").style.display = "none";
                            document.getElementById("forgotForm").reset();
                        } else {
                            alert(xhr.responseText);
                            document.getElementById("forgotpasswordModule").style.display = "none";
                            document.getElementById("forgotForm").reset();
                        }
                    } catch (e) {
                        console.error("JSON Parse Error:", e);
                        alert("Error processing response.");
                    }
                }
            };
            xhr.open('POST', 'checkans.php', true);
            xhr.send(formData);
        }
        
    });
    document.getElementById("resetbtn").addEventListener("click", function(event) {
        event.preventDefault();
        if (document.getElementById("newpassword").value === "" || document.getElementById("confirmpassword").value === "") {
            alert("Please fill in all fields.");
            return;
        } else if (document.getElementById("newpassword").value !== document.getElementById("confirmpassword").value) {
            alert("Passwords do not match.");
            return;
        } else {
            var formData = new FormData(document.getElementById("resetForm"));
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    if(xhr.responseText === "Update successful.") {
                        alert("Password reset successful. Please log in with your new password.");
                        document.getElementById("resetpass").style.display = "none";
                        document.getElementById("resetForm").reset();
                    } else {
                        alert("Error resetting password. Please try again.");
                        document.getElementById("resetForm").reset();
                    }
                }
            };
            xhr.open('POST', 'reset.php', true);
            xhr.send(formData);
        }
        
    });
</script>
</html>