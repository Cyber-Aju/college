function validateLoginForm() {
  let email = document.getElementById("email").value;
  let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
  if (!email.match(emailPattern)) {
    alert("Please enter a valid email address");
    return false;
  }

  let password = document.getElementById("password").value;
  if (password.length < 8) {
    alert("Password must be at least 8 characters long");
    return false;
  }

  return true;
}

//attach the validation function to form submit event
document.querySelector("form").onsubmit = validateLoginForm;

function logout() {
  if (confirm("Are you sure you want to logout?") == true) {
    return true;
  } else {
    return false;
  }
}

function editStudent() {
  if (confirm("Do you want to Edit current student data?") == true) {
    return true;
  } else {
    return false;
  }
}

function deleteStudent() {
  if (confirm("Do you want to delete current student data?") == true) {
    return true;
  } else {
    return false;
  }
}

function back() {
  window.location.href =
    "http://localhost/college/index.php?mod=student&view=studentList";
}
