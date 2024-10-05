function validateStudentForm() {
  let firstName = document.getElementById("first_name").value.trim();
  let lastName = document.getElementById("last_name").value.trim();
  let department = document.getElementById("department").value;
  let email = document.getElementById("email").value;
  let phone = document.getElementById("phone").value;
  let dob = document.getElementById("dob").value;
  let address = document.getElementById("address").value.trim();
  let status = document.querySelector('input[name="status"]:checked');
  let gender = document.getElementById("gender").value;
  let bloodGroup = document.getElementById("blood_group").value;
  let avatar = document.getElementById("avatar").files[0];

  let errorMsg = "";

  // first name not be a symbols
  if (!firstName.match(/^[a-zA-Z]+$/)) {
    errorMsg += "first Name should contain only letters and spaces.\n";
  }

  // last name not be a symbols
  if (!lastName.match(/^[a-zA-Z]+$/)) {
    errorMsg += "last Name should contain only letters and spaces.\n";
  }

  // phone number should be 10 digit
  if (!phone.match(/^\d{10}$/)) {
    errorMsg += "phone number should be exactly 10 digits.\n";
  }

  // file type will be image (png or jpeg)
  if (
    avatar &&
    !(avatar.type === "image/jpeg" || avatar.type === "image/png")
  ) {
    errorMsg += "only JPG and PNG images are allowed for pictures.\n";
  }

  // If there's any error, prevent form submission
  if (errorMsg) {
    alert(errorMsg);
    return false; // Prevent form submission
  }
  return true; // Allow form submission
}
