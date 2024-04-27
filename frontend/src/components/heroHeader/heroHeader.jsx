import { metadata, Aurore } from "@/app/layout";
import "./heroHeader.css";
import { Asar } from "next/font/google";

const font = Asar({ subsets: ["latin"], weight: "400" });

export default function heroHeader(props) {
  return (
    <>
    <div className="super-hero">
      <div className="hero-header">
        <div className="hero-logo">
          <h1>{metadata.title}</h1>
        </div>
      </div>
      <div className="hero-subheader">
        <h2>{props.subtitle}</h2>
        <div className={font.className}>{metadata.description}</div>
      </div>
    </div>
    </>
  );
}
