<?php
include 'PHP/connect.php';
if (!isset($_SESSION['id'])) {
    header("Location: ../LoginForm.php");
    exit();
}



$id = $_SESSION['id'];
$sql = "SELECT * FROM admin WHERE id = '$id'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $school_id = $row['school_id'];
    $name = $row['name'];
    $role = $row['role'];
    $imageData = base64_encode($row['picture']);
} else {
    header("Location: ../LoginForm.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PS4 Archive Activity</title>
    <link rel="stylesheet" href="CSS/sidebar.css">
    <link rel="stylesheet" href="CSS/PS4_Activity-Archive.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
    <div class="container">
    <div class="sidebar">
            <div class="logo_details">
                <img src="../Pictures/STI-Small.png">
                <div class="logo_name">Admin Office</div>
                <i class="bx bx-menu" id="btn"></i>
            </div>
            <div class="nav-container">
                <ul class="nav-list">
                    <li>
                        <div class="icon-link">
                            <a href="Dashboard.php">
                                <i class="bx bx-grid-alt"></i>
                                <span class="link_name">Dashboard</span>
                            </a>
                            <i class='bx bx-chevron-down drop-down'></i>
                        </div>
                        <ul class="sub-menu">
                            <li><p class="link_name">Dashboard</p></li>
                            <li><a href="Registration.php">Registration</a></li>
                            <li><a href="Borrowing.php">Borrowing</a></li>
                        </ul>
                    </li>

                    <li>
                        <div class="icon-link">
                            <a href="Book.php" class="menu-link book-link">
                                <i class='bx bxs-book'></i>
                                <span class="link_name">Book Management</span>
                            </a>
                            <i class='bx bx-chevron-down drop-down'></i>
                        </div>
                        <ul class="sub-menu">
                            <li><p class="link_name">Book Management</p></li>
                            <li><a href="Book-Database.php">Books Database</a></li>
                        </ul>
                    </li>

                    <li>
                        <div class="icon-link">
                            <a href="Activities.php" class="menu-link book-link">
                                <i class='bx bx-joystick'></i>
                                <span class="link_name">Activities Management</span>
                            </a>
                            <i class='bx bx-chevron-down drop-down'></i>
                        </div>
                        <ul class="sub-menu">
                            <li><p class="link_name">Activities Management</p></li>
                            <li><a href="PC-Database.php">PC Database</a></li>
                            <li><a href="PS4-Database.php">PS4 Database</a></li>
                            <li><a href="BoardGames-Database.php">Board Games Database</a></li>
                            <li><a href="PC_Activity.php">PC Activity</a></li>
                            <li><a href="PS4_Activity.php">PS4 Activity</a></li>
                            <li><a href="BoardGame_Activity.php">Board Games Activity</a></li>
                        </ul>
                    </li>

                    <li>
                        <div class="icon-link">
                            <a href="User.php" class="menu-link book-link">
                                <i class='bx bx-user'></i>
                                <span class="link_name">User Management</span>
                            </a>
                            <i class='bx bx-chevron-down drop-down'></i>
                        </div>
                        <ul class="sub-menu">
                            <li><p class="link_name">User Management</p></li>
                            <li><a href="Teacher.php">Teacher</a></li>
                            <li><a href="Student.php">Student</a></li>
                        </ul>
                    </li>

                    <li>
                        <div class="icon-link">
                            <a href="Message.php">
                                <i class='bx bx-message-rounded-dots'></i>
                                <span class="link_name">Message</span>
                            </a>
                            <i class='bx bx-chevron-down drop-down'></i>
                        </div>
                        <ul class="sub-menu">
                            <li><p class="link_name">Message</p></li>
                            <li><a href="Notification.php">Notify</a></li>
                            <li><a href="SMS.php">SMS</a></li>
                            <li><a href="Email.php">Email</a></li>
                        </ul>
                    </li>

                    <li>
                        <div class="icon-link">
                            <a>
                                <i class='bx bx-archive'></i>
                                <span class="link_name">Archive</span>
                            </a>
                            <i class='bx bx-chevron-down drop-down'></i>
                        </div>
                        <ul class="sub-menu">
                            <li><p class="link_name">Archive</p></li>
                            <li><a href="Book-Archive.php">Book</a></li>
                            <li><a href="Borrowing-Archive.php">Borrow</a></li>
                            <li><a href="BoardGames-Archive.php">Board Games</a></li>
                            <li><a href="PS4-Archive.php">PS4</a></li>
                            <li><a href="PC-Archive.php">PC</a></li>
                            <li><a href="BoardGames_Activity-Archive.php">Board Games Activity</a></li>
                            <li><a href="PS4_Activity-Archive.php">PS4 Activity</a></li>
                            <li><a href="PC_Activity-Archive.php">PC Activity</a></li>
                            <li><a href="Fines-Archive.php">Fines</a></li>
                        </ul>
                    </li> 
                    <li>
                        <div class="icon-link">
                            <a href="Timer.php">
                                <i class='bx bx-timer' ></i>
                                <span class="link_name">Timer</span>
                            </a>
                        </div>
                        <div class="tooltip">
                            <p>Timer</p>
                        </div>
                    </li>
                    <li>
                        <div class="icon-link">
                            <a href="Fines.php">
                                <i class='bx bx-dollar-circle' ></i>
                                <span class="link_name">Fines</span>
                            </a>
                        </div>
                        <div class="tooltip">
                            <p>Fines</p>
                        </div>
                    </li> 
                </ul>
            </div>
            <ul>
                <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <img src="data:image/jpeg;base64,<?php echo $imageData; ?>" alt="profile">
                    </div>
                    <div class="name-job">
                        <div class="profile_name"><?php echo $name; ?></div>
                        <div class="profile_status"><?php echo $role; ?></div>
                    </div>
                    <i class='bx bx-log-out'></i>
                </div>
                </li>
            </ul>
        </div>
        <!------- END OF SIDEBAR ------>
        <div class="main">
            <div class="top-bar">
                <div class="top-title">PS4 Archive Activity</div>
            </div>

            <div class="board">
                <div class="table-wrap">
                    <div class="table_container">
                        <div class="table_header">
                            <p class="title">PS4 Archive Activity Table:</p>
                            <div>
                                <input placeholder="Search" />
                            </div>
                        </div>
                        <div class="select-container">
                            <div class="custom-select">
                                <select id="months">
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                                </select>
                            </div>
                            <div class="custom-select">
                                <select id="days">
                                
                                </select>
                            </div>
                            <div class="custom-select">
                                <select id="years">
                                
                                </select>
                            </div>

                            <button id="exportButton"><i class="fa-regular fa-file-excel"></i> Export to Excel</button>
                        </div>
                        
                    </div>
                    <table width="100%">
                        <thead>
                            <tr>
                                <td style="width: 2%;">Picture</td>
                                <td>Name</td>
                                <td>User</td>
                                <td>Timestamp</td>
                                <td>Due Time</td>
                                <td>Remark</td>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php
                            $select_query = "SELECT * FROM `ps4_activity_archive`";
                            $result = mysqli_query($con, $select_query);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $data[] = $row;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
    
    <script src="https://kit.fontawesome.com/5eaa044e5f.js" crossorigin="anonymous"></script>
    <script src="JAVASCRIPT/sidebar.js"></script>
</body>
</html>

<script>
    const tableData = <?php echo json_encode($data); ?>;

    const tableBody = document.getElementById('tableBody');
    const selectMonth = document.getElementById('months');
    const selectDay = document.getElementById('days');
    const selectYear = document.getElementById('years');
    const searchInput = document.querySelector('input');

    populateDaysForMonth(1);
    selectMonth.addEventListener("change", function() {
        populateDaysForMonth(parseInt(this.value));
        filterTableData();
    });

    updateTable(1, 1);

    selectYear.addEventListener("change", filterTableData);
    selectDay.addEventListener("change", filterTableData);
    searchInput.addEventListener("input", filterTableData);

    function populateDaysForMonth(month) {
        var daysInMonth = new Date(selectYear.value, month, 0).getDate();
        selectDay.innerHTML = "";
        for (var i = 1; i <= daysInMonth; i++) {
            var option = document.createElement("option");
            option.value = i;
            option.textContent = i;
            selectDay.appendChild(option);
        }
    }

    function populateYears() {
        const currentYear = new Date().getFullYear();
        const startYear = Math.max(currentYear - 10, 2023);
        const endYear = currentYear + 10;

        for (let year = startYear; year <= endYear; year++) {
            const option = document.createElement("option");
            option.value = year;
            option.textContent = year;
            selectYear.appendChild(option);
        }
    }

    populateYears();

    function updateTable(selectedYear, selectedMonth, selectedDay) {
        const filteredData = tableData.filter(row => {
            const rowDate = new Date(row.date);
            return rowDate.getFullYear() === selectedYear &&
                rowDate.getMonth() + 1 === selectedMonth &&
                rowDate.getDate() === selectedDay;
        });
        renderTable(filteredData);
    }

    function filterTableData() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedMonth = parseInt(selectMonth.value);
        const selectedDay = parseInt(selectDay.value);
        const selectedYear = parseInt(selectYear.value);

        const filteredData = tableData.filter(row => {
            const rowDate = new Date(row.date);
            const rowYear = rowDate.getFullYear();
            const rowMonth = rowDate.getMonth() + 1;
            const rowDay = rowDate.getDate();
            return (rowYear === selectedYear || isNaN(selectedYear)) &&
                (rowMonth === selectedMonth || isNaN(selectedMonth)) &&
                (rowDay === selectedDay || isNaN(selectedDay)) && 
                Object.values(row).some(value => value.toLowerCase().includes(searchTerm));
        });
        renderTable(filteredData);
    }

    function renderTable(data) {
        tableBody.innerHTML = "";
        data.forEach(row => {
            const tr = document.createElement('tr');
            const today = new Date();
            const timestampParts = row.timestamp.split(':');
            const dueTimeParts = row.due_time.split(':');
            today.setHours(parseInt(timestampParts[0]), parseInt(timestampParts[1]), parseInt(timestampParts[2]));
            const timestamp = today.toLocaleTimeString([], { hour: 'numeric', minute: '2-digit' });
            today.setHours(parseInt(dueTimeParts[0]), parseInt(dueTimeParts[1]), parseInt(dueTimeParts[2]));
            const dueTime = today.toLocaleTimeString([], { hour: 'numeric', minute: '2-digit' });

            tr.innerHTML = `
                <td><img src="${row.picture}"></img></td>
                <td><p>${row.name}</p></td>
                <td><p>${row.user_name}</p></td>
                <td class="active"><p>${timestamp}</p></td>
                <td class="active"><p>${dueTime}</p></td>
                <td><p>${row.remark}</p></td>
            `;
            tableBody.appendChild(tr);
        });
    }

    document.getElementById('exportButton').addEventListener('click', exportToExcel);

function exportToExcel() {
    const selectedMonth = parseInt(selectMonth.value);
    const selectedDay = parseInt(selectDay.value);
    const selectedYear = parseInt(selectYear.value);

    const filteredData = tableData.filter(row => {
        const rowDate = new Date(row.date);
        const rowYear = rowDate.getFullYear();
        const rowMonth = rowDate.getMonth() + 1;
        const rowDay = rowDate.getDate();
        return (rowYear === selectedYear || isNaN(selectedYear)) &&
               (rowMonth === selectedMonth || isNaN(selectedMonth)) &&
               (rowDay === selectedDay || isNaN(selectedDay));
    });

    const filename = `table_${selectedMonth}-${selectedDay}-${selectedYear}.xls`;

    const tableClone = document.createElement('table');
    tableClone.innerHTML = '<thead>' + document.querySelector('table thead').innerHTML + '</thead>';

    const rows = filteredData.map(row => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td></td>
            <td><p>${row.name}</p></td>
            <td><p>${row.user_name}</p></td>
            <td><p>${row.timestamp}</p></td>
            <td><p>${row.due_time}</p></td>
            <td><p>${row.remark}</p></td>
        `;
        return tr;
    });

    rows.forEach(row => {
        tableClone.appendChild(row);
    });

    const html = tableClone.outerHTML;

    const blob = new Blob([html], { type: 'application/vnd.ms-excel' });
    const url = URL.createObjectURL(blob);
    
    const a = document.createElement('a');
    a.href = url;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
}
</script>