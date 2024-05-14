"use client"
import React, { useState } from 'react';
import "./demandeForm.css";

export default function DemandeForm(props) {
    const [nom, setNom] = useState('');
    const [prenom, setPrenom] = useState('');
    const [email, setEmail] = useState('');
    const [tel, setTel] = useState('');
  
    const handleSubmit = (event) => {
        event.preventDefault(); // Prevent the default form submission behavior
        console.log("Submitting demande...");
        console.log(props.id);
        const formData = {
            voyage_id: props.id, // Access voyageId from props
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

              <div className="mb-3">
            <label>
                Nom:
                <input type="text" className="form-control" value={nom} onChange={(e) => setNom(e.target.value)} />
            </label>
            </div>
            <label>
                Prénom:
                <input type="text" value={prenom} onChange={(e) => setPrenom(e.target.value)} />
            </label>
            <label>
                Email:
                <input type="email" value={email} onChange={(e) => setEmail(e.target.value)} />
            </label>
            <label>
                Téléphone:
                <input type="tel" value={tel} onChange={(e) => setTel(e.target.value)} />
            </label>
            <button type="submit">Submit</button>
            </div>

        </form>
    );
}