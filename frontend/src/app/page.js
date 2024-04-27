import Navbar from "@/components/navbar/Navbar";
import TravelList from "@/components/travelList/TravelList";
import voyages from "./../../data.json";
import "./globals.css"
import HeroHeader from "@/components/heroHeader/HeroHeader";

export default function Home() {
  
  return (
    <>
    <Navbar/>
    <div className="All">
      <HeroHeader/>
    <TravelList
    travels={voyages}
    />
          <HeroHeader/>

    </div>
    </>
  );
}
