import React, { useState } from 'react';
import './styles.css'
 
const SignIn = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');

 
  const handleSignIn = async () => {
    try {
      const response = await fetch('http://127.0.0.1:8000/api/signin', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          email: email,
          password: password,
        }),
      });
  
      const data = await response.json();
  
      if (data.message === 'User signin successfully') {
        console.log('Token:', data.token);
        localStorage.setItem('token', data.token);
        // redirectToMainPage();
      } else {
        console.log('Signin failed:', data.message);
      }
    } catch (error) {
      console.log('Error:', error);
    }
  };

  const handleSignUp = () => {
    return 
  }

  return (
    <div className='center'>
      <div className='signin-form'>
        <h1>Sign In</h1>
        <div className='input-container '>
          <label>Email:</label>
          <input type="text" value={email} onChange={(e) => setEmail(e.target.value)} />
        </div>
        <div className='input-container '>
          <label>Password:</label>
          <input type="password" value={password} onChange={(e) => setPassword(e.target.value)} />
        </div>
        <div className='button-container'>
          <button className='submit' onClick={handleSignUp}>Sign Up</button>
          <button className='submit' onClick={handleSignIn}>Sign In</button>
        </div>
      </div>
    </div>
  );
};

export default SignIn;
