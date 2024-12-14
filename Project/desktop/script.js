function redirectTo(role) {
  if (role === 'admin') {
    window.location.href = '/Project/admin_login/index.php';
  } else if (role === 'employee') {
    window.location.href = '/Project/emp_login/emp_info/index.php';
  }
}