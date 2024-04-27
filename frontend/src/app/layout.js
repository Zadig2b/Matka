import { Cinzel, Inter, La_Belle_Aurore, Lexend_Deca, Pacifico } from "next/font/google";
import "./globals.css";

const inter = Inter({ subsets: ["latin"] });
export const Aurore = La_Belle_Aurore({ subsets: ["latin"], weight: "400" });
const Lexend = Lexend_Deca({ subsets: ["latin"]});
export const PacificoFont = Pacifico({ subsets: ["latin"], weight: "400"});
const CinzelFont = Cinzel({ subsets: ["latin"], weight: "400"});

export const metadata = {
  title: "Matka, L'Agence de Voyage",
  description: "Une Agence de voyage à l'écoute de vos besoins, spécialisée dans les pays d'europe du nord. Des activités originales, authentiques, et au plus proche des populations locales. Venez découvrir les traditions, la cuisine, les paysages, et bien plus encore.",
};

export default function RootLayout({ children }) {
  return (
    <html lang="en">
      <body className={CinzelFont.className}>{children}
      {/* <div className={Aurore.className}>{children}</div> */}
      </body>
    </html>
  );
}
