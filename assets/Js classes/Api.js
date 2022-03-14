export class Api {
  constructor() {
    this.url = "http://barcode.loc/api/barcodeGenerator";
  }

  generatePostData = (codeType, value) => {
    const data = JSON.stringify({
      value: value,
      type: codeType,
    });

    return data;
  };

  getBarcode = async (codeType, value) => {
    const query = await fetch(this.url, {
      method: "POST",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      body: this.generatePostData(codeType, value),
    });
    if (query.status == 200) {
      this.updateBarcodeImg();
    }
    return query;
  };

  updateBarcodeImg = () => {
    const img = document.getElementById("img");
    let timeStamp = new Date().getTime();
    let newSrc = img.src + "?=" + timeStamp;
    img.src = newSrc;
  };
}
