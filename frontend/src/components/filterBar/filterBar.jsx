// FilterBar.js

import React, { useState } from 'react';

const FilterBar = ({ categories, countries, onFilter }) => {
  const [category, setCategory] = useState('');
  const [country, setCountry] = useState('');
  const [duration, setDuration] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();
    onFilter({ category, country, duration });
  };

  return (
    <form onSubmit={handleSubmit}>
      <select value={category} onChange={(e) => setCategory(e.target.value)}>
        <option value="">All Categories</option>
        {categories.map((cat) => (
          <option key={cat.id} value={cat.nom}>{cat.nom}</option>
        ))}
      </select>

      <select value={country} onChange={(e) => setCountry(e.target.value)}>
        <option value="">All Countries</option>
        {countries.map((country) => (
          <option key={country.id} value={country.nom}>{country.nom}</option>
        ))}
      </select>

      <select value={duration} onChange={(e) => setDuration(e.target.value)}>
        <option value="">All Durations</option>
        <option value="short">Short (1-7 days)</option>
        <option value="medium">Medium (8-14 days)</option>
        {/* <option value="long">Long (>14 days)</option> */}
      </select>

      <button type="submit">Filter</button>
    </form>
  );
};

export default FilterBar;
