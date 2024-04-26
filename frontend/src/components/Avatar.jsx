export default function FetchImg(){
    const axios = require("axios");

const url = "https://animal-images-api.iamashuu397.repl.co/dog";

axios
  .get(url)
  .then((res) => {
    console.log(res.data.image);
  })
  .catch((err) => {
    console.log(err);
  });

//returns with a dog image
}