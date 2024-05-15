import "./footer.css";
import { Asar } from "next/font/google";
import PetitLogo from "../petit logo";
import LogoTexte from "../logo texte";

const font = Asar({ subsets: ["latin"], weight: "400" });

export default function Footer(props) {
  return (
    <>
      <div className="footer-container">
        <PetitLogo fill="white" height="200px"/>
        <LogoTexte fill="white" height="200px"/>

        <PetitLogo height="200px"/>
      </div>
    </>
  );
}
