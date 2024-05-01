export default function TravelCard(props){
    return(
        <div className="card">
              <p>{props.nom}</p>
              <p>{props.debut}</p>
              <p>{props.fin}</p>
              <p>{props.description}</p>
              <p>{props.pays}</p>
              <p>{props.duree}</p>
              <p>{props.prix}</p>
              <p>{props.region}</p>
              <img
                className="card"
                src={props.image}
                alt={props.name}
                width={200}
                height={200}
              />
        </div>
    )
    
}