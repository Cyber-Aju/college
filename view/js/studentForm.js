// function myFunction() {
//   var x = document.getElementById("password");
//   if (x.type === "password") {
//     x.type = "text";
//   } else {
//     x.type = "password";
//   }
// }

function insert() {
  if (confirm("Are you sure insert data?") == true) {
    return true;
  } else {
    return false;
  }
}

function update() {
  if (confirm("Are you sure update changes?") == true) {
    return true;
  } else {
    return false;
  }
}

function validateStudentForm() {
  // Get form field values
  let username = document.getElementById("username").value.trim();
  let password = document.getElementById("password").value;
  let rePassword = document.getElementById("re-password").value;
  let firstName = document.getElementById("first_name").value.trim();
  let lastName = document.getElementById("last_name").value.trim();
  let department = document.getElementById("department").value;
  let email = document.getElementById("email").value;
  let mobile = document.getElementById("phone").value; // Changed to 'mobile' to match input name
  let dob = document.getElementById("dob").value;
  let address = document.getElementById("address").value.trim();
  let gender = document.getElementById("gender").value;
  let bloodGroup = document.getElementById("blood_group").value;
  let avatar = document.getElementById("avatar").files[0];

  let errorMsg = "";

  // Validate first name (letters only)
  if (!firstName.match(/^[a-zA-Z]+$/)) {
    errorMsg += "First name should contain only letters.\n";
  }

  // Validate last name (letters only)
  if (!lastName.match(/^[a-zA-Z]+$/)) {
    errorMsg += "Last name should contain only letters.\n";
  }

  // Validate mobile number format (10 digits)
  if (!/^\d{10}$/.test(mobile)) {
    errorMsg += "Mobile number should be exactly 10 digits.\n";
  }

  // Validate email format
  let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailPattern.test(email)) {
    errorMsg += "Please enter a valid email address.\n";
  }

  // Validate password and re-password match
  if (password !== rePassword) {
    errorMsg += "Passwords do not match.\n";
  } else if (password.length < 6) {
    errorMsg += "Password must be at least 6 characters long.\n";
  } else if (password === rePassword) {
  }

  // Validate age (must be 17+ years)
  let dobDate = new Date(dob);
  let currentDate = new Date();
  let ageDiff = currentDate.getFullYear() - dobDate.getFullYear();
  let ageCheck = new Date();
  ageCheck.setFullYear(ageCheck.getFullYear() - 17);

  if (dobDate > currentDate) {
    errorMsg += "DOB cannot be a future date.\n";
  } else if (dobDate > ageCheck) {
    errorMsg += "You must be at least 17 years old.\n";
  }

  // Validate department (must be selected)
  if (department === "") {
    errorMsg += "Please select a department.\n";
  }

  // Validate gender (must be selected)
  if (gender === "") {
    errorMsg += "Please select a gender.\n";
  }

  // Validate blood group (must be selected)
  if (bloodGroup === "") {
    errorMsg += "Please select a blood group.\n";
  }

  // Validate avatar file type (only JPG and PNG allowed)
  if (
    avatar &&
    !(avatar.type === "image/jpeg" || avatar.type === "image/png")
  ) {
    errorMsg +=
      "Only JPG and PNG images are allowed for the profile picture.\n";
  }

  // If there's any error, show the message and prevent form submission
  if (errorMsg) {
    alert(errorMsg);
    return false;
  }

  return true; // Allow form submission if no errors
}
