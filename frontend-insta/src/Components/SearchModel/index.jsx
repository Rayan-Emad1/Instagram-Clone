import React from 'react';
import UserCard from '../UserCard';

const SearchModal = ({ searchResults, closeModal, followUser }) => { 
  return (
    <div className="search-modal">
      <div className="modal-content">
        <button onClick={closeModal} className="close-button">
          Close
        </button>
        <div className="search-results">
          {searchResults.map(user => (
            <UserCard key={user.id} user={user} followUser={followUser} /> 
          ))}
        </div>
      </div>
    </div>
  );
};

export default SearchModal;
