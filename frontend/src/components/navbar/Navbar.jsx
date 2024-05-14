import "./navbar.css";
import Link from "next/link";
import { ReactComponent as LogoSVG } from "../../../public/brand/logo complet.jsx";
import LogoMatka from "./../../../public/brand/logo complet";

export default function Navbar() {
  const brand = "Matka";
  return (
    <div className="navbar">
      {/* <div className="logo-container">
        <img src="/brand/logo resized.png" alt="logo" id="logo" />
      </div> */}
      {/* <LogoMatka className="logoSvg"/> */}
      <Link href="/" className="logo">
        {brand}
      </Link>
      <nav>
        <ul className="navigation">
          <li>
            <Link href="/">Accueil</Link>
          </li>
          <li>
            <Link href="/travels">Destinations</Link>
          </li>
          <li>
            <Link href="/contact">Contact</Link>
          </li>
          <li>
            <Link href="/contact/about">A propos</Link>
          </li>
        </ul>
      </nav>
    </div>
  );
}
