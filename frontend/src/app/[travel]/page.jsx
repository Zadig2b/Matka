"use client"

export default function TravelDetails(props){
    console.log(props);
    return(
        <div>
            <h1>Travel Details</h1>
            <p>Travel Name: {props.params.travel}</p>
        </div>
        
    )
}