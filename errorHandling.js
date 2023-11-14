// Add an event listener to the form submission
document.getElementById("studentSignupForm").addEventListener("submit", function (event) {
  if (!(validateForm())) {
      event.preventDefault(); // Prevent the form submission when there are errors
  }
});

// Function to display an error message for a specific input field
function displayError(errorDisplay, errorMessage) {
  errorDisplay.textContent = errorMessage;
}

// Function to clear error messages
function clearErrors() {
  emailErrorDisplay.textContent = "";
  passwordErrorDisplay.textContent = "";
  confirmPasswordErrorDisplay.textContent = "";
}


// Function to validate the form
function validateForm() {
  clearErrors(); // Clear any previous error messages

  var password = document.getElementById("passwordStudentSignup").value;
  var confirmPassword = document.getElementById("confirmPasswordStudentSignup").value;


  if (password !== confirmPassword) {
      displayError(passwordErrorDisplay, "Password did not match");
      displayError(confirmPasswordErrorDisplay, "Password did not match");
      return false;
  }

  var checkPasswordCharacters = /[!@$%&]/;

  if (!checkPasswordCharacters.test(password)) {
      displayError(passwordErrorDisplay, "Password must have any of these characters: !@$%&");
      displayError(confirmPasswordErrorDisplay, "Password must have any of these characters: !@$%&");
      return false;
  }

  if (password.length !== 10) {
      displayError(passwordErrorDisplay, "Password must be 10 characters long");
      displayError(confirmPasswordErrorDisplay, "Password must be 10 characters long");
      return false;
  }

  // If all conditions are met, the form is valid
  return true;
}


//this is for clearing the input fields when the modal is close in signup student

// Add an event listener to the modal's backdrop (outside the modal content)
var modal = document.getElementById("signup_modal_student");
modal.addEventListener("click", function (event) {
  // Check if the click occurred outside the modal content
  if (event.target === modal) {
    clearFormFieldsAndErrors(); // Clear the form fields and error messages
    closeModal(); // Close the modal
  }
});

// Function to clear the form fields and error messages
function clearFormFieldsAndErrors() {
  var form = document.getElementById("studentSignupForm");
  // Reset the form to clear all input fields
  form.reset();

  // Clear error messages
  var passwordErrorElement = document.getElementById("passwordErrorDisplay");
  var confirmPasswordErrorElement = document.getElementById(
    "confirmPasswordErrorDisplay"
  );
  passwordErrorElement.textContent = "";
  confirmPasswordErrorElement.textContent = "";
}

// Function to close the modal
function closeModal() {
  $("#signup_modal_student").modal("hide");
}
