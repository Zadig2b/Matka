import "./TravelCardTeaser.css";
import { formatDuration, formatDate } from './../../utils';

export default function TravelCardTeaser(props) {


  return (
    <div className="sub-card">
      <h3>
        {props.pays} {formatDuration(props.duree)} {props.prix}
      </h3>
      <h4>Du {formatDate(props.debut)} au {formatDate(props.fin)}
      </h4>

      <img className="img-card" src={`http://localhost:8000/image/${props.image}`} alt={props.name} />
    </div>
  );
}
