const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
  container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
  container.classList.remove("right-panel-active");
});

//fungsi login
document.addEventListener('DOMContentLoaded', function() {
  // Function to toggle password visibility
  function togglePasswordVisibility(inputField, eyeIcon) {
    const type = inputField.getAttribute('type') === 'password' ? 'text' : 'password';
    inputField.setAttribute('type', type);
    eyeIcon.classList.toggle('fa-eye-slash');
  }

  // Sign Up
  const toggleSignUpPassword = document.getElementById('toggleSignUpPassword');
  const signUpPassword = document.getElementById('signUpPassword');
  toggleSignUpPassword.addEventListener('click', function() {
    togglePasswordVisibility(signUpPassword, toggleSignUpPassword);
  });

  const signUpButton = document.getElementById('signUpButton');
  signUpButton.addEventListener('click', function() {
    alert('databasenya belum di buat bang');// ini fungsi 
  });

  // Sign In
  const toggleSignInPassword = document.getElementById('toggleSignInPassword');
  const signInPassword = document.getElementById('signInPassword');
  toggleSignInPassword.addEventListener('click', function() {
    togglePasswordVisibility(signInPassword, toggleSignInPassword);
  });

  const signInButton = document.getElementById('signInButton');
  signInButton.addEventListener('click', function() {
    const username = document.querySelector('.sign-in-container input[type="text"]').value;
    const password = document.querySelector('.sign-in-container input[type="password"]').value;

    // Check credentials
    if (username === 'admin' && password === 'admin123') {
      window.location.href = 'frontend/page/admin/admin.html'; // Redirect to admin page
    } else if (username === 'user' && password === 'user123') {
      window.location.href = 'frontend/page/user/user.html'; // Redirect to user page
    } else {
      alert('Username atau password salah');
    }

    // Example integration with backend API
    /*
    fetch('https://your-backend-api.com/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ username, password })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        if (data.role === 'admin') {
          window.location.href = 'admin.html';
        } else {
          window.location.href = 'user.html';
        }
      } else {
        alert('Username atau password salah');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('Terjadi kesalahan pada server');
    });
    */
  });
}