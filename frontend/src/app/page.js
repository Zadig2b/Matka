import Navbar from "@/components/navbar/Navbar";
import TravelList from "@/components/travelList/TravelList";
import voyages from "./../../data.json";
import "./globals.css"
import HeroHeader from "@/components/heroHeader/HeroHeader";
import Footer from "@/components/footer/footer";

export default function Home() {
  
  return (
    <>
    <div className="All">
      <HeroHeader/>
    <TravelList
    travels={voyages}
    />
        <TravelList
    travels={voyages}
    />
    </div>
    </>
  );
}
