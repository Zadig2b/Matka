import './heroHeader.css'

export default function heroHeader (props) {
    return (
        <>
        <div className="hero-header">
            <h1>{props.title}</h1>
        </div>
        <div className="hero-subheader">
            <h2>{props.subtitle}</h2>
        </div>
        </>
    )

}