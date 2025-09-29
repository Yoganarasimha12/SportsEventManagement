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
document.getElementById("customerForm").addEventListener("submit", function (e) {
    e.preventDefault(); // prevent page refresh

    // get field values
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const contact = document.getElementById("contact").value.trim();
    const accountType = document.getElementById("accountType").value;

    // error spans
    const nameError = document.getElementById("nameError");
    const emailError = document.getElementById("emailError");
    const contactError = document.getElementById("contactError");
    const accountTypeError = document.getElementById("accountTypeError");

    // clear old errors
    nameError.textContent = "";
    emailError.textContent = "";
    contactError.textContent = "";
    accountTypeError.textContent = "";

    let isValid = true;

    // validate name (alphabets only)
    if (!/^[A-Za-z\s]+$/.test(name)) {
        nameError.textContent = "Please enter only alphabets.";
        isValid = false;
    }

    // validate email
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        emailError.textContent = "Please enter a valid email id.";
        isValid = false;
    }

    // validate contact (10 digits, starts with 7/8/9)
    if (!/^[789]\d{9}$/.test(contact)) {
        contactError.textContent = "Contact must be 10 digits and start with 7/8/9.";
        isValid = false;
    }

    // validate account type
    if (accountType === "") {
        accountTypeError.textContent = "Please select an account type.";
        isValid = false;
    }

    // if valid, add to table
    if (isValid) {
        const customerTable = document.getElementById("customerTable").getElementsByTagName("tbody")[0];
        const newRow = customerTable.insertRow();

        newRow.insertCell(0).innerText = name;
        newRow.insertCell(1).innerText = email;
        newRow.insertCell(2).innerText = contact;
        newRow.insertCell(3).innerText = accountType;

        // clear form
        document.getElementById("customerForm").reset();
    }
});
</script>