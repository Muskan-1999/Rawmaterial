document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");
    loginForm.addEventListener("submit", function (event) {
      event.preventDefault();
      const username = event.target.username.value;
      const password = event.target.password.value;
      // Perform login validation here (e.g., check against the database)
      // If the login is successful, redirect to the dashboard page
      window.location.href = "dashboard.php";
    });
  });
  
  