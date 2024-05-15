export const formatDuration = (durationString) => {
  if (!durationString) {
    return ""; // Return empty string if durationString is undefined
  }

  // Extracting days, months, and years from the duration string
  const matches = durationString.match(/P(\d+)Y(\d+)M(\d+)D/);
  if (!matches) {
    return ""; // Return empty string if durationString does not match the expected format
  }
  const years = parseInt(matches[1]);
  const months = parseInt(matches[2]);
  const days = parseInt(matches[3]);

  // Constructing the human-readable format
  let formattedDuration = "";
  if (years > 0) {
    formattedDuration += `${years} ${years > 1 ? "years" : "year"}`;
  }
  if (months > 0) {
    formattedDuration += `${formattedDuration ? ", " : ""}${months} ${
      months > 1 ? "months" : "month"
    }`;
  }
  if (days > 0) {
    formattedDuration += `${formattedDuration ? ", " : ""}${days} ${
      days > 1 ? "days" : "day"
    }`;
  }

  return formattedDuration;
};

  
  export const formatDate = (dateString) => {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const date = new Date(dateString);
    return date.toLocaleDateString('fr-FR', options);
  };

  export const metadata = {
    title: "Matka, L'Agence de Voyage",
    description: "Une Agence de voyage à l'écoute de vos besoins, spécialisée dans les pays d'europe du nord. Des activités originales, authentiques, et au plus proche des populations locales. Venez découvrir les traditions, la cuisine, les paysages, et bien plus encore.",
    image: "/brand/logo resized.png"
    
  };