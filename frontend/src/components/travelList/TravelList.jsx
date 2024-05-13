import "./TravelList.css";
import Link from "next/link";
import TravelCardTeaser from "./../travelCardTeaser/TravelCardTeaser";

export default function TravelList(props) {
  return (
    <>

      
      <div className="list-header">
          <h1>Travels List</h1>
        </div>
        {props.travels.map((travel, index) => (
          <div key={index} className="column">
            <div className="card">
              <div className="card-header">
              <Link href={"/travels/" + travel.nom}>
                {travel.nom}
              </Link>
              </div>
              <TravelCardTeaser 
              name={travel.nom}
              pays={travel.pays}
              duree={travel.duree}
              debut={travel.date_debut}
              fin={travel.date_fin}
              prix={travel.prix}
              region={travel.region}
              image={travel.image}
              description={travel.description}
              id={travel.id}              
              />


            </div>
          </div>
        ))}

      
    </>
  );
}
