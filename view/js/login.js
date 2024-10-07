function validateForm() {
  const username = document.getElementById("username").value.trim();
  const password = document.getElementById("password").value.trim();

  const passwordRegex = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*_]).{8,}/;

  if (username === "") {
    alert("Username cannot be empty.");
    return false;
  }

  if (!passwordRegex.test(password)) {
    alert(
      "Password must be at least 8 characters long and include at least one digit, one lowercase letter, one uppercase letter, and one special character from !@#$%^&*_"
    );
    return false;
  }

  return true; // If both validations pass, submit the form
}
