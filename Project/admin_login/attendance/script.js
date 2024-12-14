
const currentTime = new Date();
document.getElementById('current-time').textContent = currentTime.toLocaleString();

fetch('fetch_employees.php')
  .then(response => response.json())
  .then(data => {
    const employeeData = data;
    const employeeTableBody = document.getElementById('employee-data');

    employeeData.forEach(employee => {
      const tr = document.createElement('tr');

      tr.innerHTML = `
        <td>${employee.empID}</td>
        <td>${employee.name}</td>
        <td>${employee.username}</td>
        <td>${employee.department}</td>
        <td id="status-${employee.empID}">Loading...</td>
        <td id="time-${employee.empID}">Loading...</td> <!-- Cell for time -->
      `;

      employeeTableBody.appendChild(tr);


      checkAttendanceStatus(employee.empID);
    });
  })
  .catch(error => console.log('Error fetching employee data:', error));

function checkAttendanceStatus(empID) {
  fetch(`check_attendance.php?empID=${empID}`)
    .then(response => response.json())
    .then(data => {
      const statusCell = document.getElementById(`status-${empID}`);
      const timeCell = document.getElementById(`time-${empID}`);

      if (data.status === 'Present') {
        statusCell.textContent = 'Present';
        statusCell.classList.add('text-success');
       
        timeCell.textContent = data.time;
      } else {
        statusCell.textContent = 'Absent';
        statusCell.classList.add('text-danger');
        timeCell.textContent = '-';  
      }
    })
    .catch(error => console.log('Error checking attendance status:', error));
}
 