"use client"

import TravelList from "@/components/travelList/TravelList";
import "./globals.css"
import HeroHeader from "@/components/heroHeader/heroHeader";
import { useEffect, useState } from "react";

export default function Home() {
  const [loading, setLoading] = useState(true); 
  const [error, setError] = useState(false); 
  const [data, setData] = useState(null); 

  useEffect(() => {
    try {
      fetch(
        "http://127.0.0.1:8000/api/voyages"
      )
        .then((response) => response.json()) 
        .then((data) => {
          setLoading(false); 
          setData(data); 
        });
    } catch (error) {
      setError(true); 
      setLoading(false); 
    }
  }, []); 

  return (
    <main>
      {loading && !error && <div>Données en cours de chargement !</div>}
      {!loading && !error && data && (
<>
<HeroHeader/>
            <div className="scroll-container">


      <div className="list-header">
          <h1>Liste des Voyages</h1>
        </div>
      <div className="row">
        <TravelList travels={data}
        />
                      </div>
                      </div>
</>
      )}
      {!loading && error && <div>Une erreur est survenue</div>}
    </main>
  );
}

