import {  Aurore, Lexend } from "@/app/layout";
import "./heroHeader.css";
import { Asar } from "next/font/google";
import { metadata } from "@/utils";

const font = Asar({ subsets: ["latin"], weight: "400" });

export default function heroHeader(props) {
  return (
    <>
      <div className="super-hero">
        <div className="hero-header">
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
