<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: log.php');
    exit;
}
$name = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Contact Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>whsprr</title>
<meta name="apple-mobile-web-app-capable" content="yes" />
<link rel="apple-touch-icon" sizes="305x305" href="icon.png">
<link rel="icon" href="favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    h1 {
      text-align: center;
    }
    form {
      margin-bottom: 10px;
    }
    input[type="text"] {
      margin-bottom: 5px;
      padding: 5px;
      width: 200px;
    }
    input[type="submit"] {
      padding: 5px 10px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 5px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    td:last-child {
      text-align: center;
    }
    button {
      padding: 3px 8px;
    }
  </style>
</head>
<body>
  <h1>Contact Book</h1>
  your address <?php echo $name;?>@friendsnap
  <form id="contactForm">
    <input type="text" id="nameInput" placeholder="Name" required>
    <input type="text" id="emailInput" placeholder="friendsnap address" required>
    <input type="submit" value="Add Contact">
  </form>

  <table id="contactTable">
    <thead>
      <tr>
        <th>Name</th>
        <th>snap address</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="contactTableBody"></tbody>
  </table>

  <script>
    // Retrieve contacts from local storage or initialize an empty array
    let contacts = JSON.parse(localStorage.getItem('contacts')) || [];

    // Function to render the contacts in the table
    function renderContacts() {
      const tableBody = document.getElementById('contactTableBody');
      tableBody.innerHTML = '';

      for (let i = 0; i < contacts.length; i++) {
        const contact = contacts[i];
        const row = document.createElement('tr');
        row.innerHTML = `
          <td><a href="capture.php?sender=${contact.email}">${contact.name}</a></td>
          <td>${contact.email}</td>
          <td>
            <button onclick="editContact(${i})">Edit</button>
            <button onclick="deleteContact(${i})">Delete</button>
          </td>
        `;

        tableBody.appendChild(row);
      }
    }

    // Function to add a contact
    function addContact(event) {
      event.preventDefault();

      const nameInput = document.getElementById('nameInput');
      const emailInput = document.getElementById('emailInput');

      const contact = {
        name: nameInput.value,
        email: emailInput.value
      };

      contacts.push(contact);
      localStorage.setItem('contacts', JSON.stringify(contacts));

      nameInput.value = '';
      emailInput.value = '';

      renderContacts();
    }

    // Function to edit a contact
    function editContact(index) {
      const contact = contacts[index];
      const newName = prompt('Enter new name', contact.name);

      if (newName) {
        contact.name = newName;
        localStorage.setItem('contacts', JSON.stringify(contacts));
        renderContacts();
      }
    }

    // Function to delete a contact
    function deleteContact(index) {
      if (confirm('Are you sure you want to delete this contact?')) {
        contacts.splice(index, 1);
        localStorage.setItem('contacts', JSON.stringify(contacts));
        renderContacts();
      }
    }

    // Event listener for form submission
    document.getElementById('contactForm').addEventListener('submit', addContact);

    // Render contacts on page load
    renderContacts();
  </script>
</body>
</html>
