import FetchImg from "../Avatar";
import "./TravelList.css";
import Link from "next/link";
import TravelCardTeaser from "./../travelCardTeaser/TravelCardTeaser";

export default function TravelList(props) {
  return (
    <>
      <div className="row">
        <div className="header">
          <h1>Travels List</h1>
        </div>
        {props.travels.map((travel, index) => (
          <div key={index} className="column">
            <div className="card">
              <Link href={"/" + travel.id}>
                <h2>{travel.nom}</h2>
              </Link>
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
    </>
  );
}
