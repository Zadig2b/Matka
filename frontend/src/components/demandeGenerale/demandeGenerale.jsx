"use client"
import React, { useState } from 'react';
import "./demandeGenerale.css";

export default function DemandeGenerale(props) {
    const [nom, setNom] = useState('');
    const [prenom, setPrenom] = useState('');
    const [email, setEmail] = useState('');
    const [tel, setTel] = useState('');
    const [sujet, setSujet] = useState('');
    const [contenu, setContenu] = useState('');
  
    const handleSubmit = (event) => {
        event.preventDefault(); // Prevent the default form submission behavior
        console.log("Submitting demande...");
        console.log(props.id);
        const formData = {
            nom: nom,
            prenom: prenom,
            email: email,
            tel: tel,
            sujet: sujet,
            contenu: contenu,
        };
        console.log(formData);
        fetch("http://127.0.0.1:8000/api/demandegenerale/new", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            
          },
          body: JSON.stringify(formData), // Pass formData to the request body
        })
          .then((response) => response.json())
          .then((data) => {
            console.log("Demande submitted successfully:", data);
            // Handle success response
          })
          .catch((error) => {
            console.error("Error submitting demande:", error);
            // Handle error
          });
    };
  
    return (
        <form onSubmit={handleSubmit} >
          
                  <div className="card-form">
                    <h2>Demande de contact</h2>
              <div className="my-form-style">
            <label>
                Nom:
                <input type="text" className="form-control" value={nom} onChange={(e) => setNom(e.target.value)} />
            </label>
            </div>
            <div className="my-form-style">
            <label>
                Prénom:
                <input type="text" value={prenom} onChange={(e) => setPrenom(e.target.value)} />
            </label>
            </div>
            <div className="my-form-style">
            <label>
                Email:
                <input type="email" value={email} onChange={(e) => setEmail(e.target.value)} />
            </label>
            </div>
            <div className="my-form-style">
            <label>
                Téléphone:
                <input type="tel" value={tel} onChange={(e) => setTel(e.target.value)} />
            </label>
            </div>
            <div className="my-form-style">
            <label>
                Sujet:
                <input type="text" value={sujet} onChange={(e) => setSujet(e.target.value)} />
            </label>
            </div>
            <div className="my-form-style">
            <label>
                Contenu:
                <textarea value={contenu} onChange={(e) => setContenu(e.target.value)} />
            </label>
            </div>
            <button type="submit">Envoyer</button>
            </div>

        </form>
    );
}
