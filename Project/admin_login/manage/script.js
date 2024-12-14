document.addEventListener("DOMContentLoaded", () => {
  fetchEmployeeData();

  
  document.querySelector('.form-inline').addEventListener("submit", event => {
    event.preventDefault();
    filterEmployeeData();
  });
});

function fetchEmployeeData() {
  fetch('manage.php')
    .then(response => response.json())
    .then(data => {
      console.log(data);
      displayEmployeeData(data);
      window.employeeData = data; 
    })
    .catch(error => console.error('Error fetching data:', error));
}

function displayEmployeeData(data) {
  const employeeTable = document.getElementById("employee-data");
  employeeTable.innerHTML = "";

  data.forEach(employee => {
    const row = `
      <tr id="row-${employee.empID}">
        <td>${employee.empID}</td>
        <td>${employee.name}</td>
        <td>${employee.username}</td>
        <td>${employee.department}</td>
        <td>
         <a href="http://localhost/Project/admin_login/update/update_page.php?empID=${employee.empID}" class="btn btn-warning btn-sm">Update</a>

          <button class="btn btn-danger btn-sm ml-2" onclick="deleteEmployee('${employee.empID}')">Delete</button>
        </td>
      </tr>
    `;
    employeeTable.innerHTML += row;
  });
}


function filterEmployeeData() {
  const searchValue = document.querySelector(".form-control").value.toLowerCase();
  const filteredData = window.employeeData.filter(employee => 
    employee.empID.toLowerCase().includes(searchValue)
  );
  displayEmployeeData(filteredData);
}

function deleteEmployee(empID) {
  if (confirm(`Are you sure you want to delete employee with ID ${empID}?`)) {
    fetch('delete_employee.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: `empID=${empID}`
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert(data.message);
        
      
        const row = document.getElementById(`row-${empID}`);
        if (row) row.remove();
      } else {
        alert(`Failed to delete employee: ${data.message}`);
      }
    })
    .catch(error => console.error('Error deleting employee:', error));
  }
}
document.addEventListener("DOMContentLoaded", () => {
  
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has('success') && urlParams.get('success') === 'true') {
    alert('Employee details updated successfully!');
    
    window.history.replaceState({}, document.title, window.location.pathname);
  }

  fetchEmployeeData();


  document.querySelector('.form-inline').addEventListener("submit", event => {
    event.preventDefault();
    filterEmployeeData();
  });
});
