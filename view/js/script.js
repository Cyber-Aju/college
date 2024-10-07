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
