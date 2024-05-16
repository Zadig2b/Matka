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
  const [filteredTravels, setFilteredTravels] = useState(null);
  const [duration, setDuration] = useState(null);

  useEffect(() => {
    // Fetch travels
    fetch("http://127.0.0.1:8000/api/voyages")
      .then((response) => response.json())
      .then((data) => {
        setTravels(data);
        setDuration(data.duree);
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
      // Récupérez les voyages filtrés par pays et par catégorie
      fetch(
        `http://127.0.0.1:8000/api/voyages-par-pays-et-categorie/${filters.country}/${filters.category}`
      )
        .then((response) => response.json())
        .then((data) => {
          filteredTravels = data;
          setFilteredTravels(filteredTravels);
        })
        .catch((error) => {
          console.error("Error fetching filtered travels:", error);
        });
    } else if (filters.category) {
      // Récupérer les voyages filtrés par catégorie uniquement
      fetch(
        `http://127.0.0.1:8000/api/voyages-par-categorie/${filters.category}`
      )
        .then((response) => response.json())
        .then((data) => {
          filteredTravels = data;
          setFilteredTravels(filteredTravels);
        })
        .catch((error) => {
          console.error("Error fetching filtered travels by category:", error);
        });
    } else if (filters.country) {
      // Récupérer les voyages filtrés par pays uniquement
      fetch(`http://127.0.0.1:8000/api/voyages-par-pays/${filters.country}`)
        .then((response) => response.json())
        .then((data) => {
          filteredTravels = data;
          setFilteredTravels(filteredTravels);
        })
        .catch((error) => {
          console.error("Error fetching filtered travels by country:", error);
        });
    } else if (filters.duration) {
      // Filtrer par durée
      fetch(`http://127.0.0.1:8000/api/voyages-par-duree/${filters.duration}`)
        .then((response) => response.json())
        .then((data) => {
          filteredTravels = data;
          setFilteredTravels(filteredTravels);
        })
        .catch((error) => {
          console.error("Error fetching filtered travels by country:", error);
        });
    } else {
      // Aucun filtre appliqué, définissez filteredTravels sur null
      setFilteredTravels(null);
    }
  };

  const filterByDuration = (duration, selectedDuration) => {
    const matches = duration.match(/P(\d+)Y(\d+)M(\d+)D/);
    const days = parseInt(matches[3]);

    if (selectedDuration === "short") {
      return days >= 1 && days <= 7;
    } else if (selectedDuration === "medium") {
      return days >= 8 && days <= 14;
    } else if (selectedDuration === "long") {
      return days > 14;
    }

    // Renvoie false si aucune durée ne correspond
    return false;
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
