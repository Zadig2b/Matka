import { Cinzel, Inter, La_Belle_Aurore, Lexend_Deca, Pacifico } from "next/font/google";
import "./globals.css";
import Footer from "@/components/footer/footer";
import Navbar from "@/components/navbar/Navbar";

const inter = Inter({ subsets: ["latin"] });
export const Aurore = La_Belle_Aurore({ subsets: ["latin"], weight: "400" });
export const Lexend = Lexend_Deca({ subsets: ["latin"]});
export const PacificoFont = Pacifico({ subsets: ["latin"], weight: "400"});
const CinzelFont = Cinzel({ subsets: ["latin"], weight: "400"});



export default function RootLayout({ children }) {
  return (
    <html lang="en">
      <body className={CinzelFont.className}>
      <Navbar/>
      {children}
      <Footer/>
      </body>
      
    </html>
  );
}
