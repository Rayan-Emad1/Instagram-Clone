import React from 'react';

const UserCard = ({ user, followUser }) => {
  return (
    <div className="user-card">
      <span>{user.name}</span>
      <button onClick={() => followUser(user.id)}>Follow</button>
    </div>
  );
};

export default UserCard;
