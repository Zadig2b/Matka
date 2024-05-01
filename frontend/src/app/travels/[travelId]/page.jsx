"use client";

import { useEffect, useState } from "react";
import TravelCard from "@/components/travelCard/TravelCard";

export default function CharacterDetail(props) {
  // Initialisation des états pour gérer le chargement, les erreurs, et les données reçues.
  const [loading, setLoading] = useState(true); // État de chargement des données.
  const [error, setError] = useState(false); // État pour capturer une éventuelle erreur lors du fetch.
  const [data, setData] = useState(null); // Stockage des données reçues du fetch.

  useEffect(() => {
    // Déclenchement de la récupération des données de personnages au montage du composant.
    try {
      fetch(
        "http://127.0.0.1:8000/api/voyage/" + props.params.travelId
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
      {/* Affichage conditionnel en fonction de l'état du chargement et des erreurs */}
      {loading && !error && <div>Données en cours de chargement !</div>}
      {!loading && !error && data && (
        <TravelCard
          nom={data.nom}
          debut={data.date_debut}
          fin={data.date_fin}
          // origin={data.origin.name}
          duree={data.duree}
          description={data.description}
          prix={data.prix}
          image={data.image}
        />
      )}
      {!loading && error && <div>Une erreur est survenue</div>}
    </main>
  );
}
