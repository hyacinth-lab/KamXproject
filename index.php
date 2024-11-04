<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KamXproject</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <meta name="theme-color" content="#f19e36" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="./assets/favicon/favicon.ico">
    <style>
        /* Add a style to set all text color to white */
        body, 
        .squad-container, 
        .login-detail, 
        .user-data, 
        .timer-container p, 
        .rank-container, 
        .coin-container, 
        .container, 
        .menu-container, 
        .power-count span {
            color: white;
        }
    </style>
</head>
<body>

    <?php
    session_start();
    $isLoggedIn = isset($_SESSION['user_name']);
    $userName = $isLoggedIn ? $_SESSION['user_name'] : null;
    ?>

    <div class="squad-container">
        <div class="login">
            <div class="login-detail">
                <div class="profile">
                    <span></span>
                </div>

                <div class="user-data">
                    <span class="name"><?php echo $isLoggedIn ? htmlspecialchars($userName) : 'No user logged in'; ?></span>
                    <span class="user-rank"></span>
                </div>
            </div>

            <div>
                <a href="login.html">
                    <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.8" d="M2.00098 11.999L16.001 11.999M16.001 11.999L12.501 8.99902M16.001 11.999L12.501 14.999" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path opacity="0.5" d="M9.00195 7C9.01406 4.82497 9.11051 3.64706 9.87889 2.87868C10.7576 2 12.1718 2 15.0002 2L16.0002 2C18.8286 2 20.2429 2 21.1215 2.87868C22.0002 3.75736 22.0002 5.17157 22.0002 8L22.0002 16C22.0002 18.8284 22.0002 20.2426 21.1215 21.1213C20.2429 22 18.8286 22 16.0002 22H15.0002C12.1718 22 10.7576 22 9.87889 21.1213C9.11051 20.3529 9.01406 19.175 9.00195 17" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="timer-container">
       <p align="Justify"> Complete tasks before 24 hours <br/> and stand a chance to <br/>get 0.5 Solana in airdrop!!! </p>
    </div>

    <div class="rank-container">
        <div class="rank-items">
            <h3 class="select-none"></h3>
            <span></span>
            <img src="./assets/images/hamster.png" class="select-none" width="30px">
            <span id="rank" class="select-none">KamX</span>
        </div>
    </div>
    
    <div class="timer-container">
        <p>Countdown to the kickstart of the KamX project, A series of Lionesses. <br/>Partake in the first airdrop before launching, complete the tasks below and submit your Solana wallet.
        <br/> Stand a chance to Get more Solana by <a href="earn.html">completing all the tasks</a></p>
        <div class="timer" id="countdown">Loading...</div>
    </div>
    <br/><br/>
    <script>
        // Set the countdown end date to 13 days from now
        const endDate = new Date().getTime() + 13 * 24 * 60 * 60 * 1000;

        // Update the countdown every second
        const countdownInterval = setInterval(() => {
            const now = new Date().getTime();
            const timeRemaining = endDate - now;

            // Calculate days, hours, minutes, and seconds remaining
            const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

            // Display the result in the countdown element
            document.getElementById("countdown").innerHTML = 
                `${days}d ${hours}h ${minutes}m ${seconds}s`;

            // If the countdown is over, display a message
            if (timeRemaining < 0) {
                clearInterval(countdownInterval);
                document.getElementById("countdown").innerHTML = "Time's up!";
            }
        }, 1000);
    </script>

    <div class="coin-container">
        <div class="container"> 
            <h2>Complete Tasks to Submit Your Wallet</h2> 
            <div class="task"> 
                <input type="checkbox" id="task1" onclick="checkTasks()"> 
                <label for="task1"> <a href="https://x.com/kamcoin_project" target="_blank">Follow on X</a> </label> 
            </div> 
            <div class="task"> 
                <input type="checkbox" id="task2" onclick="checkTasks()"> 
                <label for="task2"> <a href="https://www.tiktok.com/@kamxcrew?_t=8r4O8Mygoli&_r=1" target="_blank">Follow on TikTok</a> </label> 
            </div> 
            <div class="task"> 
                <input type="checkbox" id="task3" onclick="checkTasks()"> 
                <label for="task3"> <a href="https://youtube.com/@kamxcomictv?si=Z7O8PUI3ehFn7aLJ" target="_blank">Subscribe on YouTube</a> </label> 
            </div> 
            <form id="walletForm" onsubmit="submitWallet(event)"> 
                <label for="wallet">Solana Wallet Address:</label> 
                <input type="text" id="wallet" name="wallet" required style="width: 100%; padding: 8px; margin-top: 10px;"> 
                <button id="submitBtn" disabled>Submit</button> 
            </form> 
        </div> 
        <script> 
            function checkTasks() { 
                // Check if all checkboxes are checked 
                const task1 = document.getElementById("task1").checked; 
                const task2 = document.getElementById("task2").checked; 
                const task3 = document.getElementById("task3").checked; 
                const submitBtn = document.getElementById("submitBtn"); 
                if (task1 && task2 && task3) { 
                    submitBtn.disabled = false; 
                    submitBtn.classList.add("active"); 
                } else { 
                    submitBtn.disabled = true; 
                    submitBtn.classList.remove("active"); 
                } 
            } 
            
            function submitWallet(event) { 
                event.preventDefault(); 
                const wallet = document.getElementById("wallet").value; 
                alert("Patience is a Virtue, Stay tuned for $KamX mining"); 
                window.location.href = "frens.html"; // Redirect to frens.html
            } 
        </script> 
    </div>

    <br><br><br>
    <div class="menu-container">
        <div class="power">
            <img src="./assets/images/28.png" width="40px">
            <div class="power-count">
                <span id="power" class="select-none">0</span>
                <span class="gray select-none" id="total">/0</span>
            </div>
        </div>

        <div class="menu-bottuns">
            <a href="frens.html" class="button b-r">
                <img src="./assets/images/1.png" alt="" width="28px">
                <span class="select-none">friends</span>
            </a>
            <a href="earn.html" class="button b-r">
                <img src="./assets/images/2.png" alt="" width="28px">
                <span class="select-none">tasks</span>
            </a>
            <a href="guid.html" class="button">
                <img src="./assets/images/3.png" alt="" width="28px">
                <span class="select-none">roadmap</span>
            </a>
        </div>
    </div>

    <div class="progress-bar">
        <div class="progress"></div>
    </div>

    <script src="./assets/js/main.js"></script>
</body>
</html>