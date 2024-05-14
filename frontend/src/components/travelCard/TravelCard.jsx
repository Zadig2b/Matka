import { formatDuration, formatDate } from './../../utils';
import './TravelCard.css';
export default function TravelCard(props){
    return(
        <div className="custom-card">
          <div className="card-body">
              <h1 className="card-title">{props.nom}</h1>
              <div className='id' hidden={true}>{props.id}</div>
              <h2> {formatDuration(props.duree)}</h2>

              <h2>Du {formatDate(props.debut)} au {formatDate(props.fin)}</h2>
              <h2>{props.prix}</h2>
              </div>
              <img
                className="card-img"
                src={`http://localhost:8000/image/${props.image}`}                alt={props.name}

              />
                            <p>{props.description}</p>

        </div>
    )
    
}