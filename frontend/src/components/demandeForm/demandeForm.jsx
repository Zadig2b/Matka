"use client";
import React, { useState } from "react";
import "./demandeForm.css";

export default function DemandeForm(props) {
  const [nom, setNom] = useState("");
  const [prenom, setPrenom] = useState("");
  const [email, setEmail] = useState("");
  const [tel, setTel] = useState("");

  const handleSubmit = (event) => {
    event.preventDefault(); // Empêcher le comportement de soumission de formulaire par défaut
    console.log("Submitting demande...");
    console.log(props.id);
    const formData = {
      voyage_id: props.id,
      nom: nom,
      prenom: prenom,
      email: email,
      tel: tel,
    };
    console.log(formData);
    fetch("http://127.0.0.1:8000/api/demande/new", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formData),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log("Demande submitted successfully:", data);
      })
      .catch((error) => {
        console.error("Error submitting demande:", error);
      });
  };

  return (
    <form onSubmit={handleSubmit}>
      <div className="card-form">
        <h2>Demande de contact</h2>
        <div className="my-form-style">
          <label>
            Nom:*
            <input
              type="text"
              className="form-control"
              value={nom}
              onChange={(e) => setNom(e.target.value)}
              required
            />
          </label>
        </div>
        <div className="my-form-style">
          <label>
            Prénom:*
            <input
              type="text"
              value={prenom}
              onChange={(e) => setPrenom(e.target.value)}
              required
            />
          </label>
        </div>
        <div className="my-form-style">
          <label>
            Email:*
            <input
              type="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              required
            />
          </label>
        </div>
        <div className="my-form-style">
          <label>
            Téléphone:
            <input
              type="tel"
              value={tel}
              onChange={(e) => setTel(e.target.value)}
            />
          </label>
        </div>

        <button type="submit">Envoyer</button>
      </div>
    </form>
  );
}
