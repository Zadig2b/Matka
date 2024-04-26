import Navbar from "@/components/navbar/Navbar";
import FetchImg from "@/components/Avatar";
import TravelList from "@/components/travelList/TravelList";
import voyages from "./../../data.json";
import "./globals.css"
import Fonts from "next/font/google";

export default function Home() {
  
  return (
    <>
    <Navbar/>
    <div className="body">
    <TravelList
    travels={voyages}
    />
    <FetchImg/>
    </div>
    </>
  );
}
