import React from 'react';
import UserCard from '../UserCard';

const SearchModal = ({ searchResults, closeModal }) => { 
  return (
    <div className="search-modal">
      <div className="modal-content">
        <button onClick={closeModal} className="close-button">
          Close
        </button>
        <div className="search-results">
          {searchResults.map(user => (
            <UserCard key={user.id} user={user} /> 
          ))}
        </div>
      </div>
    </div>
  );
};

export default SearchModal;
