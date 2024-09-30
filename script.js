// Function to handle registration
document.getElementById('register-form').addEventListener('submit', function (e) {
    e.preventDefault();  // Prevent form from submitting the traditional way

    const formData = new FormData(this);  // Get form data

    fetch('register1.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())  // Parse the response as JSON
    .then(data => {
        console.log(data);  // Log the response in the console

        if (data.status === 'success') {
            window.location.href = 'login.html';  // Redirect to login page on success
        } else {
            alert(data.message);  // Show error message if registration fails
        }
    })
    .catch(error => {
        console.error('Error:', error);  // Log any errors
        alert('An error occurred. Please try again.'); // Notify user of an error
    });
});

// Function to handle book addition
document.getElementById('add-book-form')?.addEventListener('submit', function(event) {
    event.preventDefault();

    // Collect form data
    const formData = new FormData(this); // Automatically gets all form fields

    // Send API request to add the book
    fetch('add-book.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())  // Parse the response as JSON
    .then(data => {
        if (data.status === 'success') {
            alert('Book added successfully!');
            window.location.href = 'books.php';  // Redirect to books.html on success
        } else {
            alert(data.message);  // Show error message if book addition fails
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while adding the book. Please try again.');
    });
});



// Function to display books
window.addEventListener('load', function() {
    if (document.getElementById('books-table')) {
        const books = JSON.parse(localStorage.getItem('books') || '[]');
        const tableBody = document.getElementById('books-table').getElementsByTagName('tbody')[0];
        books.forEach(book => {
            const row = tableBody.insertRow();
            row.insertCell(0).innerText = book.title;
            row.insertCell(1).innerText = book.author;
            row.insertCell(2).innerText = book.isbn;
        });
    }
});

// Function to handle login
document.getElementById('login-form')?.addEventListener('submit', function(event) {
    event.preventDefault();

    // Collect form data
    const formData = new FormData();
    formData.append('username', document.getElementById('username').value);
    formData.append('password', document.getElementById('password').value);

    // Send API request
    fetch('login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())  // Assuming your PHP sends a JSON response
    .then(data => {
        if (data.status === 'success') {
            window.location.href = 'index.html';  // Redirect on successful login
        } else {
            alert('Invalid username or password');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred during login. Please try again.'); // User feedback
    });
});
