import { Aurore, Lexend } from "@/app/layout";
import "./heroHeader.css";
import { Asar } from "next/font/google";
import { metadata } from "@/utils";
import PetitLogo from "../petit logo";
import LogoTexte from "../logo texte";

const font = Asar({ subsets: ["latin"], weight: "400" });

export default function heroHeader(props) {
  return (
    <>
      <div className="header-container">
        <PetitLogo height="200px"/>
        <LogoTexte height="200px" />

        <PetitLogo height="200px" />
      </div>
    </>
  );
}
