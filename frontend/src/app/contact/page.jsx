
import DemandeGenerale from "@/components/demandeGenerale/demandeGenerale";
import "./page.css";

export default function Contact(){
    return(
        <>
        <div className="contact-header">
            <h1>Contact</h1>
        </div>
        <div className="contact-body">
            <DemandeGenerale/>

        </div>
        </>
    )
}