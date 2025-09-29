<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Customer Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #fff;
    }
    .form-label {
      font-weight: 500;
    }
    small {
      font-size: 0.8rem;
    }
  </style>
</head>
<body class="container mt-4">

  <form id="customerForm" class="w-100">
    <!-- Name -->
    <div class="row mb-3">
      <label for="name" class="col-sm-2 col-form-label">Name:</label>
      <div class="col-sm-10">
        <input type="text" id="name" class="form-control" placeholder="Enter Name">
        <small class="text-danger" id="nameError"></small>
      </div>
    </div>

    <!-- Email -->
    <div class="row mb-3">
      <label for="email" class="col-sm-2 col-form-label">Email Id:</label>
      <div class="col-sm-10">
        <input type="text" id="email" class="form-control" placeholder="Enter Email">
        <small class="text-danger" id="emailError"></small>
      </div>
    </div>

    <!-- Contact -->
    <div class="row mb-3">
      <label for="contact" class="col-sm-2 col-form-label">Contact No:</label>
      <div class="col-sm-10">
        <input type="text" id="contact" class="form-control" placeholder="Enter Contact No">
        <small class="text-danger" id="contactError"></small>
      </div>
    </div>

    <!-- Account Type -->
    <div class="row mb-3">
      <label for="accountType" class="col-sm-2 col-form-label">Account Type:</label>
      <div class="col-sm-10">
        <select id="accountType" class="form-select">
          <option value="">Select account type</option>
          <option value="Savings">Savings</option>
          <option value="Current">Current</option>
        </select>
        <small class="text-danger" id="accountTypeError"></small>
      </div>
    </div>

    <!-- Submit Button -->
    <div class="row">
      <div class="col-sm-2"></div>
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">Add Customer</button>
      </div>
    </div>
  </form>

  <script>
    document.getElementById("customerForm").addEventListener("submit", function(e) {
      e.preventDefault();

      // Get values
      let name = document.getElementById("name").value.trim();
      let email = document.getElementById("email").value.trim();
      let contact = document.getElementById("contact").value.trim();
      let accountType = document.getElementById("accountType").value;

      // Error elements
      let nameError = document.getElementById("nameError");
      let emailError = document.getElementById("emailError");
      let contactError = document.getElementById("contactError");
      let accountTypeError = document.getElementById("accountTypeError");

      // Reset errors
      nameError.textContent = "";
      emailError.textContent = "";
      contactError.textContent = "";
      accountTypeError.textContent = "";

      let isValid = true;

      // Validate Name
      if (!/^[A-Za-z ]+$/.test(name)) {
        nameError.textContent = "Please enter only alphabets";
        isValid = false;
      }

      // Validate Email
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        emailError.textContent = "Please enter a valid email";
        isValid = false;
      }

      // Validate Contact
      if (!/^[789]\d{9}$/.test(contact)) {
        contactError.textContent = "Enter valid 10-digit number starting with 7, 8, or 9";
        isValid = false;
      }

      // Validate Account Type
      if (accountType === "") {
        accountTypeError.textContent = "Please select an account type";
        isValid = false;
      }

      // If valid → log or process
      if (isValid) {
        alert("Customer added: " + name);
        document.getElementById("customerForm").reset();
      }
    });
  </script>
</body>
</html>