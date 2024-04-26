export default function TravelCardTeaser(props){
    return(
        <div className="card">
              <p>{props.pays}</p>
              <p>{props.duree}</p>
              <p>{props.prix}</p>
              <p>{props.region}</p>
              <img
                className="card"
                src={props.image}
                alt={props.name}
                width={100}
                height={100}
              />
        </div>
    )
    
}