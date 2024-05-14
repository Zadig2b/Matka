import { Aurore, Lexend } from "@/app/layout";
import { metadata } from "@/utils";
import "./footer.css";
import { Asar } from "next/font/google";

const font = Asar({ subsets: ["latin"], weight: "400" });

export default function Footer(props) {
  return (
    <>
      <div className="super-footer">
        <img src="/brand/logo resized.png" alt="logo" id="logo-footer" />
        <img src="/brand/icône seule.png" alt="logo" id="icône" />

          <div className="brand-name">
              <h1>{metadata.title}</h1>
          </div>
          <img src="/brand/icône seule.png" alt="logo" id="icône" />
          <img src="/brand/logo resized.png" alt="logo" id="logo-footer" />

      </div>
    </>
  );
}
