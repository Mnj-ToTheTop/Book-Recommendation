function validateLogin() {
    const user_id = document.getElementById('user_id').value;
    const password = document.getElementById('password').value;
    // Add logic to check if username and password are empty (improve validation later)
    if (user_id === '' || password === '') {
      alert('Please fill in all fields');
      return false;
    }
    return true;
  }
  
  function validateSignup() {
    // Similar logic to validateSignup function (improve validation later)
    const user_id = document.getElementById('new-user_id').value;
    const password = document.getElementById('new-password').value;
    const name = document.getElementById('new-username').value;
    if (user_id === '' || password === '' || name === '') {
      alert('Please fill in all fields');
      return false;
    }
    return true;
  }
