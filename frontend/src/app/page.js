"use client"
// import 'bootstrap/dist/css/bootstrap.min.css';

import TravelList from "@/components/travelList/TravelList";
import "./globals.css"
import HeroHeader from "@/components/heroHeader/heroHeader";
import { useEffect, useState } from "react";

export default function Home() {
  // Initialisation des états pour gérer le chargement, les erreurs, et les données reçues.
  const [loading, setLoading] = useState(true); // État de chargement des données.
  const [error, setError] = useState(false); // État pour capturer une éventuelle erreur lors du fetch.
  const [data, setData] = useState(null); // Stockage des données reçues du fetch.

  useEffect(() => {
    // Déclenchement de la récupération des données de personnages au montage du composant.
    try {
      fetch(
        "http://127.0.0.1:8000/api/voyages"
      )
        .then((response) => response.json()) // Transformation de la réponse en JSON.
        .then((data) => {
          setLoading(false); // Arrêt de l'indicateur de chargement après la réception des données.
          setData(data); // Enregistrement des données reçues dans l'état 'data'.
        });
    } catch (error) {
      setError(true); // Enregistrement de l'erreur dans l'état 'error'.
      setLoading(false); // Arrêt de l'indicateur de chargement en cas d'erreur.
    }
  }, []); // Le tableau vide indique que cet effet ne s'exécute qu'au montage.

  return (
    <main>
      {/* <HeroHeader /> */}
      {/* Affichage conditionnel en fonction de l'état du chargement et des erreurs */}
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

