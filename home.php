<?php
require_once('config.php');

if (!isset($_SESSION['partner_id'])) {
    header("Location: profile.php");
    exit;
}

$partner_id = $_SESSION['partner_id']; 

$query = "SELECT firstname FROM partner WHERE partner_id = '$partner_id'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);


if ($row) {
    $firstname = $row['firstname'];
} else {
    $firstname = "Unknown"; 
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Tracker</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
      body {
  background-image: url("images/cold.gif");
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 5px;
             margin-bottom: 0px;
        }

        .time {
            min-width: 80px;
            text-align: center;
        }

        #time-table {
            margin-top: 10px;
        }

        #current-time {
            margin-bottom: 20px;
        }

        .form-heading {
            margin-bottom: 10px;
            font-family:sans-serif;
        }
        #current-time-container {
            margin-top: 50px;
            }

            #time-table th, #time-table td {
            padding:15px;
            text-align: center;
            border: 5px solid #ddd;
            color: yellowgreen;
                }
    </style>
</head>
<body  onload="setInterval(updateTime, 1000)">


    <div class="menu-container">
        <ul class="menu">
            <img src="images/logo.png" style="width:150px;height:42px;">
            <li style="float:right"><a class="active" href="logout.php">Logout</a></li>
            <li style="float:right"><a class="active" href="profile.php">Profile</a></li>
            
        </ul>
    </div>

    <div class="container">
        <h2 class="form-heading">Good day, <?php echo $firstname;?>!<br><br>
            <span id="firstname"></span>
            Today is <span id="current-time"><br></span></h2>
        <div class="button-container">
            <button id="time-in-btn">Time In</button>
            <button id="break-out-btn">Break Out</button>
            <button id="break-in-btn">Break In</button>
            <button id="time-out-btn">Time Out</button>
            <button id="clear-btn">Clear All</button>
        </div>
       
        <div id="current-time-container">
        <table id="time-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time In</th>
                    <th>Break Out</th>
                    <th>Break In</th>
                    <th>Time Out</th>
                </tr>
            </thead>
            <tbody id="time-table-body">
            </tbody>
        </table>
    </div>
</div>
</div>
    <script>

         // Function to display the alarm or note
        function displayAlarm() {
            // Replace the alert with your desired implementation
            alert("1-hour break completed!");
        }

        // Function to start the 1-hour timer
        function startTimer() {
            setTimeout(displayAlarm, 60 * 60 * 1000); // 1 hour in milliseconds
        }

        // Call the function to start the timer
        startTimer();
        
        // marvin cabutaje
        const timeTableBody = document.getElementById('time-table-body');
        timeTableBody.style.backgroundColor = 'white';
        timeTableBody.style.fontWeight = 'bold';
        timeTableBody.style.fontSize = '18px';
        const currentTimeP = document.getElementById('current-time');
        const timeInBtn = document.getElementById('time-in-btn');
        const breakOutBtn = document.getElementById('break-out-btn');
        const breakInBtn = document.getElementById('break-in-btn');
        const timeOutBtn = document.getElementById('time-out-btn');
        const clearBtn = document.getElementById('clear-btn');
        let timeRecords = [];

     
        function updateTime() {
            const now = new Date();
            const options = { month: 'long', day: 'numeric', year: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric' };
  const dateString = now.toLocaleDateString('en-US', options);
  currentTimeP.innerText = dateString;
}

setInterval(updateTime, 1000);

        
        function getCurrentTime() {
            const now = new Date();
            return now.toLocaleTimeString();
         
        }

       
        function saveTimeRecord(action) {
            const date = new Date().toLocaleDateString();
            const time = getCurrentTime();
            const record = timeRecords.find(r => r.date === date);
            if (record) {
                record[action] = time;
            } else {
                timeRecords.push({
                    date: date,
                    timeIn: "",
                    breakOut: "",
                    breakIn: "",
                    timeOut: "",
                    [action]: time
                });
            }
            updateTable();
        }

       
        function updateTable() {
            timeTableBody.innerHTML = "";
            timeRecords.forEach(record => {
                const tr = document.createElement('tr');
                const dateTd = document.createElement('td');
                dateTd.innerText = record.date;
                tr.appendChild(dateTd);
                Object.values(record).slice(1).forEach(value => {
                    const td = document.createElement('td');
                    td.innerText = value !== "" ? value : "-";
                    td.classList.add("time");
                    tr.appendChild(td);
                });
                timeTableBody.appendChild(tr);
            });
        }

      
        function clearAllRecords() {
            timeRecords = [];
            updateTable();
        }

      
        function handleTimeIn() {
            saveTimeRecord("timeIn");
            timeInBtn.disabled = true;
            breakOutBtn.disabled = false;
            breakInBtn.disabled = true;
            timeOutBtn.disabled = true;
        }

        
        function handleBreakOut() {
            saveTimeRecord("breakOut");
            timeInBtn.disabled = true;
            breakOutBtn.disabled = true;
            breakInBtn.disabled = false;
            timeOutBtn.disabled = true;
        }

       
        function handleBreakIn() {
            saveTimeRecord("breakIn");
            timeInBtn.disabled = true;
            breakOutBtn.disabled = true;
            breakInBtn.disabled = true;
            timeOutBtn.disabled = false;
        }

        
        function handleTimeOut() {
            saveTimeRecord("timeOut");
            timeInBtn.disabled = false;
            breakOutBtn.disabled = true;
            breakInBtn.disabled = true;
            timeOutBtn.disabled = true;
        }

    
        function initialize() {
            updateTime();
            timeInBtn.disabled = false;
            breakOutBtn.disabled = true;
            breakInBtn.disabled = true;
            timeOutBtn.disabled = true;
            clearBtn.addEventListener('click', clearAllRecords);
            timeInBtn.addEventListener('click', handleTimeIn);
            breakOutBtn.addEventListener('click', handleBreakOut);
            breakInBtn.addEventListener('click', handleBreakIn);
            timeOutBtn.addEventListener('click', handleTimeOut);
        }
        const formHeading = document.querySelector('.form-heading');
        formHeading.style.color = 'white';
        formHeading.style.fontSize = '30px'


        initialize();
        
    </script>



        
    </div>
    <div class="panel-footer text-right">
        <small>&reg;   A22C0305 </small>
    </div>

    
</body>
</html>