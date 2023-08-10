import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import SearchModal from '../SearchModel';
import './styles.css';

const Header = () => {
  const [searchQuery, setSearchQuery] = useState('');
  const [searchResults, setSearchResults] = useState([]);
  const [showModal, setShowModal] = useState(false);
  const navigate = useNavigate();
  const token = localStorage.getItem('token');

  const handleSearch = async () => {
    try {    
      if (!token) {
        console.log('Token not found.');
        return;
      }
  
      const response = await fetch('http://127.0.0.1:8000/api/users/search', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Authorization: `Bearer ${token}`,
        },
        body: JSON.stringify({ name: searchQuery }),
      });
  
      const data = await response.json();
      setSearchResults(data.users);
      setShowModal(true);
    } catch (error) {
      console.log('Error:', error);
    }
  };
  
  const closeSearchModal = () => {
    setShowModal(false);
    setSearchResults([]);
  };


  const OpenProfile = () => {
    navigate('/profile')

  }

  return (
    <header className="header-container">

      <div className="header-content">
        <div className="logo">Instagram</div>

        <div className="search-bar">
          <input type="text" value={searchQuery} onChange={(e) => setSearchQuery(e.target.value)} placeholder="Search users..." />
          <button onClick={handleSearch}>Search</button>
        </div>
        
        <img onClick={OpenProfile} className="profile-image" src="https://w7.pngwing.com/pngs/128/223/png-transparent-user-person-profile-instagram-ui-colored-icon.png" />
      </div>

      {showModal && (<SearchModal searchResults={searchResults} closeModal={closeSearchModal}  />)}
    </header>
  );
};

export default Header;
