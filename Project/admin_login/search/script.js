
document.addEventListener("DOMContentLoaded", () => {
  fetchEmployeeData();
  
  
  document.querySelector('.form-inline').addEventListener("submit", event => {
      event.preventDefault();
      filterEmployeeData();
  });
});

function fetchEmployeeData() {
  fetch('search.php') // Ensure this matches your actual PHP filename
      .then(response => {
          if (!response.ok) {
              throw new Error(`HTTP error! status: ${response.status}`);
          }
          return response.json();
      })
      .then(data => {
          console.log('Data fetched:', data);
          displayEmployeeData(data);
          window.employeeData = data; // Save data globally for search
      })
      .catch(error => console.error('Error fetching data:', error));
}


function displayEmployeeData(data) {
  const employeeTable = document.getElementById("employee-data");
  employeeTable.innerHTML = "";
  data.forEach(employee => {
      const row = `<tr>
          <td>${employee.empID}</td>
          <td>${employee.name}</td>
          <td>${employee.username}</td>
          <td>${employee.department}</td>
          <td>${employee.dob}</td>
          <td>${employee.gender}</td>
          <td>${employee.email}</td>
          <td>${employee.phone}</td>
          <td>${employee.address}</td>
      </tr>`;
      employeeTable.innerHTML += row;
  });
}

function filterEmployeeData() {
  const searchValue = document.querySelector(".form-control").value.toLowerCase();
  const filteredData = window.employeeData.filter(employee => employee.empID.toLowerCase().includes(searchValue)
  );
  displayEmployeeData(filteredData);
}
