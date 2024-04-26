import './navbar.css';
import Link from 'next/link';

export default function Navbar() {
    const brand = "Matka"
  return (
    <div className="navbar">
      <Link href="/" className="logo">{brand}</Link>
      <nav>
        <ul className="navigation">
        <li>
          <Link href="/accueil">Accueil</Link>
          </li>
        <li>
           <Link href="/destination">Destinations</Link>
          </li>
          <li>
           <Link href="/contact">Contact</Link>
          </li>
          <li>
          <Link href="/contact/help">Aide</Link>
          </li>
        </ul>
      </nav>
    </div>
  );
}
