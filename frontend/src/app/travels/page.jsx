"use client";

import { useEffect, useState } from "react";
import TravelList from "@/components/travelList/TravelList";
import HeroHeader2 from "@/components/heroHeader/heroHeader2";
import "./page.css";
import FilterBar from "@/components/filterBar/filterBar";

export default function FetchAllTravels(props) {
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(false);
  const [travels, setTravels] = useState(null);
  const [categories, setCategories] = useState([]);
  const [countries, setCountries] = useState([]);
  const [filteredTravels, setFilteredTravels] = useState(null); // State for filtered travels

  useEffect(() => {
    // Fetch travels
    fetch("http://127.0.0.1:8000/api/voyages")
      .then((response) => response.json())
      .then((data) => {
        setTravels(data);
        setLoading(false);
      })
      .catch((error) => {
        setError(true);
        setLoading(false);
      });

    // Fetch categories
    fetch("http://127.0.0.1:8000/api/categories")
      .then((response) => response.json())
      .then((categoriesData) => {
        setCategories(categoriesData);
      })
      .catch((error) => {
        console.error("Error fetching categories:", error);
      });

    // Fetch countries
    fetch("http://127.0.0.1:8000/api/pays")
      .then((response) => response.json())
      .then((data) => {
        setCountries(data);
      })
      .catch((error) => {
        console.error("Error fetching countries:", error);
      });
  }, []);

  const handleFilter = (filters) => {
    let filteredTravels = null;
  
    if (filters.category && filters.country) {
      // Fetch filtered travels by both country and category
      fetch(`http://127.0.0.1:8000/api/voyages-par-pays-et-categorie/${filters.country}/${filters.category}`)
        .then((response) => response.json())
        .then((data) => {
          filteredTravels = data;
          setFilteredTravels(filteredTravels);
        })
        .catch((error) => {
          console.error("Error fetching filtered travels:", error);
        });
    } else if (filters.category) {
      // Fetch filtered travels by category only
      fetch(`http://127.0.0.1:8000/api/voyages-par-categorie/${filters.category}`)
        .then((response) => response.json())
        .then((data) => {
          filteredTravels = data;
          setFilteredTravels(filteredTravels);
        })
        .catch((error) => {
          console.error("Error fetching filtered travels by category:", error);
        });
    } else if (filters.country) {
      // Fetch filtered travels by country only
      fetch(`http://127.0.0.1:8000/api/voyages-par-pays/${filters.country}`)
        .then((response) => response.json())
        .then((data) => {
          filteredTravels = data;
          setFilteredTravels(filteredTravels);
        })
        .catch((error) => {
          console.error("Error fetching filtered travels by country:", error);
        });
    } else {
      // No filters applied, set filteredTravels to null
      setFilteredTravels(null);
    }
  };
  
  
  
  
  
  

  return (
    <>
      <HeroHeader2 />

      <main>

      {loading && !error && <div>Loading...</div>}
          {!loading && !error && travels && (
      <FilterBar
      
        categories={categories}
        countries={countries}
        onFilter={handleFilter}
      />
    )}
    {error && <div>Error occurred.</div>}

        <div className="all-container">
          
          {loading && !error && <div>Loading...</div>}
          {!loading && !error && travels && (
            <TravelList travels={filteredTravels || travels} />
          )}
          {error && <div>Error occurred.</div>}
        </div>
      </main>
    </>
  );
}
