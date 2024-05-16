"use client";

import { useEffect, useState } from "react";
import TravelCard from "@/components/travelCard/TravelCard";
import DemandeForm from "@/components/demandeForm/demandeForm";

import "./page.css";

export default function TravelDetails(props) {
  const [loading, setLoading] = useState(true); 
  const [error, setError] = useState(false);
  const [data, setData] = useState(null); 

  useEffect(() => {
    try {
      fetch(
        "http://127.0.0.1:8000/api/voyage/" + props.params.travelId
      )
        .then((response) => response.json()) 
        .then((data) => {
          setLoading(false); 
          setData(data); 
          console.log(data);
        });
    } catch (error) {
      setError(true); 
      setLoading(false); 
    }
  }, []); 


  return (
    <div className="card-container">
      {loading && !error && <div>Données en cours de chargement !</div>}
      {!loading && !error && data && (
        <>
        <TravelCard
          nom={data.nom}
          debut={data.date_debut}
          fin={data.date_fin}
          duree={data.duree}
          description={data.description}
          prix={data.prix}
          image={data.image}
          id={data.id}
        />
        <DemandeForm 
        id={data.id}/>
        </>
      )}
      {!loading && error && <div>Une erreur est survenue</div>}
    </div>
  );
}

