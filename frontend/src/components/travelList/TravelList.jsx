import "./TravelList.css";
import Link from "next/link";
import TravelCardTeaser from "./../travelCardTeaser/TravelCardTeaser";

export default function TravelList(props) {
  return (
    <>

    <div className="scroll-container">
      
      <div className="row">
      <div className="list-header">
          <h1>Travels List</h1>
        </div>
        {props.travels.map((travel, index) => (
          <div key={index} className="column">
            <div className="card">
              <div className="card-header">
              <Link href={"/" + travel.id}>
                <h2>{travel.nom}</h2>
              </Link>
              </div>
              <TravelCardTeaser 
              name={travel.nom}
              pays={travel.pays}
              duree={travel.duree}
              prix={travel.prix}
              region={travel.region}
              image={travel.image}
              description={travel.description}              
              />


            </div>
          </div>
        ))}
      </div>
      </div>

      
    </>
  );
}
