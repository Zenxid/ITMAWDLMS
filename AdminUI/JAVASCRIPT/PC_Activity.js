const tableData = [
    {
      Picture: "/Pictures/pc.png",
      Name: "PC-1",
      User: "Sean Michael Bryan G. Lao",
      Timestamp: "1:00 PM",
      Date: "2024-01-04"
    },
    {
      Picture: "/Pictures/pc.png",
      Name: "PC-1",
      User: "Pewdiepie",
      Timestamp: "1:00 PM",
      Date: "2024-01-05"
    },
    {
      Picture: "/Pictures/pc.png",
      Name: "PC-2",
      User: "Markiplier",
      Timestamp: "3:00 PM",
      Date: "2024-01-04"
    },
    {
      Picture: "/Pictures/pc.png",
      Name: "PC-1",
      User: "Sean Michael Bryan G. Lao",
      Timestamp: "3:00 PM",
      Date: "2024-01-04"
    },
    {
      Picture: "/Pictures/pc.png",
      Name: "PC-2",
      User: "John Percy",
      Timestamp: "1:32 PM",
      Date: "2024-01-06"
    },
    {
      Picture: "/Pictures/pc.png",
      Name: "PC-2",
      User: "Cheems the Admin",
      Timestamp: "9:00 AM",
      Date: "2024-01-04"
    }
];

const tableBody = document.getElementById('tableBody');
const selectMonth = document.getElementById('months');
const selectDay = document.getElementById('days');
const selectYear = document.getElementById('years');
const searchInput = document.querySelector('input');

populateDaysForMonth(1);
selectMonth.addEventListener("change", function() {
    populateDaysForMonth(parseInt(this.value));
});

updateTable(1, 1);

selectYear.addEventListener("change", function() {
    filterTableData();
});

selectMonth.addEventListener("change", function() {
    updateTable(parseInt(selectYear.value), parseInt(this.value), parseInt(selectDay.value));
});

selectDay.addEventListener("change", function() {
    updateTable(parseInt(selectYear.value), parseInt(selectMonth.value), parseInt(this.value));
});

searchInput.addEventListener("input", function() {
    filterTableData();
});

function populateDaysForMonth(month) {
    var daysInMonth = new Date(2024, month, 0).getDate();
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

function updateTable(year, month, day) {
    const filteredData = tableData.filter(row => {
        const rowDate = new Date(row.Date);
        return rowDate.getFullYear() === year &&
               rowDate.getMonth() + 1 === month &&
               rowDate.getDate() === day;
    });
    renderTable(filteredData);
}

function filterTableData() {
    const searchTerm = searchInput.value.toLowerCase();
    const selectedMonth = parseInt(selectMonth.value);
    const selectedDay = parseInt(selectDay.value);
    const selectedYear = parseInt(selectYear.value);

    const filteredData = tableData.filter(row => {
        const rowDate = new Date(row.Date);
        return rowDate.getMonth() + 1 === selectedMonth &&
               rowDate.getDate() === selectedDay &&
               rowDate.getFullYear() === selectedYear &&
               Object.values(row).some(value => value.toLowerCase().includes(searchTerm));
    });
    renderTable(filteredData);
}


function renderTable(data) {
    tableBody.innerHTML = "";
    data.forEach(row => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td><img src="${row.Picture}"></img></td>
            <td><p>${row.Name}</p></td>
            <td><p>${row.User}</p></td>
            <td class="active"><p>${row.Timestamp}</p></td>
        `;
        tableBody.appendChild(tr);
    });
}

document.getElementById('exportButton').addEventListener('click', exportToExcel);

function exportToExcel() {
    const month = document.getElementById('months').value;
    const day = document.getElementById('days').value;
    const year = document.getElementById('years').value;

    const filename = `table_${month}-${day}-${year}.xls`;

    const tableClone = document.querySelector('table').cloneNode(true);

    const pictureColumnIndex = 0;
    const rows = tableClone.querySelectorAll('tr');
    rows.forEach(row => {
        row.deleteCell(pictureColumnIndex);
    });

    const tableHTML = tableClone.outerHTML;

    const blob = new Blob([tableHTML], { type: 'application/vnd.ms-excel' });
    const url = URL.createObjectURL(blob);
    
    const a = document.createElement('a');
    a.href = url;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
}

