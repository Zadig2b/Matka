import "./TravelCardTeaser.css";

export default function TravelCardTeaser(props){
    return(
        <div className="sub-card">
              <p>{props.pays} {props.duree} {props.prix}</p>
              {/* <p>{props.duree}</p>
              <p>{props.prix}</p>
              <p>{props.region}</p> */}
              <img
                className="img-card"
                src={props.image}
                alt={props.name}

              />
        </div>
    )
    
}