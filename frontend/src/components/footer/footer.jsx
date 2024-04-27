import { metadata, Aurore, Lexend } from "@/app/layout";
import "./footer.css";
import { Asar } from "next/font/google";

const font = Asar({ subsets: ["latin"], weight: "400" });

export default function Footer(props) {
  return (
    <>
      <div className="super-footer">
        <div className="footer-header">
          <div className="hero-logo">
            <div className="sub-logo">
              <h1>{metadata.title}</h1>
            </div>
          </div>
        </div>
        <div className="hero-subheader">
          <h2>{props.subtitle}</h2>
          <div className="subheader-content">{metadata.description}</div>
        </div>
      </div>
    </>
  );
}
